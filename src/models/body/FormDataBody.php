<?php
/**
 * Created by PHPSTorm.
 * Date: 22/04/2018
 * Time: 20:24
 */

namespace P2H\models\body;


use P2H\models\Body;

class FormDataBody extends Body
{
    const DEFAULT_BOUNDARY = '----WebKitFormBoundary7MA4YWxkTrZu0gW';


    private $boundary;

    public function __construct($content)
    {
        parent::__construct($content);

        $this->boundary = self::DEFAULT_BOUNDARY;
    }

    /**
     * @return string
     */
    public function getBoundary()
    {
        return $this->boundary;
    }

    /**
     * @param string $boundary
     */
    public function setBoundary($boundary)
    {
        $this->boundary = $boundary;
    }

    /**
     * @return string
     */
    protected function prepareContent()
    {
        $boundary = '--' . $this->boundary;

        if(empty($this->content)) {
            return sprintf("%s--", $boundary);
        }

        $content = array_map(function ($item) {

            if(!isset($item->value)) {
                $value = $item->src;
            } else {
                $value = $item->value;
            }

            $key = sprintf("Content-Disposition: form-data; name=\"%s\"", $item->key);

            return sprintf("%s\n\n%s\n", $key, $value);
        }, $this->content);

        $stringContent = implode("$boundary\n", $content);

        $boundaryContent = sprintf("%s\n%s%s--", $boundary, $stringContent, $boundary);

        return $boundaryContent;
    }

}
