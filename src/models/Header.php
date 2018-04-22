<?php
/**
 * Created by Awesome Vilim.
 * Date: 22/04/2018
 * Time: 19:40
 */

namespace P2H\models;


class Header
{
    private $key;
    private $value;

    /**
     * Header constructor.
     * @param $key
     * @param $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function toString()
    {
        return sprintf('%s: %s', $this->key, $this->value);
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    public function addValue($value)
    {
        $this->value .= '; ' . $value;
    }
}
