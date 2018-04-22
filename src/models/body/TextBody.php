<?php
/**
 * Created by PHPSTorm.
 * Date: 22/04/2018
 * Time: 20:32
 */

namespace P2H\models\body;


use P2H\models\Body;

class TextBody extends Body
{

    /**
     * @return string
     */
    protected function prepareContent()
    {
        return $this->content;
    }
}
