<?php
/**
 * Created by PHPSTorm.
 * Date: 22/04/2018
 * Time: 20:12
 */

namespace P2H\models\body;


use P2H\models\Body;

class JSONBody extends Body
{
    protected function prepareContent()
    {
        // Already is json encoded
        return $this->content;
    }

}
