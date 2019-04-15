<?php

require __DIR__ . "/vendor/autoload.php";

use MagnoKsm\ORM\Model;
use MagnoKsm\ORM\Drivers\MysqlPdo;

$pdo = new PDO('mysql:host=localhost;dbname=example_php_orm_db;', 'root', 'password');

$driver = new MysqlPdo($pdo);
$driver->setTable('users');

$model = new Model;
$model->setDriver($driver);

$model->name = 'Magno';
$model->age = 29;
$model->email = 'magno@email.com';
$model->save();
