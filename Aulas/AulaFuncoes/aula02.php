<?php 

 //$a = 10;

 // & Passagem de parametro por referencia.
 /*function Pancreas(&$b) {
    $b += 30;
    return $b;
 }

 echo Pancreas($a);
 echo "<br>";
 echo $a; */


 
$pessoa = array(
	"nome"=>"Yohann",
	"idade"=>20
);

foreach ($pessoa as $value) {

	if (gettype($value) === 'integer') $value += 10;

	echo $value."<br/>";

}

print_r($pessoa);

?>