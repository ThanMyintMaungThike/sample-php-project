
<?php

    const BASE_PATH = __DIR__ . '/';

    require("../functions.php");
    require("../database.php");

    $select_query = "SELECT title, notes.id AS note_id, body, users.id AS user_id, username FROM notes LEFT JOIN users ON notes.user_id = users.id";
    $results = mysqli_query($conn, $select_query);

?>
<?php 
view("header.view.php", [
    "title" => "Notes"
]);?>
<?php view("nav.view.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Notes</title>
</head>
<body>
<h1>Notes</h1>
<h3>Hello World</h3>
<div>
       
<?php if (isset($_GET['error'])) : ?>
            <div class="alert alert-warning">
                First you need to log in for edit!
            </div>
        <?php endif ?>
    <?php while($row = mysqli_fetch_assoc($results)) : ?>
        <h3><a href="/sample-php-project/notes/note-edit.php?id=<?=$row["note_id"]?>"><?= $row["title"] ?></a></h3>

        <p>
            Author - <a href="/sample-php-project/author.php?id=<?= $row['user_id']?>"><?= $row["username"] ?? "Unknown" ?></a>
        </p>
        <p>
            <?= substr(htmlentities($row["body"]), 0, 200) . '...' ?>
        </p>
    <?php endwhile; ?>
</div>
<a href="/sample-php-project/notes/note-create.php">Create</a>
<?php view("footer.view.php");?>
</body>
</html>


