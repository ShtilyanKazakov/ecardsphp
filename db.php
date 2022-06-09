<?php

class DatabaseClient
{

    private $host;
    private $username;
    private $password;
    private $db;
    protected $conn;
    public $lastError;

    public function __construct()
    {
        $this->db_connect();
    }

    private function db_connect()
    {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = 'root';
        $this->db = 'testimonial_ecards_db';

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db);
        return $this->conn;
    }

    /**
     * Execute sql that doesn't return a result
     *
     * @param $sql Sql query, INSERT, UPDATE, DELETE
     *
     * @return mixed True on success or error message
     */
    public function execSql($sql)
    {
        if (mysqli_query($this->conn, $sql) != false) {
            return true;
        } else {
            return $this->conn->error;
        }
    }

    // insert
    public function insert($tableName, array $columns, array $values)
    {
        $columnsList = implode(", ", $columns);
        $valuesList = implode("','", $values);
        $valuesList = "'" . $valuesList . "'";
        $insert_sql = 'INSERT INTO ' . $tableName . ' (' . $columnsList . ')' . ' VALUES ' . '(' . $valuesList . ')';
        return mysqli_query($this->db_connect(), $insert_sql);
    }

    public function insert_ignore($tableName, array $columns, array $values)
    {
        $columnsList = implode(", ", $columns);
        $valuesList = implode("','", $values);
        $valuesList = "'" . $valuesList . "'";
        $insert_sql = 'INSERT IGNORE INTO ' . $tableName . ' (' . $columnsList . ')' . ' VALUES ' . '(' . $valuesList . ')';
        return mysqli_query($this->db_connect(), $insert_sql);
    }

    public function select($tableName, array $columns, $where = '1=1', $order_by = 'id')
    {
        $columnsList = implode(", ", $columns);
        $sql = "SELECT $columnsList FROM $tableName WHERE $where ORDER BY $order_by DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function select_and($tableName, array $columns, $where1, $where2, $order_by = 'id')
    {
        $columnsList = implode(", ", $columns);
        $sql = "SELECT $columnsList FROM $tableName WHERE $where1 AND $where2 ORDER BY $order_by DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function select_sum($tableName, array $columns, $where = '1=1', $order_by = 'id')
    {
        $columnsList = implode(", ", $columns);
        $sql = "SELECT SUM($columnsList) FROM $tableName WHERE $where ORDER BY $order_by";

        return mysqli_query($this->conn, $sql);
    }

    public function select_where($table_name, $where_condition)
    {
        $condition = '';
        $array = array();
        foreach ($where_condition as $key => $value) {
            $condition .= $key . " = '" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $query = "SELECT * FROM " . $table_name . " WHERE " . $condition;
        $result = mysqli_query($this->db_connect(), $query);
        while ($row = mysqli_fetch_array($result)) {
            $array[] = $row;
        }
        return $array;
    }


    public function update($table_name, $fields, $where_condition)
    {
        $query = '';
        $condition = '';
        foreach ($fields as $key => $value) {
            $query .= $key . "='" . $value . "', ";
        }
        $query = substr($query, 0, -2);
        /*This code will convert array to string like this-
        input - array(
             'key1'     =>     'value1',
             'key2'     =>     'value2'
        )
        output = key1 = 'value1', key2 = 'value2'*/
        foreach ($where_condition as $key => $value) {
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        /*This code will convert array to string like this-
        input - array(
             'id'     =>     '5'
        )
        output = id = '5'*/
        $query = "UPDATE " . $table_name . " SET " . $query . " WHERE " . $condition;
        if (mysqli_query($this->db_connect(), $query)) {
            return true;
        }
    }


    // delete
    public function delete($tableName, array $columns, array $values)
    {
        $columnsList = implode(", ", $columns);
        $valuesList = implode(", ", $values);
//            $valuesListString = explode(' ', $valuesList);
        $delete_sql = "DELETE FROM $tableName WHERE $columnsList = $valuesList LIMIT 1";

        return mysqli_query($this->db_connect(), $delete_sql);

    }

    public function close_connection()
    {
        $connection = $this->db_connect();
        if (isset($connection)) {
            $connection->close();
            unset($connection);
        }
    }


    public function real_escape_string($string)
    {
        // todo: make sure your connection is active etc.
        return $this->conn->real_escape_string($string);
    }

    public function mysqli_query_func($query)
    {
        return mysqli_query($this->db_connect(), $query);
    }

    public function __destruct()
    {
        mysqli_close($this->conn);
    }


}

//$dbClient = new DatabaseClient();
//$connect= $db->conn;
//$db->db_num("SELECT * FROM users");


// Separate classes for Users, Tweets, Uploads ....
?>