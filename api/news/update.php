<?php
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Origin: *");

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') die ('Wrong method');

    include_once '../../config/database.php';
    include_once '../../classes/news.php';
    include '../login/verifyToken.php';

    if (verifyToken()) {
        $database = new Database();
        $db = $database->getConnection();

        $news = new News($db);

        if ($news->update($_GET['id'], $_POST, $_FILES)) echo json_encode(['message' => 'News data changed']);
        else echo json_encode(['message' => 'Unable to edit news']);
    } else {
        echo json_encode(['message' => 'Wrong token']);
    }
?>