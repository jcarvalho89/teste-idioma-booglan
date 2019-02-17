

<?php
require __DIR__ . '/vendor/autoload.php';

use App\Models\Dicionario;
use App\Models\NumeroBonito;
use App\Models\Preposicao;
use App\Models\Verbo;

/**
 * =================================
 * Textos disponíveis
 * =================================
 */
class App
{

    protected $texto_a;
    protected $texto_b;

    public function __construct()
    {

        $this->texto_a = file_get_contents('../texto-a.txt');
        $this->texto_b = file_get_contents('../texto-b.txt');

    }

    /**
     * Carrega os demais metodos para renderizar o html;
     * 
     * @return string
     */

    public function start()
    {

        $html = $this->preposicoes();
        $html .= $this->verbos();
        $html .= $this->numerosBonitos();
        $html .= $this->vocabulario();

        $this->templateHtml($html);
    }
    /**
     * Gera a sainda para html em formato de tabela comparativa entre texto A e texto B
     *
     * @return string
     */
    public function templateHtml($html)
    {

        $saida = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Idioma booglan</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">';
           $saida.= $this->carregaEstilos();
        
           $saida.= '</head><body>';

        $saida .= '<h3>Idioma Booglan</h3>';
        $saida .= "<table style='width:100%'><tr><th></th><th>Texto A</th><th>Texto B</th></tr><tbody>";
        $saida .= "$html";
        $saida .= "</body></table>";
        $saida.="</body></html>";

        echo $saida;
    }

    public function carregaEstilos()
    {
       return "<style>
        th {
            color: #333;
            background: #eee;
        }

        tr td {
            padding-top: 5px;
            padding-bottom: 5px;
        }
        </style>
        ";
    }

    /**
     * =================================
     * Preposicoes
     * =================================
     * @return string
     */
    public function preposicoes()
    {

        $preposicao_texto_a = new Preposicao($this->texto_a);
        $preposicao_texto_b = new Preposicao($this->texto_b);

        $preposicao_a = $preposicao_texto_a->contaPreposicoes();
        $preposicao_b = $preposicao_texto_b->contaPreposicoes();

        $html = "<tr>";
        $html .= "<td><strong>Preposicões</strong></td>";
        $html .= "<td>O texto A tem $preposicao_a preposicões </td>";
        $html .= "<td>O texto B tem $preposicao_b preposicões </td>";
        $html .= "</tr>";

        return $html;
    }

    /**
     * =================================
     * Verbos
     * =================================
     */
    public function verbos()
    {

        $verbos_texto_a = new Verbo($this->texto_a);
        $verbos_texto_b = new Verbo($this->texto_b);

        $verbos_a = $verbos_texto_a->contaVerbos();
        $verbos_b = $verbos_texto_b->contaVerbos();

        $html = "<tr>";
        $html .= "<td><strong>Verbos</strong></td>";
        $html .= "<td>O texto A tem " . $verbos_a['verbos'] . " verbos, sendo  que " . $verbos_a['primeira_pessoa'] . " verbos são em primeira pessoa</td>";
        $html .= "<td>O texto B tem " . $verbos_b['verbos'] . " verbos, sendo  que " . $verbos_b['primeira_pessoa'] . " verbos são em primeira pessoa</td>";
        $html .= "</tr>";

        return $html;

    }

/**
 * =================================
 * Números Bonitos distintos
 * =================================
 *
 * @return string
 */

    public function numerosBonitos()
    {

        $numero_texto_a = new NumeroBonito($this->texto_a);
        $numero_texto_b = new NumeroBonito($this->texto_b);

        $numero_a = $numero_texto_a->totalNumerosBonitos();
        $numero_b = $numero_texto_b->totalNumerosBonitos();

        $html = "<tr>";
        $html .= "<td><strong>Números bonitos</strong></td>";
        $html .= "<td>O texto A tem $numero_a números bonitos distintos</td>";
        $html .= "<td>O texto B tem $numero_b números bonitos distintos</td>";
        $html .= "</tr>";

        return $html;

    }

/**
 * =================================
 * Lista de Vocabulário
 * =================================
 *
 * @return string
 */

    public function vocabulario()
    {


        $dicionario_texto_a = new Dicionario($this->texto_a);
        $dicionario_texto_b = new Dicionario($this->texto_b);

        $dicionario_a = $dicionario_texto_a->listaVocabulario();
        $dicionario_b = $dicionario_texto_b->listaVocabulario();


        $html = "<tr>";
        $html .= "<td><strong>Lista de Vocabulário Ordenada</strong></td>";
        $html .= "<td>$dicionario_a</td>";
        $html .= "<td>$dicionario_b</td>";
        $html .= "</tr>";


        return $html;

    }

}
