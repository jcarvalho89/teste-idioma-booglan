<?php

namespace App\Models;

class Booglan
{

    protected $grupo_foo;
    protected $grupo_bar;
    protected $alfabeto;
    protected $texto;

    protected $num_preposicoes = 0;
    protected $num_verbos;

    public function __construct($texto)
    {

        $this->texto = $texto;
        $this->grupo_foo = ['r', 't', 'c', 'd', 'b'];
        $this->grupo_bar = array_diff(range('a', 'z'), $this->grupo_foo);
        $this->alfabeto = ['t', 'w', 'h', 'z,', 'k', 'd', 'f', 'v', 'c', 'j', 'x', 'l', 'r', 'n', 'q', 'm', 'g', 'p', 's', 'b'];

    }
    /**
     * são as palavras de 5 letras que terminam numa letra tipo bar, mas onde não ocorre a letra l
     * recebe a string e valida se é preposição,
     * @return boolean
     */

    //str_split() -- passa string para array
    //explode() --divide string em strings
    //substr("testers", -1); -- retorna o ultimo caracter de um string
    //file_get_contents -- pega conteudo de um arquivo

    public function totalizador()
    {
        $strings = explode(" ", $this->texto);
        $totalizador = array();

        foreach ($strings as $key => $string) {

            //calcula preposicões
            if ($this->preposicoes($string)) {
                $this->num_preposicoes++;
            }

            //calcula total verbos
            $verbos = $this->verbos($string);
            if ($verbos) {
                $this->num_verbos['verbos']++;
                if (isset($verbos['primeira_pessoa'])) {
                    $this->num_verbos['primeira_pessoa']++;
                }
            }

        }

        $totalizador['num_preposicoes'] = $this->num_preposicoes;
        $totalizador['num_verbos'] = $this->num_verbos;

        return $totalizador;

    }

    public function preposicoes($string)
    {
        //verifica o tamanho da string
        if (strlen(trim($string)) != 5 || !in_array(substr($string, -1), $this->grupo_bar)) {
            return false;
        }

        $letra_nao_permitida = 'l';
        $string = str_split($string);

        if (!in_array($letra_nao_permitida, $string)) {
            return true;
        };

        return false;

    }

    public function verbos($string)
    {
        //verifica o tamanho da string e se a string pertence ao grupo bar
        if (strlen(trim($string)) < 8 || !in_array(substr($string, -1), $this->grupo_bar)) {
            return false;
        }

        //verifica se é primeira pessoa
        if (in_array($string[0], $this->grupo_bar)) {
            $resultado['primeira_pessoa'] = true;
        }

        $resultado['verbo'] = true;

        return $resultado;
    }

    //twhzkdfvcjxlrnqmgpsb -- alfabeto Booglan em ordem alfabetica
    public function listaVocabulario()
    {
        $strings = explode(" ", $this->texto);
        $strings = array_unique($strings); //remove palavras duplicadas

        print_r($strings);

        $sortOrder = $this->alfabeto;

        return usort($strings, array($this, "comparacao"));

    }

    public function ordenacao($c)
    {
        $pos = array_search($c, $this->alfabeto);
        return $pos !== false ? $pos : 99999;
    }

    public function comparacao($a, $b)
    {

        if ($this->ordenacao($a[0]) < $this->ordenacao($b[0])) {
            return -1;
        } elseif ($this->ordenacao($a[0]) == $this->ordenacao($b[0])) {
            return 0;
        } else {
            return 1;
        }
    }

}
