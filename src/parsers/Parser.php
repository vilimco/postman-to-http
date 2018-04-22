<?php
/**
 * Created by PHPSTorm.
 * Date: 22/04/2018
 * Time: 21:12
 */

namespace P2H\parsers;


use P2H\interfaces\WritableItem;

interface Parser
{
    /**
     * @param $json
     * @return WritableItem[]
     */
    public function parse($json);

}
