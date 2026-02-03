<?php 

interface Veiculo{ // Ajuda com a integração de API's 
    public function acelerar($velocidade);
    public function frenar($velocidade);
    public function trocarMarcha($marcha);
}

class Civic implements Veiculo {
    public function acelerar($velocidade){
        echo "O veiculo acelerou até " . $velocidade . "km/h";
    }   
    public function frenar ($velocidade){
        echo "O veiculo frenou até ". $velocidade . "km/h";
    } 
    public function trocarMarcha($marcha){
        echo "O veiculo trocou para a marcha ". $marcha;
    }  
}

$carro = new Civic();

$carro-> trocarMarcha(3);


?>