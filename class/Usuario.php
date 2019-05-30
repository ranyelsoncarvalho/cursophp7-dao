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
        $result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));

        if(count($result) > 0){ //verificar se tem algum registro na tabela
            $row = $result[0];
            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro($row['dtcadastro']); //formatar o tipo da data
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
        $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN and dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if(count($result) > 0){ //verificar se tem algum registro na tabela
            $row = $result[0];
            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro($row['dtcadastro']); //formatar o tipo da data
        }
        else {
            throw new Exception("Login e/ou senha inválidos");
            
        }
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