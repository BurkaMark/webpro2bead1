<?php
    class Database
    {
        /* Private variables */
        private $dbHost = DB_HOST;
        private $dbUser = DB_USER;
        private $dbPass = DB_PASS;
        private $dbName = DB_NAME;

        private $dbHandler;
        private $error;
        private $statement;

        /* Constructor */
        public function __construct()
        {
            $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
            $options = array(   PDO::ATTR_PERSISTENT => true,
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

            try
            {
                $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
            }
            catch(PDOException $e)
            {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        /* Query input SQL command */
        public function query($sql)
        {
            $this->statement = $this->dbHandler->prepare($sql);
        }

        /* Bind input parameter with the input value as a type of stated in input type */
        public function bind($parameter, $value, $type = null)
        {
            switch(is_null($type))
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                $type = PDO::PARAM_STR;
            }

            $this->statement->bindValue($parameter, $value, $type);
        }

        /* Execute function */
        public function execute()
        {
            return $this->statement->execute();
        }

        /* Get all records from DB */
        public function resultSet()
        {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        /* Get a single record from DB */
        public function single()
        {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        /* Count the number of rows in DB */
        public function rowCount()
        {
            return $this->statement->rowCount();
        }
    }
?>