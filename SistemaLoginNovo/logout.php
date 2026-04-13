<?php
// Inicia a sessão para poder manipulá-la
session_start();

// 1. Limpa todas as variáveis de sessão pra nao ter risco de bugar

$_SESSION = array(); // Garante que o array $_SESSION esteja vazio

// 2. Destrói a sessão que foi criada com session start (remove os dados do servidor)
session_destroy();

// 3. Redireciona para a página inicial/login
header("Location: index.html");
exit;
?>