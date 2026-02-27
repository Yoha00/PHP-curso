<?php 
/*$file = fopen("log.txt", "a+"); //fopen() = abre um arquivo ou URL e retorna um ponteiro para o arquivo, o primeiro parâmetro é o nome do arquivo e o segundo parâmetro é o modo de abertura do arquivo, a+ = abre o arquivo para leitura e escrita, se o arquivo não existir ele é criado, w+ = abre o arquivo para leitura e escrita, se o arquivo existir ele é apagado e criado um novo.

fwrite($file,date("Y-m-d H:i:s") . "\r\n"); //escreve a data e hora atual no arquivo, \r\n é usado para pular para a próxima linha

fclose($file); //fecha o arquivo

echo "O arquivo foi criado";*/ 

require_once("config.php"); //Faz tratamento de erros e o _once garante a inclusão apenas uma vez, evite inclusão multipla do mesmo

$stmt = $conn->prepare("SELECT * FROM cadastro ORDER BY nome");
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$headers = array();

foreach($usuarios[0] as $key => $value){ //foreach para percorrer o primeiro elemento do array de usuários, onde $key é o nome da coluna e $value é o valor da coluna
    array_push($headers, ucfirst($key)); //ucfirst() = converte a primeira letra para maiúscula
}
    $file = fopen("usuarios.csv", "w+"); //.csv é um arquivo de texto separado por virgula
    fwrite($file, implode(";", $headers) . "\r\n"); //implode() = junta os elementos do array em uma string e separa por ";"

    foreach($usuarios as $row){ //$row é cada linha do array de $usuarios
        $data = array(); //$data é um array vazio para armazenar os valores de cada linha
        foreach($row as $key => $value){
            array_push($data, $value); //array_push() = adiciona um elemento no final do array
         }
    }

fclose($file);
?>