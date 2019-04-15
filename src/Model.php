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
        $this->driver = $driver;

        return $this;
    }

    protected function getDriver()
    {
        return $this->driver;
    }

    public function save()
    {
        return $this->getDriver()
            ->save($this)
            ->exec()
        ;
    }

    public function findAll(array $conditions = [])
    {
        return $this->getDriver()
            ->select($conditions)
            ->exec()
            ->all()
        ;
    }

    public function findFirst($id)
    {
        return $this->getDriver()
            ->select(['id' => $id])
            ->exec()
            ->first()
        ;
    }

    public function delete()
    {
        return $this->getDriver()
            ->delete(['id' => $this->id])
            ->exec()
        ;
    }
}