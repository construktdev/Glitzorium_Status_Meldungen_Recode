<?php
session_start();
$message = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['password'])) {
        if ($_POST['password'] === "PASSWORD") { // change password here
            $_SESSION['admin'] = "yes";
            $message = "<div class='success-message'>Login successful!</div>";
        } else {
            $message = "<div class='error-message'>Incorrect password!</div>";
        }
    } elseif (isset($_POST['title']) && isset($_POST['text'])) {
        $title = htmlspecialchars($_POST['title']);
        $text = htmlspecialchars($_POST['text']);
        $datetime = date("Y-m-d H:i");
        $source = "data/data.txt";

        $currentContent = "";
        if (file_exists($source)) {
            $currentContent = file_get_contents($source);
        }

        $newEntry = $datetime . ":" . $title . ":" . $text . "\n";
        $file = fopen($source, "w");
        fwrite($file, $newEntry . $currentContent);
        fclose($file);

        $message = "<div class='success-message'>Update added successfully!</div>";
    }

    if (empty($message)) {
        header("Location: admin.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .status-message {
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<h2>Admin Dashboard</h2>

<?php
echo $message;
?>

<div class="forms">
    <?php
    if (isset($_SESSION['admin']) && $_SESSION['admin'] === "yes") {
        echo "<div class='status-message'>You are logged in as admin. Add new updates below.</div>";
        echo "<form action='admin.php' method='post' class='entry-form'>
                <label for='title'>Title:</label>
                <input type='text' name='title' id='title' placeholder='Enter title' required>
                
                <label for='text'>Description:</label>
                <textarea name='text' id='text' placeholder='Enter description' required></textarea>
                
                <button type='submit' class='submit'>Add Update</button>
              </form>";
    } else {
        echo "<div class='status-message'>Please login to access the admin dashboard</div>";
        echo "<form action='admin.php' method='post' class='login-form'>
                <label for='password'>Password:</label>
                <input type='password' name='password' id='password' placeholder='Enter admin password' required>
                <button type='submit' class='login-button' hidden='hidden'>Login</button>
              </form>";
    }
    ?>
</div>
</body>
</html>