<?php

namespace App\Models;

class Booglan
{

    protected $grupo_foo;
    protected $grupo_bar;
    protected $alfabeto;
    protected $digito_alfabeto;
    protected $texto;

    protected $num_preposicoes = 0;
    protected $num_verbos;
    protected $num_bonitos=0;

    public function __construct($texto)
    {

        $this->texto = $texto;
        $this->grupo_foo = ['r', 't', 'c', 'd', 'b'];
        $this->grupo_bar = array_diff(range('a', 'z'), $this->grupo_foo);
        $this->alfabeto = ['t', 'w', 'h', 'z,', 'k', 'd', 'f', 'v', 'c', 'j', 'x', 'l', 'r', 'n', 'q', 'm', 'g', 'p', 's', 'b'];
        $this->digito_alfabeto = array('t' => 0, 'w' => 1, 'h' => 2, 'z' => 3, 'k' => 4, 'd' => 5, 'f' => 6, 'v' => 7, 'c' => 8, 'j' => 9, 'x' => 10, 'l' => 11, 'r' => 12, 'n' => 13, 'q' => 14, 'm' => 15, 'g' => 16, 'p' => 17, 's' => 18, 'b' => 19,
        );
    }

/**
 * Totaliza os calculos realizados na interpretação de um texto booglan
 *
 * @return array
 */
    public function totalizador()
    {
        $palavras = explode(" ", $this->texto);
        $totalizador = array();
        $this->num_verbos['verbos'] = 0;
        $this->num_verbos['primeira_pessoa'] = 0;

        foreach ($palavras as $key => $palavra) {

            //calcula total preposicões
            if ($this->preposicoes($palavra)) {
                $this->num_preposicoes++;
            }

            //calcula total verbos
            $verbos = $this->verbos($palavra);

            if ($verbos && is_array($verbos)) {
                $this->num_verbos['verbos']++;

                if (isset($verbos['primeira_pessoa'])) {
                    $this->num_verbos['primeira_pessoa']++;
                }
            }

            //números bonitos

            $this->num_bonitos = $this->contaNumerosBonitos();

        }

        $totalizador['num_preposicoes'] = $this->num_preposicoes;
        $totalizador['num_bonitos']=$this->num_bonitos;
        $totalizador['num_verbos'] = $this->num_verbos;

        return $totalizador;

    }
    /**
     * Preposicoes no vocabulário booglan
     *
     * @return boolean
     */

    public function preposicoes($palavra)
    {
        //verifica o tamanho da palavra
        if (strlen(trim($palavra)) == 5 && in_array(substr($palavra, -1), $this->grupo_bar)) {
            $letra_nao_permitida = 'l';
            $palavra = str_split($palavra);

            if (!in_array($letra_nao_permitida, $palavra)) {
                return true;
            };

        }

        return false;

    }

    /**
     * Verbos no vocabulario booglan. tamanho da palavra maior que 8 e última letra
     * deve pertencer ao grupo bar
     *
     * @return array se condicao verdadeira, caso contrario @return boolean
     */

    public function verbos($palavra)
    {
        //verifica o tamanho da palavra e se a ultima letra pertence ao grupo bar
        if (strlen(trim($palavra)) >= 8 && in_array(substr($palavra, -1), $this->grupo_bar)) {

            $resultado['verbo'] = true;

            //verifica se é primeira pessoa
            if (in_array($palavra[0], $this->grupo_bar)) {
                $resultado['primeira_pessoa'] = true;
            }

            return $resultado;

        }

        return false;

    }

/**
 * Eibe um texto ordenado de acordo com o dicionario booglan sem palavras repetidas
 * Usando usort com funcão de callback
 *
 *  @return string
 */
    public function listaVocabulario()
    {
        $palavras = explode(" ", $this->texto);
        $palavras_unicas = $this->removePalavraDuplicada($palavras); //array_unique($palavras);

        usort($palavras_unicas, array($this, 'comparacao'));

        return implode(" ", $palavras_unicas);

    }

    /**
     * funcao auxiliar para ordenação customizada, que será usado  na funcão usort
     * http://php.net/manual/pt_BR/function.usort.php
     *
     * Necessário percorrer todas as letras, não somente a primeira letra
     *
     * @param string $a
     * @param string $b
     * @return int
     */

    public function comparacao($a, $b)
    {
        $tamanho = $this->tamanhoPalavra($a, $b);

        for ($i = 0; $i < $tamanho; $i++) {
            $l1 = $a[$i];
            $l2 = $b[$i];
            if ($this->digito_alfabeto[$l1] > $this->digito_alfabeto[$l2]) {
                return 1;
            } elseif ($this->digito_alfabeto[$l1] < $this->digito_alfabeto[$l2]) {
                return -1;
            }
        }

        return (strlen($a) - strlen($b));
    }

    /**
     * Retorna o tamanho da menor palavra
     *
     * @param string $a
     * @param string $b
     * @return int
     */

    public function tamanhoPalavra($a, $b)
    {
        $tamanhoA = strlen($a);
        $tamanhoB = strlen($b);
        return ($tamanhoA <= $tamanhoB) ? $tamanhoA : $tamanhoB;
    }

    /**
     * Calcula a quantidade de números bonitos distintos
     *
     * @return int
     */
    public function contaNumerosBonitos()
    {

        $palavras = explode(" ", $this->texto);

        $palavras = $this->removePalavraDuplicada($palavras);

        $numeros_convertidos_decimal = $this->converteParaNumerosDecimais($palavras);

        $numeros_bonitos = [];
        foreach ($numeros_convertidos_decimal as $n) {

            if ($this->ehNumeroBonito($n)) {
                $numeros_bonitos[] = $n;
            }

        }

        return count($numeros_bonitos);

    }

    /**
     * Verifica se é um número bonito
     *
     * @param $numero número decimal
     * @return boolean
     */

    public function ehNumeroBonito($numero)
    {
        return $numero >= 422224 and ($numero % 3 == 0) ? true : false;

    }

    /**
     * Converte para base decimal uma palavra em booglan
     *
     * @param $numeros é o array de palavras booglan que será convertida.
     * @return array
     */
    private function converteParaNumerosDecimais($numeros)
    {

        $numeros_decimais = [];

        foreach ($numeros as $numero) {

            $digitos = str_split($numero);
            $index = 0;
            $numero_decimal = 0;

            foreach ($digitos as $digito) {

                $valor = $this->digito_alfabeto[$digito];

                $fator_de_multiplicacao = 20 ** $index; //exponencial
                $parcial = $valor * $fator_de_multiplicacao;
                $numero_decimal += $parcial;
                $index++;

            }

            $numeros_decimais[] = $numero_decimal;

        }
        return $numeros_decimais;

    }

    /**
     * Helper
     *
     * @param string $palavras
     * @return array
     */

    public function removePalavraDuplicada($palavras)
    {
        return array_unique($palavras);
    }

}
