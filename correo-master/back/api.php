<?php
header("Content-Type: application/json");

// Añadir encabezados CORS
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type"); // Encabezados permitidos

// Si el navegador hace una solicitud OPTIONS (preflight), solo devuelve una respuesta exitosa
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$dsn = 'mysql:host=db;dbname=proyectodocker;charset=utf8';
$username = 'root';
$password = 'root';

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $stmt = $conn->query("SELECT * FROM kebab");
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("INSERT INTO kebab (nombre, precio) VALUES (:nombre, :precio)");
        $stmt->bindParam(':nombre', $input['nombre']);
        $stmt->bindParam(':precio', $input['precio']);
        $stmt->execute();
        echo json_encode(['status' => 'Kebab creado']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
