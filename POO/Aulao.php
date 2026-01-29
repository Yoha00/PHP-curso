<?php 

/////////////////////////////////////////////////////////////////////
// Irei fazer em apenas um arquivo. Fica mais facil de implementar//
// O que importa na classe é o que tem dentro, conteudo em si    //
//////////////////////////////////////////////////////////////////

/* 
• Objetos{
    • Variaveis -> Atributos (tem recursos a mais) -- Armazenar
    • Funções -> Métodos (Com recursos a mais) -- Executar
    }

    Intância = Quando irei usar a classe
    Objeto = Uma variável que representa uma classe
    Atributos fora do metodo usam $. Ja dentro do método não usam
    */

// ---------------------------- INTRODUÇÃO A CLASSES ---------------------------- // 

/*class Pessoa{
    public $nome; // Atributo

    public function falar(){ //Método 
        return "Meu nome é ".$this->nome;
    }   
}
    $yoha = new Pessoa();
    $yoha->nome = "Yohann";
    echo $yoha->falar();
*/

class Player{

    //////////////////////////////////
   //          Atributos          //
  ////////////////////////////////
    private $vida; //private priva que atribuam valores ou acessem atributos que estejam dentro da classe
    private $stamina;
    private $mana;
    private $aura;

    public function getVida(){ // get retorna o valor do dado
        return $this->vida;
    }

    public function setVida($vida){ // set atribui um novo valor e atribui ao atributo
        $this->vida = $vida;
    }
        public function getStamina(){
        return $this->stamina;
    }

    public function setStamina($stamina){
        $this->stamina = $stamina;
    }
        public function getMana(){
        return $this->mana;
    }

    public function setMana($mana){
        $this->mana = $mana;
    }

    public function getAura(){
        return $this->aura;
    }

    public function setAura($aura){
        $this->aura = $aura;
    }

    public function Exibir(){ //Irá exibir na tela
        return array(
            "vida"=>$this->getVida(),
            "stamina"=>$this->getStamina(),
            "mana"=>$this->getMana(),
            "aura"=>$this->getAura()
        );
    }
}

$jogador = new Player(); //Cria um novo personagem na memória
$jogador ->setVida("100"); //Mando o valor setado para o atributo privado vida
$jogador ->setStamina("80"); //Mando o valor setado para o atributo privado stamina
$jogador ->setMana("20"); //Mando o valor setado para o atributo privado mana
$jogador ->setAura("10000000000000000"); //Mando o valor setado para o atributo privado aura

print_r($jogador->Exibir());


?>