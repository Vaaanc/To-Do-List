<?php
require_once 'app/init.php';


if(isset($_GET['d'],$_GET['item'])){
    $done = $_GET['d'];
    $itemId = $_GET['item'];

    switch($done){
        case 'done':
            $query = $db->prepare("
            UPDATE items SET done = 1 
            WHERE id = :item AND 
            user = :user
            ");
            $query->execute([
                'item' => $itemId,
                'user' => $_SESSION['user_id']
            ]);
        break;
    }
}

header('Location: index.php');