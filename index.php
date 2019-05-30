<?php

Echo "Trabalhando com DAO - Data Access Object e PDO </br></br>";

require_once("config.php"); //chama o arquivo config.php

//$sql = new Sql(); //intancia a classe Sql

//$usuarios = $sql->select("SELECT * FROM tb_usuarios"); //comando para retornar os dados, já que existe a funcao SELECT na classe SQL

//echo json_encode($usuarios);

//carrega apenas um usuario
//$usuario = new Usuario();
//$usuario->loadbyId(1);
//echo $usuario;

//carrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

//carrega uma lista de usuarios, buscando pelo login
//$search = Usuario::search("jo");
//echo json_encode($search);

//carrega um usuario usando um login e senha
$usuario = new Usuario();
$usuario->login("cicrano", "qweasd");
echo $usuario;

?>