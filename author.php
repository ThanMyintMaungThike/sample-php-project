<?php
// logics
const BASE_PATH = __DIR__ . '/';

require("functions.php");
require("database.php");
?>
<?php
view("header.view.php", [
    "title" => "Author"
]);
view("nav.view.php");
?>
<!-- HTML here -->
<?php view("footer.view.php"); ?>