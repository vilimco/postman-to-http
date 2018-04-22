<?php
/**
 * Created by PHPSTorm.
 * Date: 22/04/2018
 * Time: 21:24
 */

namespace P2H\models\body;


use P2H\models\Body;

class EmptyBody extends Body
{
    public function __construct()
    {
        parent::__construct('');
    }


    /**
     * @return string
     */
    protected function prepareContent()
    {
        return '';
    }
}
