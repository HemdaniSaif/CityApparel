<?php

class CreateDb
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

    // class constructor
    public function __construct($dbname, $tablename, $servername, $username, $password)
    {
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;

        // create connection
        $this->con = mysqli_connect($servername, $username, $password);

        // Check connection
        if (!$this->con) {
            die("Connection failed : " . mysqli_connect_error());
        }

        // query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // execute query
        if (mysqli_query($this->con, $sql)) {

            $this->con = mysqli_connect($servername, $username, $password, $dbname);

            if ($tablename == "usersDB") {
                // sql to create new table
                $usersDBsql = " CREATE TABLE IF NOT EXISTS $tablename
                        (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        fname VARCHAR (25),
                        lname VARCHAR(25),
                        email VARCHAR (100),
                        pword VARCHAR (25)
                        );";
                if (!mysqli_query($this->con, $usersDBsql)) {
                    echo "Error creating table : " . mysqli_error($this->con);
                }
            } else {
                // sql to create new table
                $productDBsql = " CREATE TABLE IF NOT EXISTS $tablename
                        (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        product_name VARCHAR (1000) NOT NULL,
                        product_price VARCHAR(10),
                        product_description VARCHAR (1000),
                        product_image VARCHAR (100)
                        );";
                if (!mysqli_query($this->con, $productDBsql)) {
                    echo "Error creating table : " . mysqli_error($this->con);
                }
            }
        }
    }

    // get product from the database
    public function getData()
    {
        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->con, $sql);

        if ($result != null) {
            if (mysqli_num_rows($result) > 0) {
                return $result;
            }
        }
    }
    public function getConnection()
    {
        return $this->con;
    }
}
