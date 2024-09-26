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
        static::setConn();
        $tableName = static::$tableName;
        $query = "SELECT * FROM $tableName";
        $result = self::$connection->query($query);
        return $result->fetch_all(MYSQLI_BOTH);
    }
    static function Count()
    {

        $tableName = static::$tableName;
        $query = "SELECT count(*) FROM $tableName";
        $result = self::$connection->query($query);
        $count = $result->fetch_assoc();
        return $count['count(*)'];
    }
    static function CountWhere($column, $value)
    {
        self::setConn();
        if (!is_numeric($value)) {
            $value = "'$value'";
        }
        $tableName = static::$tableName;
        $query = "SELECT count(*) FROM $tableName WHERE $column = $value";
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
    public static function findColumn($column, $value, $comparisionOperator = "=")
    {
        self::setConn();
        if (!is_numeric($value)) {
            $value = "'$value'";
        }
        try {

            $sql = "SELECT * FROM " . static::$tableName . " WHERE $column $comparisionOperator $value";

            $result = self::$connection->query($sql);
            $row = $result->fetch_all(MYSQLI_BOTH);
            return $row;
        } catch (Exception $er) {
        }
    }
    public static function getLast()
    {
        $tableName = static::$tableName;
        $tableDescription = self::$connection->query("DESCRIBE " . $tableName);
        $row = $tableDescription->fetch_array();
        $idColumn = $row[0];
        $query = "SELECT * FROM $tableName ORDER BY $idColumn DESC LIMIT 1";
        $result = self::$connection->query($query);
        $row = $result->fetch_array();
        return $row;
    }
    public static function findColumns(array $columns, array $values, $comparisionOperator = null,  $operator = ' OR ')
    {
        self::setConn();
        $counter = 0;
        
        $condition = "";
        $comparisionOperator = is_null($comparisionOperator) && is_array($comparisionOperator) ? "=" : $comparisionOperator;
        $counter = 0;
        for ($i = 0 ; $i < count($columns) ;$i++) {
            $values[$i] = is_numeric($values[$i]) ? $values[$i] : "'".$values[$i]."'";
            $condition .= " ".$columns[$i]." " . (is_array($comparisionOperator) ? $comparisionOperator[$i] : "=") . " ".$values[$i]." $operator";
        }
        if ($operator == 'OR') {
            $condition =  substr($condition, 0, -2);
        } else if ($operator == 'AND') {
            $condition =  substr($condition, 0, -3);
        }
           // alerter($condition);
        try {
            $sql = "SELECT * FROM " . static::$tableName . " WHERE $condition";
            //alerter($sql);
            $result = self::$connection->query($sql);
            $row = $result->fetch_all(MYSQLI_BOTH);
            return $row;
        } catch (Exception $er) {
            alerter($er->getMessage());
        }
    }
    public static function Insert(array $columns, array $values)
    {
        self::setConn();
        $counter = 0;
        $data = [];
        $columnsStatement = "(";
        $valuesStatement = "(";
        foreach ($values as $value) {
            $data[$columns[$counter++]] = $value;
        }
        foreach ($data as $column => $value) {
            $value = is_numeric($value) ? $value : "'$value'";
            $columnsStatement .= " $column,";
            $valuesStatement .= " $value,";
        }
        $columnsStatement =  substr($columnsStatement, 0, -1);
        $valuesStatement =  substr($valuesStatement, 0, -1);
        $columnsStatement .= ")";
        $valuesStatement .= ")";

        $table = static::$tableName;
        try {
            $sql = "INSERT INTO $table $columnsStatement VALUES $valuesStatement";
            $result = self::$connection->query($sql);
            return $result;
        } catch (Exception $er) {
        }
    }
    public static function Update(array $columns, array $values,$id)
    {
        self::setConn();
        $counter = 0;
        $data = [];
        $updateStatement = "";
        foreach ($values as $value) {
            $data[$columns[$counter++]] = $value;
        }
        foreach ($data as $column => $value) {
            $value = is_numeric($value) ? $value : "'$value'";
            $updateStatement .= "$column = $value,";
        }
        $updateStatement =  substr($updateStatement, 0, -1);
        $tableName = static::$tableName;
        $tableDescription = self::$connection->query("DESCRIBE " . $tableName);
        $row = $tableDescription->fetch_array();
        $idColumn = $row[0];    
        $table = static::$tableName;
        try {
            $sql = "UPDATE $table SET $updateStatement WHERE $idColumn = $id";
            $result = self::$connection->query($sql);
            return $result;
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
