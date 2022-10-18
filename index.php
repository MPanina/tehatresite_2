<?php
include 'connect.php';
if (!$conn) {
    die("Ошибка: " . mysqli_connect_error());
} else {
    $posterSelect = "SELECT * FROM `timetable`
    INNER JOIN poster ON timetable.id_poster=poster.id 
    ORDER BY id_poster ASC";
    $posterSelectResult = mysqli_query($conn, $posterSelect);
    $posterSelectRow = mysqli_fetch_array($posterSelectResult, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <title>Афиша</title>
</head>

<body>
    <header class="header">
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
                    <a href="profil.php">Профиль</a>
                </li>
            </ul>
            <?php
            echo "<ul class='header-cabinet'>";
            if (isset($_SESSION["userid"])) {
                $userlogin  = $_SESSION["userid"];
                $userSelect = "SELECT login FROM `user` WHERE id = '$userlogin'";
                $userResult = mysqli_query($conn, $userSelect);
                $userFetch = mysqli_fetch_array($userResult);
                echo "<span class ='nameclass'>" . $userFetch['login'] . "</span>";
                echo "<a href='exit.php'>" . " выйти?" . "</a>";
            } else {
                echo "<a href='auth.php'>" . "Авторизация" . "</a>";
            }
            echo "</ul>"
            ?>
        </nav>
        <div class="container header-container">

        </div>
    </header>

    <main class="main">
        <section class="section header__section">
            <div class="container main-container">
                <h1 class="container-header">
                    АФИША ТЕАТРОВ ВОЛГОГРАДА
                </h1>
                <p class="container header-info">На&nbsp;сайте представлена полная афиша всех главных театральных событий Волгограда.</p>
            </div>
        </section>

        <section class="poster__section">
            <div class="container poster-container">
                <ul class="poster-list">
                <?php
                
                foreach ($posterSelectResult as $posterRow) {
                    echo "<li class='poster-item'>";
                    echo "<img src='img/" . $posterRow['img'] . "' alt=''>";
                    echo "<div class='poster-content-wrapper'>";
                    echo "<h2 class='poster-header'>" .
                        "<a href='index.php?name=' class='poster-link'>" . $posterRow['name'] . "</a>" .
                        "</h2>";
                    echo "<span class='poster-span'>" . "$posterRow[date]" . "</span>";
                    echo "<span class='poster-span'>" . "$posterRow[time]" . "</span>";
                    echo "<span class='poster-span'>" . "$posterRow[place]" . "</span>";
                    echo "<span class='poster-span'>" . "$posterRow[price]" . "</span>";
                    echo "<div class='theatre-about-wrapper'>";
                    echo "<a href='theatre.php?posterid=" . $posterRow['id'] . "' class='about-btn'>" . "Купить билет" . "</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</li>";
                }
                ?>
                </ul>
        
            </div>
        </section>
    </main>
</body>

</html>