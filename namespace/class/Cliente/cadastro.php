<?php 

namespace Cliente; 

class Cadastro extends \Cadastro{ //Herda a classe Cadastro do namespace global
    public function registrarVenda(){ 
        echo "Venda registrada para o cliente " . $this->getNome(); //Utiliza o método getNome() da classe pai
    }
}

?>