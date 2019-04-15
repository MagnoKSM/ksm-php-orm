<?php
/**
 * Created by PhpStorm.
 * User: MagnoKSM
 * Date: 14/04/2019
 * Time: 21:11
 */

namespace MagnoKsm\ORM\Drivers;

use MagnoKsm\ORM\Model;


class MysqlPdo implements DriverStrategy
{
    protected $pdo;
    protected $table;
    protected $query;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function setTable(string $table)
    {
        $this->table = $table;

        return $this;
    }

    public function save(Model $data)
    {
        if (!empty($data->id)) {
            $this->update($data);
        }
        $query = 'INSERT INTO %s (%s) VALUES (%s)';

        $fields = [];
        $fields_to_bind = [];

        foreach ($data as $field => $value) {
            $fields[] = $field;
            $fields_to_bind[] = ':'. $field;
        }

        $fields = implode(',', $fields);
        $fields_to_bind = implode(',', $fields_to_bind);

        $query = sprintf($query, $this->table, $fields, $fields_to_bind);

        $this->query = $this->pdo->prepare($query);

        $this->bind($data);

        return $this;
    }

    protected function update($data)
    {
        $query = 'UPDATE %s SET %s ';

        $data_to_update = $this->params($query);

        $query = sprintf($query, $this->table, $data_to_update);
        $query .= ' WHERE id=:id';

        $this->query = $this->pdo->prepare($query);
        $this->bind($data);

        return $this;
    }

    public function select(array $conditions = [])
    {
        $query = 'SELECT * FROM ' . $this->table;

        $data = $this->params($conditions);

        if (!empty($data)) {
            $query .= ' WHERE '. $data;
        }

        $this->query = $this->pdo->prepare($query);

        $this->bind($data);

        return $this;
    }

    public function delete(array $data = [])
    {

    }

    public function exec(string $query = null)
    {
        if (!empty($query)) {
            $this->query = $this->pdo->prepare($query);
        }

        $this->query->execute();
        return $this;
    }

    public function all(array $data = [])
    {
        return $this->query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function first(array $data = [])
    {
        return $this->query->fetch(\PDO::FETCH_ASSOC);
    }

    protected function params($conditions)
    {
        $fields = [];
        foreach ($conditions as $field => $value) {
            $fields[] = $field . '=:' . $field;
        }

        return implode(',', $fields);
    }

    public function bind($data)
    {
        foreach ($data as $field => $value) {
            $this->query->bindValue($field, $value);
        }
    }
}