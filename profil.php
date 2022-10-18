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
                        <a href="profil.php">Профиль</a>
                    </li>
                </ul>
                <?php
                echo "<ul class='header-cabinet'>";
                if (isset($_SESSION["userid"])) {
                    $currentID = $_SESSION["userid"];
                    $loginSelect = "SELECT login FROM `user` WHERE id = '$currentID'";
                    $loginResult = mysqli_query($conn, $loginSelect);
                    $loginFetch = mysqli_fetch_array($loginResult);
                    echo "<span class ='nameclass'>" . $loginFetch['login'] . "</span>";
                    echo "<a href='exit.php'>" . " выйти?" . "</a>";
                } else {
                    echo "<a href='auth.php'>" . "Авторизация" . "</a>";
                }
                echo "</ul>"
                ?>
            </nav>
        </div>
    </header>
    <main class="main">
        <section class="profile__section">
            <div class="container profile__container">
                <?php
                if (!isset($_SESSION['userid'])) {
                ?>
                    <script>
                        document.location.replace('http://theatresite/thatresite/auth.php')
                    </script>
                <?php
                }
                ?>
                
                <div class="profile-concert__wrapper concert-info">
                    <h2 class="concert-info__header">Ваши места</h2>
                    <?php
                    $sitSelect = "SELECT * FROM `tickets` 
                    INNER JOIN timetable ON tickets.id_timetable = timetable.id_timetable
                    INNER JOIN sits ON tickets.id_sits = sits.sit_num
                    INNER JOIN direction ON sits.id_direction = direction.id
                    INNER JOIN poster ON timetable.id_poster = poster.id
                    WHERE id_user='$currentID'";
                    $sitSelectResult = mysqli_query($conn, $sitSelect);
                    echo "<ul class='sit__list sit'>";
                    foreach ($sitSelectResult as $sitRow) {
                        echo "<li class='sit__item'>";
                        echo "<h3 class='sit__header'>". "$sitRow[name]" . "</h3>";
                        echo "<p class='sit__paragraph'>" . "Номер места: " . "$sitRow[sit_num]" . "</p>";
                        echo "<p class='sit__paragraph'>" . "Ряд: " . "$sitRow[id_row]" . "</p>";
                        echo "<p class='sit__paragraph'>" . "Расположение: " . "$sitRow[dir_name]" . "</p>";
                        echo "<p class='sit__paragraph'>" . "Цена места: " . "$sitRow[sit_price] " . "</p>";
                        echo "<a href='profil.php?posterid=" . $sitRow['id_poster'] . "&placeid=" . $sitRow['id'] . "' class='sit__link'>" . "Cнять бронь" . "</a>";

                        echo "</li>";
                    }
                    echo "</ul>";
                    ?>
                    <?php
                    if (isset($_GET['posterid']) && isset($_GET['placeid'])) {

                        $posterid = $_GET['posterid'];
                        $placeid = $_GET['placeid'];
    
                        $placeupdate = "UPDATE `sits` SET `sit_status` = 'свободное', `reserved_by_id` = '' WHERE id = '$placeid'";
                        if ($conn->query($placeupdate)) {
                            echo "<p class='sit__update'> Бронь удалена </p>";
                        } 
                    
                        }
                    ?>


                
                </div>
            </div>
        </section>

    </main>
</body>