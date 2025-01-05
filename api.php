<?php
// Database connection
$host = 'localhost';
$dbname = 'thedocs';
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['status' => 'error', 'message' => $e->getMessage()]));
}

// Helper function to send JSON responses
function sendResponse($status, $data, $message = null) {
    header('Content-Type: application/json');
    echo json_encode(['status' => $status, 'data' => $data, 'message' => $message]);
    exit;
}

// Get the requested endpoint
$requestUri = trim($_SERVER['REQUEST_URI'], '/');
$scriptName = trim($_SERVER['SCRIPT_NAME'], '/');
$endpoint = str_replace($scriptName, '', $requestUri);
$endpoint = trim($endpoint, '/');

switch ($endpoint) {
    case 'random-images':
        $stmt = $pdo->query("SELECT id, url, description FROM images ORDER BY RAND() LIMIT 10");
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        sendResponse('success', $images);
        break;

    case 'random-posts':
        $stmt = $pdo->query("SELECT id, title, body, created_at FROM posts ORDER BY RAND() LIMIT 10");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        sendResponse('success', $posts);
        break;

    case 'random-users':
        $stmt = $pdo->query("SELECT id, name, email, created_at FROM users ORDER BY RAND() LIMIT 10");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        sendResponse('success', $users);
        break;

    case 'insert':
        // Read raw input
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        // Validate data
        if (!isset($data['type']) || !isset($data['data'])) {
            sendResponse('error', null, 'Missing required fields: type or data');
        }

        $type = $data['type'];
        $insertData = $data['data'];

        try {
            if ($type === 'images') {
                $stmt = $pdo->prepare("INSERT INTO images (url, description) VALUES (:url, :description)");
                $stmt->execute([
                    ':url' => $insertData['url'],
                    ':description' => $insertData['description'] ?? null
                ]);
            } elseif ($type === 'posts') {
                $stmt = $pdo->prepare("INSERT INTO posts (title, body) VALUES (:title, :body)");
                $stmt->execute([
                    ':title' => $insertData['title'],
                    ':body' => $insertData['body']
                ]);
            } elseif ($type === 'users') {
                $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
                $stmt->execute([
                    ':name' => $insertData['name'],
                    ':email' => $insertData['email']
                ]);
            } else {
                sendResponse('error', null, 'Invalid type specified');
            }

            sendResponse('success', null, 'Data inserted successfully');
        } catch (PDOException $e) {
            sendResponse('error', null, 'Database error: ' . $e->getMessage());
        }
        break;

    default:
        sendResponse('error', null, 'Invalid endpoint');
}
?>
