<?php
require __DIR__ . '/vendor/autoload.php';

use App\Models\Booglan;


/**
 * textos disponíveis
 */

$texto_a= file_get_contents('./texto-a.txt');
$texto_b= file_get_contents('./texto-b.txt');


//trocar a variável de acordo com texto

$booglan= new Booglan($texto_a);

$total=$booglan->totalizador();

//$total =$booglan->contaNumerosBonitos();

print_r($total);
 //$resultado_preposicao= $booglan->preposicoes('twkwv');

 //var_dump($resultado_preposicao);


