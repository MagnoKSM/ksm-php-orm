<?php

require __DIR__ . "/vendor/autoload.php";

use MagnoKsm\ORM\Model;
use MagnoKsm\ORM\Drivers\MysqlPdo;

$pdo = new PDO('mysql:host=localhost;dbname=ksm_php_orm_db;', 'root', '');

$driver = new MysqlPdo($pdo);
$driver->setTable('users');

$model = new Model;
$model->setDriver($driver);

$model->id = 1;
$model->delete();
