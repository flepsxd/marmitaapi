<?php

//Função de retorno padrao
function resposta($dados, $erro = false){
    return response()->json([
        'erro' => $erro,
        'dados' => $dados
    ]);
}