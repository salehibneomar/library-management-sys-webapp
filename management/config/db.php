<?php

    final class DB {

        private static $singletonInstance = null;

        private static $host              = "127.0.0.1";
        private static $user              = "root";
        private static $password          = "";
        private static $database          = "ssb280_library_management_sys";
        private static $connection        = null;

        final private function __construct(){}

        public final static function getConnection(){
            if(self::$singletonInstance==null){
                self::$singletonInstance = new DB();
            }

            try{
                self::$connection = new mysqli( self::$host, self::$user, self::$password, self::$database );
            }
            catch(Exception $e ){
                die("Failed to established connection!<br>"."EXCEPTION: ".$e);
            }

            return self::$connection;
        }

        public final static function getDBproperty(){
            $dbProperty = array(
                'user' => self::$user,
                'pass' => self::$password,
                'db'   => self::$database,
                'host' => self::$host
            );

            return $dbProperty;
        }

    }

    $conn = DB::getConnection();

    if(!$conn){
        die(DB::getConnection()->connect_errno);
    }



    

?>