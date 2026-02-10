<?php 

class postgressql extends PDO {
    private $conn;

    public function __construct(){
        // Note: Se você usa $this->conn, você está criando um objeto PDO dentro da sua classe
        $this->conn = new PDO("pgsql:host=localhost;port=5432;dbname=Cadastro", "postgres", "acess");
    }

    private function setParams($statment, $parameters = array()){
        foreach($parameters as $key => $value){
            // Aqui você passa o statement para o próximo método
            $this->setParam($statment, $key, $value);
        }
    }

    private function setParam($statment, $key, $value){
        $statment->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt; 
    }
    
    public function select($rawQuery, $params = array()):array
    {
       $stmt = $this->query($rawQuery, $params);

       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>