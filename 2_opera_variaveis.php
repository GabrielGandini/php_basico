<?php


//Montagem URL
//https://localhost/php-basicos/content/
//2_opera_variaveis.php?numero1=10&numero2=5


    //variaveis que recebem valores pela URL
    $numero1 = $_GET["numero1"];
    $numero2 = $_GET["numero2"];

    if(isset($numero1) && ($numero2)) {
        $numero1 = (int) $numero1;
        $numero2 = (int) $numero2;
    

    //calculos
    $soma = $numero1 + $numero2;
    $subtracao = $numero1 - $numero2;
    $multiplicacao = $numero1 * $numero2;
    $divisao = $numero1 / $numero2;

    //exibe
    echo "Soma: $soma <br>";
    echo "Subtração: $subtracao <br>";
    echo "Multiplicaçãp: $multiplicacao <br>";
    echo "Divisão: $divisao <br>";
    }  else {
        echo "Por favor, Forneça os valores de numero 1 e numero2 pela URL.";
    }
?>