<?php

namespace Model;

use Exception;

abstract class Table
{

    protected static $tableName;
    protected static $connection;
    public static function setConn()
    {
        static::$connection = new \mysqli('localhost', 'root', '', 'on_time');
    }
    public static function close()
    {
        static::$connection = new \mysqli('localhost', 'root', '', 'on_time');
    }

    static function All()
    {

        $tableName = static::$tableName;
        $query = "SELECT * FROM $tableName";
        $result = self::$connection->query($query);
        return $result->fetch_all();
    }
    static function Count()
    {
        $tableName = static::$tableName;
        $query = "SELECT count(*) FROM $tableName";
        $result = self::$connection->query($query);
        $count = $result->fetch_assoc();
        return $count['count(*)'];
    }
    static function Find(int $id)
    {
        $tableName = static::$tableName;
        $tableDescription = self::$connection->query("DESCRIBE " . $tableName);
        $row = $tableDescription->fetch_array();
        $idColumn = $row[0];
        $query = "SELECT * FROM $tableName WHERE $idColumn = $id";
        $result = self::$connection->query($query);
        $row = $result->fetch_assoc();
        return $row;
    }
    public static function findColumn($column, $value)
    {
        self::setConn();
        if (!is_numeric($value)) {
            $value = "'$value'";
        }
        try {

            $sql = "SELECT * FROM " . static::$tableName . " WHERE $column = $value";
            echo $sql;
            $result = self::$connection->query($sql);
            $row = $result->fetch_assoc();
            return $row;
        } catch (Exception $er) {
            
        }
    }
    static function Delete(int $id)
    {
        $tableName = static::$tableName;
        $tableDescription = self::$connection->query("DESCRIBE " . $tableName);
        $row = $tableDescription->fetch_array();
        $idColumn = $row[0];
        $query = "DELETE FROM $tableName WHERE $idColumn = $id";
        self::$connection->query($query);
    }
}
