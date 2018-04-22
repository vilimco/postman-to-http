<?php
/**
 * Created by PHPSTorm.
 * Date: 22/04/2018
 * Time: 21:12
 */

namespace P2H\parsers\implementations;


use P2H\factories\BodyFactory;
use P2H\interfaces\WritableItem;
use P2H\models\Call;
use P2H\models\Directory;
use P2H\models\Header;
use P2H\parsers\Parser;

class Postman21Parser implements Parser
{


    /**
     * @param $json
     * @param string $outputPath
     * @return WritableItem[]
     */
    public function parse($json, $outputPath = 'http-requests')
    {
        $outputPath = $this->prepareOutputPath($outputPath);
        $items = [];
        foreach ($json->item as $item) {
            $items[] = $this->parseItem($item, $outputPath);
        }

        return $items;
    }

    private function prepareOutputPath($path)
    {
        if($path[count($path) - 1] !== '/') {
            return $path . '/';
        }

        return $path;
    }

    /**
     * @param $item
     * @param string $path
     * @return WritableItem
     */
    private function parseItem($item, $path = '')
    {
        if ($this->isDirectory($item)) {
            $directoryPath = $path . $item->name;
            $directory = new Directory($directoryPath);

            foreach ($item->item as $subItem) {
                $directory->addWritableItem($this->parseItem($subItem, $directoryPath . '/'));
            }

            return $directory;
        }

        $request = $item->request;
        $fileName = sprintf("%s %s", $request->method, preg_replace('/\//', '-', $item->name));
        $callPath = $path . $fileName;
        $description = isset($item->description) ? $item->description : '';
        $call = new Call($callPath, $item->name, $request->method, $request->url->raw, $description);

        $body = $this->parseBody($request->body);
        $call->setBody($body);

        foreach ($this->parseHeaders($request->header) as $header) {
            $call->addHeader($header);
        }

        return $call;
    }

    /**
     * @param $body
     * @return \P2H\models\Body
     */
    private function parseBody($body)
    {
        $factory = new BodyFactory();
        return $factory->create($body);
    }

    /**
     * @param $rawHeaders
     * @return Header[]
     */
    private function parseHeaders($rawHeaders)
    {
        $headers = [];

        foreach ($rawHeaders as $rawHeader) {
            $headers[] = new Header($rawHeader->key, $rawHeader->value);
        }
        return $headers;
    }

    private function isDirectory($item)
    {
        return !isset($item->request);
    }
}
