<?php 

try{

throw new Exception("Ocorreu um erro na pagina.", 404);

} catch(exception $e) {

    header('Content-Type: application/json; charset=utf-8');
    
    echo json_encode(array(
        "message"=>$e->getMessage(),
        "line"=>$e->getLine(),
        "file"=>$e->getFile(),
        "code"=>$e->getCode()
    ), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}


?>