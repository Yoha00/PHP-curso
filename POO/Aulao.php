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
    //echo $yoha->falar(); */

class Player{

    //////////////////////////////////
   //          Atributos          //
  ////////////////////////////////
    private $vida; //private priva que atribuam valores ou acessem atributos que estejam dentro da classe
    private $stamina;
    private $mana;
    private $aura;

    public function getVida(){ // get retorna o valor do dado. get e set geralmente não deixa acessar o atributo diretamente, usado mais para segurança
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

    public function Exibir(){ 
        echo "<br>";
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
$jogador ->setStamina("80"); 
$jogador ->setMana("20");
$jogador ->setAura("10000000000000000"); 

//print_r($jogador->Exibir()); 

/*class Documento {
    private $numero;

    public function getNumero(){
        return $this->numero;
    }

    public function setNumero($numero){
        $resultado = Documento::validarCPF($numero);
        if($resultado == false){
            throw new Exception("CPF informado não é válido.", 1);
        }
        $this->numero = $numero;
    }

    public static function validarCPF($cpf):bool {
        if(empty($cpf)) {
            return false;
        }

        $cpf = preg_match('/[0-9]/', $cpf) ? $cpf : 0;
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11) {
            return false;
        } else if ($cpf == '00000000000' || $cpf == '11111111111' || $cpf == '99999999999') {
            return false;
        } else {   
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }
            return true;
        }
    }
}*/

$cpf = new Documento();
$cpf -> setNumero(57368389827);

//var_dump($cpf->getNumero());

class Endereco {

	private $logradouro;
	private $numero;
	private $cidade;

	public function __construct($a, $b, $c){

		$this->logradouro = $a;
		$this->numero = $b;
		$this->cidade = $c;

	}

	public function __destruct(){

		// var_dump("DESTRUIR");

	}

    	public function __toString(){

		return $this->logradouro.", ".$this->numero." - ".$this->cidade;

	}

}

$meuEndereco = new Endereco("Av dos Bosques", "873", "São José dos Pinhais");

//echo $meuEndereco;

 /////////////////////
//  Encapsulamento //
////////////////////
class Pessoa {
    public $nome = "Yoha";
    protected $idade = 20;
    private $senha = "200522";

    public function Dados(){

        echo $this-> nome . "<br>";
        echo $this-> idade . "<br>";
        echo $this-> senha . "<br>";
    }
}

class Programador extends Pessoa { // estende da classe pessoa, conseguindo atribuir seus metodos e atributos

       /* public function Dados(){ A classe programador não consegue ver a senha do metodo pai, pois ela é privada, e privada não da para herdar.

        echo $this-> nome . "<br>";
        echo $this-> idade . "<br>";
        echo $this-> senha . "<br>";
    }*/ 

}



$objeto = new Programador();

//echo $objeto->nome. "<br>";

//$objeto->Dados();


////////////////////////////////////////////////
///////////////////  Herança //////////////////
class Documento {
    private $numero;

    public function getNumero(){
        return $this->numero;
    }

    public function setNumero($n){
        $this->numero = $n;
    }
}

class CPF extends Documento {
    public function Validar():bool{
        return true;
    }
}

$doc = new CPF();

/*$doc->setNumero("57368389827");

var_dump($doc->Validar());

echo "<br>";

echo $doc->getNumero();
*/

/*interface Veiculo{ // Ajuda com a integração de API's 
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

$carro-> trocarMarcha(3);*/


//---------------------------- Abstract class ---------------------------- //

interface Veiculo{ // Ajuda com a integração de API's 
    public function acelerar($velocidade);
    public function frenar($velocidade);
    public function trocarMarcha($marcha);
}

abstract class Automovel implements Veiculo {
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

class DelRey extends Automovel {
    public function empurrar(){
        echo "O veiculo está sendo empurrado";
    }
}

$carro = new DelRey();
//$carro-> acelerar(200);

// ---------------------------- Polimorfismo ---------------------------- // 

abstract class Animal {
    public function falar(){
        return "Som";
    }

    public function mover(){
        return "Anda";
    }
}

class Cachorro extends Animal {
    public function falar(){
        return "Late";
    }
}

class Gato extends Animal {
    public function falar(){
        return "Mia";
    }
}

class Passaro extends Animal {
    public function falar(){
        return "Canta";
    }

    public function mover(){
        return "Voa e " . parent::mover();
    }
}

/*$pluto = new Cachorro();
echo $pluto->falar(). "<br>";
echo $pluto->mover(). "<br>";
echo "----------------------<br>";
$garfield = new Gato(); 
echo $garfield->falar(). "<br>";
echo $garfield->mover(). "<br>";
echo "----------------------<br>";
$piupiu = new Passaro();
echo $piupiu->falar(). "<br>";
echo $piupiu->mover(). "<br>";*/

//---------------------------- Autoload ---------------------------- //
 
spl_autoload_register(function($nomeClasse) {
    $arquivo = $nomeClasse . ".php";
    
    if (file_exists($arquivo)) {
        require_once($arquivo);
    }
});

$carro = new DelRey();
$carro->acelerar(80);



//---------------------------- Namespaces ---------------------------- //

class Cadastro{

    private $nome;
    private $email;
    private $senha;


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

    public function __tostring(){
    return json_encode(array(
        'nome'=>$this->getNome(),
        'email'=>$this->getEmail(),
        'senha'=>$this->getSenha(),
    ));
    }

}
?>
