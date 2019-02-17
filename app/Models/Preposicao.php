<?php

namespace App\Models;

class Preposicao extends Booglan
{
    protected $num_preposicoes = 0;

/**
 * calcula total preposicões
 *
 * @return int
 */
    public function contaPreposicoes()
    {
        $palavras = explode(" ", $this->texto);

        foreach ($palavras as $key => $palavra) {

            if ($this->preposicoes($palavra)) {
                $this->num_preposicoes++;
            }

        }

        return $this->num_preposicoes;

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

}
