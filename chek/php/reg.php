<?php
session_start();

$host = "localhost";
$user = "o96010tc_bd";
$password = "HDC&2a6J";  
$dbname = "o96010tc_bd";   

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password === $confirmPassword) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $defaultRoleId = 1;

                $stmt = $pdo->prepare("INSERT INTO users (login, password, id_role) VALUES (:username, :password, :role)");
                $stmt->execute(['username' => $username, 'password' => $hashedPassword, 'role' => $defaultRoleId]);

                
                header('Location: login.php'); 
            } else {
                echo "<p>Пароли не совпадают</p>";
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
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-5">
    <div class="container mx-auto max-w-sm mt-10">
        <div class="bg-white p-8 border border-gray-300 rounded-lg shadow-lg">
            <h1 class="text-xl font-bold mb-6 text-center">Регистарция</h1>
            <form id="registerForm" method="post">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Имя:</label>
                    <input type="text" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Пароль:</label>
                    <input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2"> Подтрдите пароль:</label>
                    <input type="password" name="confirm_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="flex items-center justify-center" style="margin: 0 0 10px 0;">
                    <button style="background-color: #4D47C3; color: white; font-weight: bold; height: 50px; width: 200px; border: none; border-radius: 4px; cursor: pointer;" type="submit">
                        зарегестрироваться
                    </button>
                </div>
                <div class="flex items-center justify-center">
                    <a style="display:flex; justify-content: center; align-items: center;background-color: #4D47C3; color: white; font-weight: bold; height: 50px; width: 200px; border: none; border-radius: 4px; cursor: pointer;" href="reg.php">
                    <div class="center">
                        Войти
                    </div>
                </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
