<?php 
    class Database{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $password = DB_PASSWORD;
        private $name = DB_NAME;

        private $dbh;
        private $statement;
        private $error;

        public function __construct(){
            // Set DSN
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // Create a PDO instance
            try {
                $this->dbh = new PDO($dsn, $this->user, $this->password, $options);

            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Other database methods go here
        public function query($sql) {
            $this->statement = $this->dbh->prepare($sql);
        }
        

        //bind parameters
        public function bind($param, $value, $type = NULL) {
            if (is_null($type)) {
                switch (true) {
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
            }
            $this->statement->bindValue($param, $value, $type);
        }

        //Execute prepared statement
        public function execute() {
            return $this->statement->execute();
        }

        //get multiple records
        public function resultSet() {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        //get single record
        public function single() {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        //get row count
        public function rowCount() {
            return $this->statement->rowCount();
        }

        public function lastInsertId() {
            return $this->dbh->lastInsertId();
        }
    }

    

?>

