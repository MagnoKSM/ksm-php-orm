<?php
/**
 * Created by PhpStorm.
 * User: MagnoKSM
 * Date: 14/04/2019
 * Time: 20:45
 */

namespace MagnoKsm\ORM;

use MagnoKsm\ORM\Drivers\DriverStrategy;


class Model
{
    protected $driver;

    public function setDriver(DriverStrategy $driver)
    {
        $this->driver;

        return $this;
    }

    protected function getDriver()
    {

    }

    public function save()
    {

    }

    public function findAll(array $conditions = [])
    {

    }

    public function findFirst($id)
    {

    }

    public function delete()
    {

    }
}