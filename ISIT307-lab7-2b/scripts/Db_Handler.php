<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'dotuan2311');
define('DB_DATABASE', 'ISIT307-lab7-exam');

class DBHandler
{

    private $conn;
    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function executeCountQuery($query)
    {
        $result = $this->conn->query($query) or die("Cannot execute query");
        $row = $result->fetch_array();
        return $row[0];

    }

    public function insertQuery($query, $type, $params)
    {
        $stmt = $this->prepareForQuery($query, $type, $params);

        $stmt->execute() or die($this->conn->error);
        $done = $stmt->affected_rows;
        $stmt->close();

        return $done;
    }

    public function deleteQuery($query, $type, $params)
    {
        $stmt = $this->prepareForQuery($query, $type, $params);

        $stmt->execute() or die($this->conn->error);
        $done = $stmt->affected_rows;
        $stmt->close();


        return $done;
    }


    public function prepareCountQuery($query, $type, $params)
    {
        $stmt = $this->prepareForQuery($query, $type, $params);

        $stmt->execute();

        /* Fetch result to array */
        $res = $stmt->get_result();
        $row = $res->fetch_array();
        $stmt->close();
        return $row[0];
    }

    public function updateQuery($query)
    {
        $this->conn->query($query) or die("Cannot execute query");
    }

    public function executeQuery($query)
    {
        $array = array();
        $result = $this->conn->query($query) or die("Cannot execute query");
        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }
        return $array;
    }

    public function prepareQuery($query, $type, $params)
    {
        $stmt = $this->prepareForQuery($query, $type, $params);
        $stmt->execute();

        $array = array();
        /* Fetch result to array */
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $array[] = $row;
        }
        $stmt->close();
        return $array;
    }

    private function refValues($arr)
    {
        if (strnatcmp(phpversion(), '5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = array();
            foreach ($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }

    public function close()
    {
        $this->conn->close();
    }

    /**
     * @param $query
     * @param $type
     * @param $params
     * @return mixed
     */
    private function prepareForQuery($query, $type, $params)
    {
        $args = array();
        $args[] = $type;
        $args = array_merge($args, $params);
        $stmt = $this->conn->prepare($query) or die("Cannot prepare query " . $this->conn->error);
        call_user_func_array(array($stmt, 'bind_param'), $this->refValues($args));
        return $stmt;
    }


}