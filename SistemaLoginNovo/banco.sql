/* Criação do banco de dados e tabela de usuários */

CREATE DATABASE IF NOT EXISTS SistemaLoginNovo;

USE SistemaLoginNovo;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(200) NOT NULL UNIQUE,
    senha CHAR(40) NOT NULL, 
    perfil VARCHAR(20) NOT NULL DEFAULT 'USUARIO' CHECK (perfil IN ('ADMINISTRADOR', 'USUARIO'))
);


INSERT INTO usuario (email, senha, perfil) VALUES 
('lukas@gmail.com', SHA1('123'), 'USUARIO');




/* Achar meu banco e acessar minha ficha de usuario */
USE SistemaLoginNovo;
SELECT 
    * FROM 
    usuario 
WHERE 
    email = 'lukas@gmail.com' 
    AND senha = SHA1('123');



/* teste injeçao SQL */
SELECT * FROM usuario WHERE email = '' OR '1'='1' -- ' AND senha
SELECT * FROM usuario WHERE email = '' OR 1=1 --



-- Links http://localhost/SistemaLoginNovo/