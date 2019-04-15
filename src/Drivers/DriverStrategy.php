<?php
/**
 * Created by PhpStorm.
 * User: MagnoKSM
 * Date: 14/04/2019
 * Time: 21:22
 */

namespace MagnoKsm\ORM\Drivers;

use MagnoKsm\ORM\Model;


interface DriverStrategy
{
    public function save(Model $data);

    public function select(array $data = []);

    public function delete(array $data);

    public function exec(string $query = null);

    public function all(array $data = []);

    public function first(array $data = []);
}