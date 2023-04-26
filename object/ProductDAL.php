<?php
class ProductDAL
{
    public $connect;
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $databaseName = "faion";
    public $result;
    public $sql;
    public $result_query = null;
    public $error = array();

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {
        try {
            if ($this->connect = mysqli_connect($this->hostname, $this->username, $this->password, $this->databaseName)) {
                return $this->connect;
            } else {
                throw new Exception("Khong the ket noi den CSDL <br>");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function select($sql = NULL)
    {
        if ($sql == NULL) {
            $this->result_query = mysqli_query($this->connect, "SELECT * FROM product");    //mặt định lấy table dienthoai
        } else {
            $this->result_query = mysqli_query($this->connect, $sql);
        }
        return $this->result_query;
    }

    public function select_count()
    {
        return mysqli_num_rows($this->result_query);
    }

    public function getResultQuery() {
        return $this->result_query;
    }

    // public function fetch_array_table($result = NULL)
    // {
    //     if ($result == NULL)
    //         if (is_resource($this->result_query))
    //             return mysqli_fetch_assoc($this->result_query);
    //     return NULL;
    // }
}
