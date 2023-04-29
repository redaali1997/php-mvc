<?php

require './vendor/autoload.php';



$garden = new App\RedaGarden(20, 30);

var_dump($garden->items());
