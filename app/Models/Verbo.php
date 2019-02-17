<?php

namespace App\Models;

class Verbo extends Booglan
{
    protected $num_verbos;

/**
 * Calcula o total de verbos no texto
 *
 * @return array com o total de verbos em geral e primeira pessoa
 */
    public function contaVerbos()
    {
        $palavras = explode(" ", $this->texto);

        $this->num_verbos['verbos'] = 0;
        $this->num_verbos['primeira_pessoa'] = 0;

        foreach ($palavras as $key => $palavra) {

            //calcula total verbos
            $verbos = $this->verbos($palavra);

            if ($verbos && is_array($verbos)) {
                $this->num_verbos['verbos']++;

                if (isset($verbos['primeira_pessoa'])) {
                    $this->num_verbos['primeira_pessoa']++;
                }
            }

        }

        return $this->num_verbos;

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
}
