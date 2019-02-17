<?php

namespace App\Models;

class Dicionario extends Booglan
{


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

}
