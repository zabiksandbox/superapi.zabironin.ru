<?php


    class db{
        // Properties
        private $dbhost = 'localhost';
        private $dbuser = 'curr';
        private $dbpass = '5Z1v7D7u';
        private $dbname = 'currency';

        // Connect
        public function connect(){
            $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname;charset=utf8";
            $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbConnection;
        }
    }