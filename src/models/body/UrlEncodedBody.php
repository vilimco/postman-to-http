<?php
/**
 * Created by PHPSTorm.
 * Date: 22/04/2018
 * Time: 20:15
 */

namespace P2H\models\body;


use P2H\models\Body;

class UrlEncodedBody extends Body
{
    /**
     * @return string
     */
    protected function prepareContent()
    {
        $content = array_map(function ($item) {
            $key = $item->key;
            $value = urlencode($item->value);

            return "$key=$value";
        }, $this->content);

        $stringContent = implode('&', $content);

        return $stringContent;
    }
}
