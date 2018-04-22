<?php
/**
 * Created by Awesome Vilim.
 * Date: 22/04/2018
 * Time: 19:37
 */

namespace P2H\models;


use P2H\helpers\FileHelper;
use P2H\interfaces\WritableItem;

class Directory implements WritableItem
{
    /**
     * @var string
     */
    private $path;


    /**
     * @var WritableItem[]
     */
    private $items = [];

    /**
     * Directory constructor.
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }


    public function write()
    {
        $fileHelper = new FileHelper();
        $fileHelper->createDirectory($this->path);

        foreach ($this->items as $item) {
            $item->write();
        }
    }

    public function addWritableItem(WritableItem $item)
    {
        $this->items[] = $item;
    }
}
