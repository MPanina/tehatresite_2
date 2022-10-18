<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <title>Афиша</title>
</head>

<body>
    <header class="header">
        <div class="header-container ">
            <nav class="header-nav">
                <ul class="menu flex">
                    <li>
                        <a href="index.php" class="header-link">Афиша</a>
                    </li>
                    <li>
                        <a href="#">Новости</a>
                    <li>
                        <a href="reg.php">Регистрация</a>
                    </li>
                    </li>
                    <li>
                        <a href="#">Контакты</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main">
        <section class="section-reg">
            <div class="container reg-container">
                <div class="login-wrapper">
                    <h2 class="login-header">Авторизация</h2>

                    <form action="auth.php" class="reg-form form" method="POST">
                        <label for="login">Логин:</label>
                        <input class="reg-input" type="text" name="login" id="login" required>
                        <label for="password">Пароль:</label>
                        <input class="reg-input" type="password" name="password" id="password" required>
                        <input type="submit" name="submitreg" class="reg-btn btn">
                    </form>

                    <?php
                    if (isset($_POST["login"]) && isset($_POST["password"])) {
                        $login = $_POST["login"];
                        $auth = "SELECT * FROM `user` WHERE login='$login'";
                        $authResult = mysqli_query($conn, $auth);
                        $authAssoc = mysqli_fetch_assoc($authResult);
                        if (!empty($authAssoc)) {
                            $hash = $authAssoc['password'];
                            if (password_verify($_POST['password'], $hash)) {
                                $userid = $authAssoc['id'];
                                $_SESSION["userid"] = $userid;
                                echo "Авторизация успешна";
                            } else {
                                echo "Пароль неверный";
                            }
                        } else {
                            echo "Пользователя с таким логином не существует(";
                        }
                    }
                    ?>
                </div>

            </div>
        </section>
    </main>
</body>

</html>