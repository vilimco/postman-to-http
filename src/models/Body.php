<?php
/**
 * Created by Awesome Vilim.
 * Date: 22/04/2018
 * Time: 19:42
 */

namespace P2H\models;


abstract class Body
{
    protected $content;

    /**
     * Body constructor.
     * @param $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    protected abstract function prepareContent();

    public function getContent()
    {
        return $this->prepareContent();
    }
}
