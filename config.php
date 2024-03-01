<?php
 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'site');
 

function connect_db(){
    /* Tentativa de conexão com o banco de dados MySQL */
    try{
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Defina o modo de erro PDO para exceção
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e){
        die("ERROR: Não foi possível conectar." . $e->getMessage());
        return $e->getMessage();
    }
}
?>