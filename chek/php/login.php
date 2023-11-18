<?php
session_start();

$host = "localhost";
$user = "o96010tc_bd"; 
$password = "HDC&2a6J";    
$dbname = "o96010tc_bd";   

$showModal = false;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $passwordInput = $_POST['password'];

            $stmt = $pdo->prepare("SELECT * FROM users WHERE login = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($passwordInput, $user['password'])) {
                $_SESSION['username'] = $username;
                header('Location: index.php');
                exit();
            } else {
                $showModal = true;
            }
        }
    }
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-gray-100 p-5">
    <div class="container mx-auto max-w-sm mt-10">
        <div class="bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
            <h1 class="text-xl font-bold mb-6 text-center">Авторизация</h1>
            <form id="loginForm" method="post">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Логин:</label>
                    <input type="text" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Пароль:</label>
                    <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-center" style="margin: 0 0 10px 0;">
                    <button style="background-color: #4D47C3; color: white; font-weight: bold; height: 50px; width: 200px; border: none; border-radius: 4px; cursor: pointer;" type="submit">
                        Войти
                    </button>
                </div>
                <div class="flex items-center justify-center">
                    <a style="display:flex; justify-content: center; align-items: center;background-color: #4D47C3; color: white; font-weight: bold; height: 50px; width: 200px; border: none; border-radius: 4px; cursor: pointer;" href="reg.php">
                    <div class="center">
                        Зарегестрироваться
                    </div>
                </a>
                </div>
            </form>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
            <p>Неверный логин или пароль</p>
        </div>
    </div>

    <script>
        <?php if ($showModal): ?>
        document.getElementById('myModal').style.display = 'block';
        <?php endif; ?>
    </script>
</body>
</html>
