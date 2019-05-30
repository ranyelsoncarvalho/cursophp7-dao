<?php

Echo "Trabalhando com DAO - Data Access Object e PDO </br>";

require_once("config.php"); //chama o arquivo config.php

$sql = new Sql(); //intancia a classe Sql

$usuarios = $sql->select("SELECT * FROM tb_usuarios"); //comando para retornar os dados, já que existe a funcao SELECT na classe SQL

echo json_encode($usuarios);

?>