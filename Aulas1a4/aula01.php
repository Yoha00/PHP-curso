<?php 

    //////////////////////- Anotação -////////////////////////////////
    // - Usar . sempre que precisar juntar uma frase com uma variavel. 
    // - Comando para ver o tipo da sua variavel: var_dump($nome);
    // - Aspas duplas interpola uma o que tem na frase, tipo "Meu nome é $nome. Resultaria em exemplo "Meu nome é Claudio".
    // - Aspas simples não interpola, o que pelo contrario resultaria em apenas "Meu nome é $nome".
    //////////////////////////////////////////////////////////////////

    /////////////////// - Variaveis //////////////////////////////////
    $nome = "Yohann\n";

    $sobrenome = "Queiroz\n";

    $nomeCompleto = $nome . " " . $sobrenome; // " " para dar um espaço no nome com sobrenome.
    //////////////////////////////////////////////////////////////////

    //echo 'Meu nome é '. $nome .'!';

    echo "Nome: " . $nome . "<br>"; // <br> apenas para pular linha no navegador
    echo "Sobrenome: ". $sobrenome . "<br>";
    echo "Nome Completo: " . $nomeCompleto;

    exit; // - Roda apenas o que estiver acima disso. Aqui ele fecha

    echo ($nome);

    echo "\n";
    
    unset($nome); // unset limpa a variavel

    if(isset($nome))
    {
        echo $nome;
    }
?>