<?php 
/*
 $pessoas [0][0] = "Yohann";
 $pessoas [0][1] = "Carlos";
 $pessoas [0][2] = "Cris";

 $pessoas [1][0] = "Neymar";
 $pessoas [1][1] = "Messi";
 $pessoas [1][2] = "Cristiano Ronaldo";

 echo $pessoas [0][0];
 echo end($pessoas[1]);
*/

$pessoas = array();

array_push($pessoas, array(
    "nome"=> "Yohann",
    "idade"=> "20"
));

array_push($pessoas, array(
    "nome"=> "candico",
    "idade"=> "50"
    ));

    // json_encode transforma array em code json
    echo json_encode($pessoas);

    // json_decode tranforma code json em array

?>