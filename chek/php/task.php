<?
session_start();


if (!isset($_SESSION['username'])) {
    
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    
    session_destroy();
    
    header('Location: login.php');
    exit();
}

$servername = "localhost"; 
$username = "o96010tc_bd"; 
$password = "HDC&2a6J";    
$dbname = "o96010tc_bd";   

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$stmt = $conn->prepare("SELECT * FROM `tasks` ORDER BY id_checklist DESC;
");
$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <div class="viewport">
        <div class="header">

            <div class="header__container">
                <image class="header__logo" src="../images/logo.svg"></image>
            </div>

            <div class="header__container">
                <div class="header__user">
                    <!--$server['name']-->
                    <span class="header__username"><?=htmlspecialchars($_SESSION['username']);?></span>
                    <form method="post">
                        <button type="submit" name="logout" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Выйти</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="body">
            <div class="container">
                <div class="content">
                    <div class="content__block">
                        <h1 class="title">список задач</h1>
                    </div>
                    <div class="content__block">
                        <div class="content__tools">
                            <div class="content__container">
                                <div id="add" class="block__input_button">
                                    <div class="button__ikon">
                                        <image class="button__logo" src="../images/icon plus.svg"></image>
                                    </div>
                                    <div class="button__text">Добавить</div>

                                </div>

                            </div>

                            <div class="content__container">
                                <div id="" class="block__input">
                                    <input type="text" placeholder="Начните писать" class="block__input_text input_big" id="search" name="">
                                </div>

                                <div id="" class="block__input_button">

                                    <div class="button__text">найти</div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="content__block">
                        <div class="projects">
                        <?php
    foreach($stmt as $row) {

    ?>
    
                            <div class="project" data-id_creator="<?=$row['id_creator']?>">
                                <div class="project__block project__blockdis">

                                    <div class="project__title"><?=$row['name']?></div>
                                    <div class="project__discryption"><?=$row['description']?></div>

                                </div>

                                <div class="project__block">

                                    <div class="project__status status<?=$row['id_status']?>" data-status="<?=$row['id_status']?>" title="Не пройден">
                                        
                                    </div>
                                    <div class="project__menu">
                                        <image class="menu__item" src="../images/3ots.svg" alt="..."></image>
                                    </div>

                                </div>

                            </div>
<?}?>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="footer"></div>
    </div>






    <div class="modal hide" id="modal">

        <div class="modal__bg bg"></div>
        <div class="hide_smoll bg" id="close"></div>
        <div class="modal__body">
        <div class="modal__container">
            <div class="modal__block">
                <h1 class="title__text">Добавить проект</h1>
            </div>
            <div class="modal__block">
                <div class="block__title">
                    <h3 class="title__text">название проекта</h3>
                </div>
                <div class="block__content">
                    <input type="text" placeholder="Начните писать" class="block__input_text" name="title" id="title">
                </div>
            </div>
            <div class="modal__block">
                <div class="block__title">
                    <h3 class="title__text">описание</h3>
                </div>
                <div class="block__content">
                    <input type="text" placeholder="Начните писать" class="block__input_text input_big" id="description" name="descryption">
                </div>
            </div>
            <div class="modal__block">
                <div class="block__title">
                    <h3 class="title__text"></h3>
                </div>
                <div class="block__content">
                    <input type="submit" id="submit" value="Создать" class="block__input_button">
                </div>
                </form>




            </div>
        </div>    
        </div>
        <script src="https:
        <script src="../scripts/script.js"></script>
</body>

</html>