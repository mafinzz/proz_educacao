<?php 

$login = "matheus1";
$senha = "zeze9009";

if ($_POST["login"] == $login and $_POST["senha"] == $senha )
    {
        echo "<h4> Seja bem vindo(a), $login </h4>,";
        header (header: "refresh: 1; URL=formulas.html");
    }else{
        echo "<h4> Login ou senha invalidos: </h4>";
        header (header: "Refresh: 2; URL=index.html");
    }












?>