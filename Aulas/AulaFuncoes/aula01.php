<?php
/*
function ola($texto = "mundo", $periodo  = "Bom dia") {
    return "Ola $texto! $periodo <br>";
}

echo ola ();
echo ola ("", "Boa noite");
echo ola ("Yohann", "Boa tarde");*/

    function ola(){

        $argumentos = func_get_args(); 

        return $argumentos[0];
    }

    
    var_dump(ola("Bom dia"), 10);

?>