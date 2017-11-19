<?php
require_once 'app/init.php';

$itemsQuery = $db->prepare("SELECT id, name, done FROM items WHERE user = :user");
$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery: [];


?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="stylesheet/main.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600" rel="stylesheet">
    <title>VanC</title>
  </head>
  <body>
      <div class="list">
          <h1 class="to-do">To Do List</h1>
          <?php if(!empty($items)): ?>
          <ul class="items">
            <?php foreach($items as  $item): ?>
              <li>
                  <span class="item <?php echo $item['done'] ? 'done' : '' ?>"><?php echo $item['name']; ?></span>

                  <?php if(!$item['done']): ?>
                    <a href="mark.php?d=done&item=<?php echo $item['id']; ?>" class="btnDone">Mark As Done</a>
                  <?php endif; ?>
              </li>
              <?php endforeach; ?>
          </ul>

            <?php else: ?>
            <p style="
    text-align: center;
    font-size: 1.5em;
    font-weight: 600;">You have no to do list yet</p>
            <?php endif; ?>
          <form class="item-add" action="add.php" method="post">
            <input type="text" name="name" placeholder="Type a new item" class="input" required/>
            <input type="submit" value="Add" class="submit"/>
          </form>
      </div>
  </body>
</html>