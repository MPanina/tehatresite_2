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
                        <a href="reg.php">Регистарция</a>
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
                    <h2 class="reg-header">
                        Введите данные аккаунта
                    </h2>
                    <form action="reg.php" class="reg-form form" method="POST">
                        <label for="login">Логин:</label>
                        <input class="reg-input" type="text" name="login" id="login" required>
                        <label for="password">Пароль:</label>
                        <input class="reg-input" type="password" name="password" id="password" required>
                        <input type="submit" name="submitreg" class="reg-btn btn">
                    </form>

                    <?php
                    if (isset($_POST['submitreg'])) {
                        $login = $_POST["login"];
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $userInsertion = "INSERT INTO `user` (`login`, `password`) VALUES ('$login', '$password')";
                        if ($conn->query($userInsertion)) {
                            echo "<p class='reg-p'>" . "Регистрация прошла успешно" . "</p>";
                        } else {
                            echo "<p>" . "Ошибка:" . $conn->error . "</p>";
                        }
                    }

                    ?>
                    </form>


                </div>

            </div>
        </section>
    </main>
</body>

</html>