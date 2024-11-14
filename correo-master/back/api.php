<?php
header("Content-Type: application/json");

$dsn = 'mysql:host=db;dbname=proyectodocker;charset=utf8';
$username = 'root';
$password = 'root';

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Obtener todos los productos
        $stmt = $conn->query("SELECT * FROM productos");
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Crear un nuevo producto
        $input = json_decode(file_get_contents('php://input'), true);
        $stmt = $conn->prepare("INSERT INTO kebab (nombre, precio, stock) VALUES (:nombre, :precio)");
        $stmt->bindParam(':nombre', $input['nombre']);
        $stmt->bindParam(':precio', $input['precio']);
       
        $stmt->execute();
        echo json_encode(['status' => 'Kebab creado']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
