<?php
session_start();
ini_set('display_errors', 1);

if (isset($_POST['email']) && isset($_POST['senha'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $conexao = mysqli_connect('127.0.0.1', 'root', '', 'SistemaLoginNovo');
        $email = $_POST['email'];
        $senha = sha1($_POST['senha']); 

        $stmt = $conexao->prepare(
            "SELECT email, senha, perfil FROM usuario WHERE email = ? AND senha = ?"
        );

        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

//meio que cria uma saida html sem arquivos separados
        $html_content = '';
        $redirect_url = '';

        if ($rows = $result->fetch_assoc()) {
            
        
            $_SESSION['logado'] = true; 
            $_SESSION['perfil'] = $rows['perfil']; 
            $redirect_url = 'home.html';

            // Resposta de sucesso usando tailwind, da pra excluir do codigo sem problemas
            $html_content = '
                <div class="max-w-md w-full p-8 rounded-3xl relative z-10 
                           bg-white/10 backdrop-blur-xl border border-white/20 shadow-xl-custom text-center">
                    
                    <h1 class="text-2xl font-bold mb-4">✅ Login Bem-Sucedido!</h1>
                    <p class="text-lg text-purple-300 mb-4">Redirecionando para a área do usuário...</p>
                    <p class="text-sm text-white/70">Perfil de acesso: <strong class="font-semibold">' . htmlspecialchars($rows['perfil']) . '</strong></p>
                    
                    <div class="mt-6 w-full py-3 rounded-xl font-bold transition-all transform 
                                bg-gradient-to-r from-cyan-app via-purple-app to-purple-app shadow-lg shadow-purple-app/50">
                                Entrando...
                    </div>
                </div>';

        } else {
            
            // Destroi a sessão que foi criada com "session start" em caso de erro e manda de volta pro index
            session_unset(); 
            session_destroy(); 
            $redirect_url = 'index.html';

            // Conteúdo HTML de Falha no login usando tailwind
            $html_content = '
                <div class="max-w-md w-full p-8 rounded-3xl relative z-10 
                           bg-white/10 backdrop-blur-xl border border-white/20 shadow-xl-custom text-center">
                    
                    <h1 class="text-2xl font-bold mb-4">❌ Falha no Login</h1>
                    <p class="text-lg text-red-400 mb-4">E-mail ou senha incorretos. Tente novamente!</p>
                    <p class="text-sm text-white/70">Redirecionando para a página de login em 2 segundos...</p>

                    <div class="mt-6 w-full py-3 rounded-xl font-bold bg-red-600 shadow-lg shadow-red-600/50">
                                Falha na Autenticação
                    </div>
                </div>';
        }

        $stmt->close();
        $conexao->close();

        // 3. Vai mostrar o html e redirecionar depois de 2 segundos baseado no if e else
        header("Refresh: 2; URL={$redirect_url}");

        // customizaçao do fundo e configuraçao pro tailwind css funcionar
        $custom_style = '
            <style>
                body { 
                    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; 
                    /* Cor Roxo Escuro: #281B3C */
                    background-color: #281B3C;
                }
                /* Para garantir que não haja imagem de fundo caso tenha sido setada antes */
                .bg-black { background-color: #281B3C !important; }
            </style>';

        echo '<!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Processando Login</title>
            ' . $custom_style . '
            <script src="https://cdn.tailwindcss.com"></script>
            <script>
                tailwind.config = {
                    theme: {
                        extend: {
                            colors: {
                                "cyan-app": "#06b6d4", 
                                "purple-app": "#8b5cf6", 
                            },
                            boxShadow: {
                                "xl-custom": "0 22px 60px rgba(0, 0, 0, 0.25)",
                            }
                        }
                    }
                }
            </script>
        </head>
        <body class="bg-black text-white overflow-hidden">'; 
        
        // Fazer a mensagen de erro ou sucesso ficar no centro
        echo '<div class="flex items-center justify-center min-h-screen p-6">'; 
        
        // vai chamar oque estiver escrito na variavel html_content
        echo $html_content;

        echo '</div>'; 
        
        echo '</body>';
        echo '</html>';
        
        exit;
    }
} 
?>