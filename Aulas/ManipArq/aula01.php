<?php 

$imagens = scandir("imagens"); 
$data = array();

foreach($imagens as $img){
    if(!in_array($img, array(".",".."))){

       $filename = "imagens" . DIRECTORY_SEPARATOR . $img;
       $info = pathinfo($filename);

       $info["size"] = filesize($filename);
       $info["modified"] = date("d/m/Y H:i:s", filemtime($filename));

       $info["url"] = "http://localhost/ProjetosCurso/Aulas/ManipArq/" .str_replace("\\", "/", $filename);

       array_push($data, $info);
    }
}

header('Content-Type: application/json; charset=utf-8');

echo json_encode($data, JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES);

?>