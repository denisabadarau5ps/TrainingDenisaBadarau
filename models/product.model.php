<?php

class Product
{
    public $id;
    public $title;
    public $description;
    public $price;

    function __construct($id, $title, $description, $price)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($descr)
    {
        $this->description = $descr;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}