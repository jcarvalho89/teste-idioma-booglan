<?php

namespace App\Models;

/**
 * Classe principal
 */
class Booglan
{

    protected $grupo_foo;
    protected $grupo_bar;
    protected $alfabeto;
    protected $digito_alfabeto;
    protected $texto;

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
