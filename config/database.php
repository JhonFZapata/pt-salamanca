<?php
// Conexión a la base de datos
$serverName = 'localhost\\sqlexpress';
$dbname = 'db_pt_salamanca';

// Conexión con autenticación de Windows
try {
    $pdo = new PDO("sqlsrv:Server=$serverName;Database=$dbname");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Habilitar excepciones
} catch (PDOException $e) {
    // En caso de error, mostrar mensaje y terminar la aplicación
    die("Error de conexión: " . $e->getMessage());
}
?>