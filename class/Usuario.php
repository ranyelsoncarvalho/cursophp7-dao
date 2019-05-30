<?php

class Usuario{

    //informar as colunas que estão presentes no banco de dados
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario(){
        return $this->idusuario;
    }
    public function setIdusuario($value){
        $this->idusuario = $value;
    }

    public function getDeslogin(){
        return $this->deslogin;
    }
    public function setDeslogin($value){
        $this->deslogin = $value;
    }

    public function getDessenha(){
        return $this->dessenha;
    }
    public function setDessenha($value){
        $this->dessenha = $value;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }
    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }

    public function loadbyId($id){ //traz apenas um unico usuario do banco
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));

        if(count($results) > 0){ //verificar se tem algum registro na tabela
            $this->setData($results[0]);
        }
    }

    //lista todos os usuarios cadastrados
    public function getList(){
        $sql = new Sql;
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario");
    }

    //metodo para buscar um usuario
    public function search($login){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY idusuario", array(
            ':SEARCH'=>"%".$login."%"
        ));

    }

    //metodo de login com autenticacao
    public function login($login, $password){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN and dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if(count($results) > 0){ //verificar se tem algum registro na tabela
            $this->setData($results[0]);
        }
        else {
            throw new Exception("Login e/ou senha inválidos");
            
        }
    }


    //metodo para receber os dados
    public function setData($data){
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro($data['dtcadastro']);
    }

    //metodo para inserir dados no banco
    public function insert(){

        $sql = new Sql();
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array( //utilizando procedure, para a inserção de dados no banco
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));

        if (count($results) > 0){
            $this->setData($results[0]);
        }

    }

    public function __construct($login = "", $password = ""){ //metodo construtor, para a inserção de usuarios
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }

    public function update($login, $password){ //atualização dos registros no banco
        $this->setDeslogin($login);
        $this->setDessenha($password);
        
        $sql = new Sql();
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()
        ));
    }

    public function __toString(){ //retorna a impressao na tela para o usuario
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()
        ));
    }

}

?>