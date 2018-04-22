<?php
/**
 * Created by PHPSTorm.
 * Date: 22/04/2018
 * Time: 21:35
 */

namespace P2H\models\body;


use P2H\models\Body;

class RawBody extends Body
{

    /**
     * @return string
     */
    protected function prepareContent()
    {
        return $this->content;
    }
}
