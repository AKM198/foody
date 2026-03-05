<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$host = 'localhost';
$dbname = 'foody';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $action = $_GET['action'] ?? 'products';
    
    if ($action === 'products') {
        $stmt = $pdo->query("SELECT id, name, category, price, SUBSTRING(description, 1, 50) as rating FROM products WHERE is_available = 1 LIMIT 20");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $data]);
    } 
    elseif ($action === 'stats') {
        $stmt = $pdo->query("SELECT category, COUNT(*) as count FROM products WHERE is_available = 1 GROUP BY category");
        $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $stats]);
    }
    
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
