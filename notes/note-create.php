<?php



const BASE_PATH = __DIR__ . '/';

require("../functions.php");
require("../database.php");

if(!isLoggedIn()) {
    header('location: /sample-php-project/notes/note-create.php/');
    exit();
}
$user_id = $_SESSION['user']['id'];
function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$titleErr =  "";
$txtErr =  "";
$title = $txt_area = "";


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // echo $_POST["action"];die("hello world");
    if($_POST["action"] ?? '' === "DELETE") {

        $id = $_POST['id']; 
        // echo $id; die("shining morning");
        $delete_query = "DELETE FROM notes WHERE id= ". $id . ";";
        // echo $delete_query;die("Hello wr ");
        $result = $conn->query($delete_query);
        header('location: /sample-php-project/notes/notes.php');
    }
    if(empty($_POST['title'])) {
        $titleErr = "* title is required";
    } else {
        $title = testInput($_POST['title']);
        if(!preg_match("/^[a-zA-Z-' ]*$/", $title)) {
            $titleErr = "* Only letters and white space allowed";
        }

    }
    if(empty($_POST['txt_area'])) {
        $txtErr = "*Body is empty!";
    } else {
        $txt_area = testInput($_POST['txt_area']);
    }

    if(!empty($_POST['title'] && $_POST['txt_area'])) {
        $stmt = $conn->prepare("INSERT INTO notes (user_id, title, body) VALUES (?, ?, ?)");
        $stmt->bind_param("iss",$userID, $titleName, $txtArea);
        
        $userID = $user_id;
        $titleName = $title;
        $txtArea = $txt_area;
        $stmt->execute();
    }
}


$sql = "SELECT * FROM notes";
$result = $conn->query($sql);
view("nav.view.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 
    <style>
        .form {
            width: 600px;
            margin: 0 auto;
        }
        .error {
            color: red;
        }
    </style>
</head>

<body>
<body class="mt-5">
    <div class="form">
        <form class="m-auto" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            Title: <input class="form-control" type="text" name="title" value="<?= $title; ?>">
            <span class="error"><?= "$titleErr" ?></span> <br> <br>
            

            Body: <textarea class="form-control" name="txt_area"  cols="30" rows="5"><?php echo $txt_area; ?></textarea><br><br>
            <input class="btn btn-primary w-100 mb-5 p-3" type="submit" name="submit" value= "Submit">
            <span class="error"><?= "$txtErr" ?></span>
            
        </form>  
    </div>
    <div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Body</th>
                <th>Action</th>
            </tr>
            <?php $i = 1 ?>
            <?php while($row = $result->fetch_assoc()) : ?>

                <div>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= htmlentities($row['title']) ?></td>
                        <td><?= htmlentities($row['body']) ?></td>
                        <td>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                <input type="hidden" name="id" value=<?= $row['id'] ?> />
                                <input type="hidden" name="action" value="DELETE" />
                                <button>Delete</button>
                            </form>
                        </td>
                    </tr>
               <?php $i++ ?>
                </div>
            <?php endwhile; ?>
        </table>
    </div>

<?php $conn->close(); ?>

</body>
</html>