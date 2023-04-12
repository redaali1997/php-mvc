<?php

namespace App;

class EmptyGarden
{
    protected $width;
    protected $heigth;

    public function __construct($width, $heigth)
    {
        $this->width = $width;
        $this->heigth = $heigth;
    }

    public function items()
    {
        return $this->heigth * $this->width;
    }
}
