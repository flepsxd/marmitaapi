<?php

//Função de retorno padrao
function resposta($dados, $erro = false, $req = 200){
    return response()->json([
        'erro' => $erro,
        'dados' => $dados
    ], $req);
}