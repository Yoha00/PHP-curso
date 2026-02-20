<?php 
/*$file = fopen("log.txt", "a+");

fwrite($file,date("Y-m-d H:i:s") . "\r\n");

fclose($file);

echo "O arquivo foi criado";*/

require_once("config.php");

$stmt = $conn->prepare("SELECT * FROM cadastro ORDER BY nome");
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$headers = array();

foreach($usuarios[0] as $key => $value){
    array_push($headers, ucfirst($key));
}
    $file = fopen("usuarios.csv", "w+");    
    fwrite($file, implode(";", $headers) . "\r\n");

    foreach($usuarios as $row){
        $data = array();
        foreach($row as $key => $value){
            array_push($data, $value);
         }
    }

fclose($file);
?>