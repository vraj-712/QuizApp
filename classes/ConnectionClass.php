<?php
class DataBase
{
    public $servername;
    public $username;
    public $password;
    public $databasename;
    public $conn;
    public function __construct($servername, $username, $password, $databasename)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->databasename = $databasename;
        $this->conn = $this->connectToDatabase();

    }

    public function connectToDatabase()
    {

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->databasename);

        if (!($conn->error)) {
            return $conn;
        } else {
            return "Error Occur !! Please Check Connection Parameter";
        }
    }
    public function selectQuery($table, $column = "*", $para = null){

        if ($para != null) {

            $sql = "SELECT $column FROM $table $para";
        } else {

            $sql = "SELECT $column FROM $table";

        }

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {

            $temp = [];
            while ($row = $result->fetch_assoc()) {

                $temp[] = $row;

            }
            return $temp;

        } else { return []; }

    }
    public function insert($table, $column, $data, $where = null){
        
        $sql = "INSERT INTO $table (`$column`) VALUES ('$data')";
        $result = $this->conn->query($sql);

        if ($result === True) {
            return 1;
        } else {
            return 0;
        }

    }
    public function update($table, $data, $cond = null){

        $setClause = "";
        $condition = "";

        foreach ($data as $column => $value) {
            $setClause .= "$column = '$value', ";
        }

        foreach ($cond as $key => $value) {
            $condition .= "$key = '$value',";
        }

        $setClause = rtrim($setClause, ', ');
        $condition = rtrim($condition, ',');
        $sql = "UPDATE $table SET $setClause WHERE $condition";
        $result = $this->conn->query($sql);

        return $result;
    }
}

?>