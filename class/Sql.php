<?php

//DAO -- permite que com faça a ligação das classes com o banco de dados

class Sql extends PDO { //extende já do PDO vinculado do PHP

    private $conn;

    public function __construct() { //quando fizer uma nova instancia dessa classe, faça a conexao automatica com o banco de dados --> metodo construtor
        $this->conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root",""); //conexao com o banco de dados
    }

    private function setParams($statement, $parameters = array()){
        foreach ($parameters as $key => $value) { //percorrer os valores dentro do banco
            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam($statement, $key, $value){ //chamando os parametros de forma separada
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array()){ //executar algum comando no banco
        //rawQuery --> consulta bruta, a query que será tratada
        //params --> receber os parametros

        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;
    }

    public function select($rawQuery, $params = array()):array{ //função para selecionar os dados que estão armazenados no banco
        
        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC); //retornar os dados sem os paramêtros.
    }

}

?>