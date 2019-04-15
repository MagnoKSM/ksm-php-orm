<?php

require __DIR__ . "/vendor/autoload.php";

use MagnoKsm\ORM\Model;

$model = new Model;
echo $model->setDriver('mysql');