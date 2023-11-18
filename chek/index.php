<?php
session_start();


if (!isset($_SESSION['username'])) {
    
    header('Location: php/login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    
    session_destroy();
    
    header('Location: php/login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    
</head>
<body>
    <h1>Добро пожаловать, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

     <form method="post">
        <button type="submit" name="logout" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Выйти</button>
    </form>
    

    
</body>
</html>
