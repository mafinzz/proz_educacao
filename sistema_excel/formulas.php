<link rel="stylesheet" href="style.css">
<?php 

$num1 = $_POST['num1'];
$num2 = $_POST['num2'];


function soma($num1, $num2)
{
    return $num1 + $num2;
}

function subtracao($num1, $num2)
{
    return $num1 - $num2;
}

function mult($num1, $num2)
{
    return $num1 * $num2;
}

function divisao($num1, $num2)
{
    return $num1 / $num2;
}

// echo "<div class='container'>";
// echo "<h4> A soma de $num1 e $num2 é ".soma($num1, $num2)."</h4>";
// echo "<h4> A subtração de $num1 e $num2 é ".subtracao($num1, $num2)."</h4>";
// echo "<h4> A multiplicação de $num1 e $num2 é ".mult($num1, $num2)."</h4>";
// echo "<h4> A divisão de $num1 e $num2 é ".divisao($num1, $num2)."</h4></div>";

// echo "<div class='container'><h4> <a href='formulas.html'> tente outros numeros </a></h4>";
// echo "<h4> <a href='index.html'> Sair</a> </h4>";
// echo "</div>";

echo <<< HTML
<div


?>


