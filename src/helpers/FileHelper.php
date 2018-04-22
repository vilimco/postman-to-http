<?php
/**
 * Created by PHPSTorm.
 * Date: 22/04/2018
 * Time: 20:42
 */

namespace P2H\helpers;


class FileHelper
{
    public function writeToFile($path, $content)
    {
        $this->createDirectory(dirname($path));
        $handler = fopen($path, "w");
        fwrite($handler, $content);
        fclose($handler);
    }

    public function createDirectory($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
    }

    public function readFromFile($path)
    {
        return file_get_contents($path);
    }
}
