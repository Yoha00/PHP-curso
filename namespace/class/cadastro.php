<?php

//---------------------------- Namespaces ---------------------------- //

class Cadastro{

    //Atributos
    private $nome;
    private $email;
    private $senha;

    //Métodos Getters e Setters
    public function getNome():string{
    return $this->nome;
    }
    public function getEmail():string{
    return $this->email;
    }
    public function getSenha():string{
    return $this->senha;
    }

    public function setNome($nome){
    $this->nome = $nome;
    }
    public function setEmail($email){
    $this->email = $email;
    }
    public function setSenha($senha){
    $this->senha = $senha;
    }

    public function __tostring(){ //Método mágico que converte o objeto em string
    return json_encode(array( //Converte o objeto em um array associativo
        'nome'=>$this->getNome(),
        'email'=>$this->getEmail(),
        'senha'=>$this->getSenha(),
    ));
    }

}

?>