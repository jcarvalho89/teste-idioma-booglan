<?php

namespace App\Models;

class NumeroBonito extends Booglan
{

    protected $num_bonitos = 0;

/**
 * calcula total numeros bonitos
 *
 * @return int
 */
    public function totalNumerosBonitos()
    {
        $palavras = explode(" ", $this->texto);

        foreach ($palavras as $key => $palavra) {

            $this->num_bonitos = $this->contaNumerosBonitos();

        }

        return $this->num_bonitos;

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

}
