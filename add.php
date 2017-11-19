<?php
require_once 'app/init.php';
if(isset($_POST['name'])){
    
    $name = trim($_POST['name']);
    if(!empty($name)){
        $addedQuery = $db->prepare("
        INSERT INTO items (name, user, done, created) 
        VALUES(:name,:user,0,CURRENT_TIMESTAMP)
        ");
        $addedQuery->execute([
            'name' => $name,
            'user' => 1
        ]);
    }
}
header('Location: index.php');