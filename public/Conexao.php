
<?php

$host = getenv('MYSQLHOST') ?: getenv('DB_HOST');
$dbname = getenv('MYSQLDATABASE') ?: getenv('DB_DATABASE');
$usuario = getenv('MYSQLUSER') ?: getenv('DB_USERNAME');
$senha = getenv('MYSQLPASSWORD') ?: getenv('DB_PASSWORD');
$porta = getenv('MYSQLPORT') ?: getenv('DB_PORT') ?: '3306';

try {
    if (!$host || !$dbname || !$usuario || $senha === false) {
        throw new Exception(
            'Configure as variáveis do banco de dados no Railway.'
        );
    }

    $pdo = new PDO(
        "mysql:host=$host;port=$porta;dbname=$dbname;charset=utf8mb4",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    die('Erro ao conectar ao banco de dados.');
} catch (Exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    die($e->getMessage());
}
?>
