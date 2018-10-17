<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Geral extends Model
{

    public function scopeFiltrar($query, $request) {
        if ($request->has('filter')) {
            $filtro = json_decode($request->input('filter'));
            $oldQuery = clone $query;
            $dates = $oldQuery->getModel()->getDates();
            foreach ($filtro as $key => $value) {
                $dotIndex = strpos($key, ".");
                if($dotIndex != false) {
                    $newKey = explode(".", $key);
                    $query = $query->whereHas($newKey[0], function($newQuery) use ($newKey, $dates, $value) {
                        $newQuery = $this->where($newQuery, $newKey[1], $dates, $value);
                    });
                } else {
                    $query = $this->where($query, $key, $dates, $value);
                }
                
            }
        }
        if($request->has('with')) {
            $with = json_decode($request->input('with'));
            if(is_array($with)) {
                foreach ($with as $key => $value) {
                    if(is_string($value)) {
                        $query = $query->with($value);
                    }
                }
            } else {
                $query = $query->with($with);
            }
        }
        
        return $query;
    }
    function where(&$query, $key, $dates, $value) {
        if(in_array($key, $dates)) {
            $query = $query->whereDate($key, Carbon::parse($value)->toDateString());
        } else if(is_string($value) || is_numeric($value)) {
            $query = $query->where($key, $value);
        } else if(is_array($value)) {
            $query = $query->whereIn($key, $value);
        }
        return $query;
    }
}
