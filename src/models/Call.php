<?php

namespace P2H\models;

use P2H\helpers\FileHelper;
use P2H\interfaces\WritableItem;
use P2H\models\body\FormDataBody;

class Call implements WritableItem
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $method;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $description = '';
    /**
     * @var Header[]
     */
    private $headers = [];
    /**
     * @var Body
     */
    private $body = null;

    /**
     * Call constructor.
     * @param string $path
     * @param string $name
     * @param string $method
     * @param string $url
     * @param string $description
     */
    public function __construct($path, $name, $method, $url, $description = '')
    {
        $this->path = $path;
        $this->name = $name;
        $this->method = $method;
        $this->url = $url;
        $this->description = $description;
    }


    public function write()
    {
        $this->checkSpecialCases();

        $headers = array_map(function(Header $header) {
            return $header->toString();
        }, $this->headers);

        $stringHeaders = implode("\n", $headers);

        $content = sprintf(
            "### %s - %s\n%s %s\n%s\n\n%s",
            $this->name,
            $this->description ? $this->description : 'No description',
            $this->method,
            $this->url,
            $stringHeaders,
            $this->body->getContent()
        );

        $fileName = $this->path . '.http';
        $fileHelper = new FileHelper();
        $fileHelper->writeToFile($fileName, $content);
    }

    private function checkSpecialCases()
    {
        $this->checkForFormDataHeader();
    }


    private function checkForFormDataHeader()
    {
        if(!($this->body instanceof FormDataBody)) {
            return;
        }

        $contentTypeHeader = array_reduce($this->headers, function($value, Header $header) {
            if($header->getKey() === 'Content-Type') {
                return $header;
            }

            return $value;
        }, null);

        if($contentTypeHeader === null) {
            $contentTypeHeader = new Header('Content-Type', 'multipart/form-data');
            $this->headers[] = $contentTypeHeader;
        }

        $boundary = sprintf("boundary=%s", $this->body->getBoundary());
        $contentTypeHeader->addValue($boundary);
    }

    /**
     * @param Body $body
     */
    public function setBody(Body $body)
    {
        $this->body = $body;
    }

    /**
     * @param Header $header
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
    }


}
