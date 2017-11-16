<?php

class DBConnection {

    private $username;
    private $password;
    private $db_name;
    
    private $connection = null;
    
    private static $instance = null;

    function __construct($username = 'root', $password = '', $db_name = 'cook_book') {

        $this->username = $username;
        $this->password = $password;
        $this->db_name = $db_name;

        $this->createConnect();
    }

    public function createConnect() {

        if (!$this->connection) {

            $this->connection = new PDO('mysql:host=localhost;dbname=' . $this->db_name, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new DBConnection();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

}

