<?php
require __DIR__ . '/vendor/autoload.php';


//use App\Models\Verbo;
//use App\Models\Booglan;

use App\Models\Verbo;
use App\Models\Preposicao;
use App\Models\NumeroBonito;
use App\Models\Dicionario;


/**
 * =================================
 * Textos disponíveis
 * =================================
 */

$texto_a= file_get_contents('./texto-a.txt');
$texto_b= file_get_contents('./texto-b.txt');


/**
 * =================================
 * Verbos
 * =================================
 */

$verbos_texto_a = new Verbo($texto_a);
$verbos_texto_b = new Verbo($texto_b);

$verbos_a = $verbos_texto_a->contaVerbos();
$verbos_b = $verbos_texto_b->contaVerbos();

echo 'O texto A tem '.$verbos_a['verbos'].' verbos, sendo  que '.$verbos_a['primeira_pessoa'].' verbos são em primeira pessoa';


/**
 * =================================
 * Preposicoes
 * =================================
 */


$preposicao_texto_a = new Preposicao($texto_a);
$preposicao_texto_b = new Preposicao($texto_b);

$preposicao_a = $preposicao_texto_a->contaPreposicoes();
$preposicao_b = $preposicao_texto_b->contaPreposicoes();

echo 'O texto A tem '.$preposicao_a.' preposicões';



/**
 * =================================
 * Números Bonitos distintos
 * =================================
 */


$numero_texto_a = new NumeroBonito($texto_a);
$numero_texto_b = new NumeroBonito($texto_b);

$numero_a = $numero_texto_a->totalNumerosBonitos();
$numero_b = $numero_texto_b->totalNumerosBonitos();

echo 'O texto A tem '.$numero_a.' números bonitos distintos';




/**
 * =================================
 * Lista de Vocabulário
 * =================================
 */


$dicionario_texto_a = new Dicionario($texto_a);
$dicionario_texto_b = new Dicionario($texto_b);

$dicionario_a = $dicionario_texto_a->listaVocabulario();
$dicionario_b = $dicionario_texto_b->listaVocabulario();

echo $dicionario_a;



