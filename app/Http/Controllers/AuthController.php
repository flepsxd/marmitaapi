<?php
namespace App\Http\Controllers;

use Validator;
use App\Models\Usuarios as User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Create a new token.
     * 
     * @param  \App\Models\Usuario   $user
     * @return string
     */
    protected function jwt(User $user)
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60 * 10000 // Expiration time
        ];
        
        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }
    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     * 
     * @param  \App\Models\Usuario $user 
     * @return mixed
     */
    public function authenticate(User $user)
    {
        $this->validate($this->request, [
            'email' => 'required|email',
            'senha' => 'required'
        ]);
        // Find the user by email
        $user = User::where('email', $this->request->input('email'))->where('status', 'A')->first();
        if (!$user) {
            return response()->json([
                'error' => 'E-mail ou senha estão errados'
            ], 400);
        }
        // Verify the password and generate the token
        if (Hash::check($this->request->input('senha'), $user->senha)) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }
        // Bad Request response
        return response()->json([
            'error' => 'E-mail ou senha estão errados'
        ], 400);
    }
}