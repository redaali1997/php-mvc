<?php

namespace App;

class RedaGarden extends EmptyGarden
{
    public function items()
    {
        return $this->width + $this->heigth;
    }
}
