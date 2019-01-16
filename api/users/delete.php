<?php
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Allow-Origin: *");

    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') die ('Wrong method');

    include_once '../../config/database.php';
    include_once '../../classes/users.php';
    include '../login/verifyToken.php';

    if (verifyToken()) {
        $database = new Database();
        $db = $database->getConnection(); 

        $user = new User($db);

        if ($user->delete($_GET['id'])) echo json_encode(['message' => 'User deleted succesfully']);
        else echo json_encode(['message' => 'Unable to delete user']);
    } else {
        echo json_encode(['message' => 'Wrong token']);
    }
?>