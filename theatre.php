<?php include 'connect.php' ?>

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
        <section class="section theatre-about__section">
            <div class="container theatre-about__container">

                <?php
                /*$poster = $_GET['posterid'];
                $posterIDSelect = "SELECT * FROM `poster` WHERE id = '$poster'";
                $posterIDSelectResult = mysqli_query($conn, $posterIDSelect);
                $posterIDSelectRow = mysqli_fetch_array($posterIDSelectResult, MYSQLI_ASSOC);
                $posterZalSelect = "SELECT * FROM `sits` WHERE id_poster = '$poster' AND sit_status = 'свободное'";
                $posterZalSelectResult = mysqli_query($conn, $posterZalSelect);
                $posterZalAssoc = mysqli_fetch_assoc($posterZalSelectResult);*/
                $poster = $_GET['posterid'];
                $posterIDSelect = "SELECT * FROM `timetable`
                INNER JOIN poster ON timetable.id_poster=poster.id 
                WHERE id_timetable = '$poster'";
                $posterIDSelectResult = mysqli_query($conn, $posterIDSelect);
                $posterIDSelectRow = mysqli_fetch_array($posterIDSelectResult, MYSQLI_ASSOC);
                $posterZalSelect = "SELECT * FROM `sits`
                INNER JOIN timetable ON sits.id_timetable=timetable.id_timetable
                INNER JOIN direction ON sits.id_direction=direction.id
                WHERE sits.id_timetable = '$poster' AND sit_status = 'свободное'";
                $posterZalSelectResult = mysqli_query($conn, $posterZalSelect);
                $posterZalAssoc = mysqli_fetch_assoc($posterZalSelectResult);

                foreach ($posterIDSelectResult as $posterIDRow) {
                    echo "<div class='theatre-about_wrapper'>";
                    echo "<img src='img/" . $posterIDRow['img'] . "' class='theatre__image' alt=''>";
                    echo "<div class='theatre-about__content__wrapper'>";
                    echo "<h2 class='about__header'>" .
                        "<a href='index.php?name=' class='about__link'>" . $posterIDRow['name'] . "</a>" .
                        "</h2>";
                    echo "<span class='theatre-about__span'>" . "$posterIDRow[date]" . "</span>";
                    echo "<span class='theatre-about__span'>" . "$posterIDRow[place]" . "</span>";
                    echo "<span class='theatre-about__span'>" . "Стоимость билетов:&nbsp;" . "$posterIDRow[price]" . "</span>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "<h2 class='about__header'>Места</h2>";
                if (empty($posterZalAssoc) && !isset($_GET['placeid'])) {
                    echo "<p class='sit_empty'>" . "мест нет" . "</p>";
                }
                if (isset($_GET['placeid'])) {
                    $placeid = $_GET['placeid'];
                    $poster = $_GET['posterid'];
                    $placeupdate = "UPDATE `sits` SET `sit_status` = 'занятое', `reserved_by_id` = '$currentID' WHERE sit_num = '$placeid'";
                    $ticketsgQuery = "INSERT INTO `tickets` (`id`, `id_timetable`,`id_user`, `id_sits`)
                     VALUES (NULL, '$poster', '$currentID', '$placeid')";
                   if ($conn->query($placeupdate)) {
                    echo "<p class='sit__update'> Место зарезервировано </p>";  
                    ?>
       
                    <?php
                    }
                    if ($conn->query($ticketsgQuery)) {
                    ?>
              
                <?php             
                    
                } else  {
                    echo "<p class='sit__update'> Место зарезервировано" . $conn->error  . "</p>";
                }
            } else {
                    echo "<ul class='sit__list sit'>";
                    foreach ($posterZalSelectResult as $posterZalRow) {

                        echo "<li class='sit__item'>";
                        echo "<h3 class='sit__header'>" . "Номер места: " . "$posterZalRow[sit_num]" . "</h3>";
                        echo "<p class='sit__paragraph'>" . "Цена места: " . "$posterZalRow[sit_price] "  . "</p>";
                        echo "<p class='sit__paragraph'>" . "Расположение: " . "$posterZalRow[dir_name] "  . "</p>";
                        echo "<p class='sit__paragraph'>" . "Ряд: " . "$posterZalRow[id_row]" . "</p>";
                        echo "<a href='theatre.php?posterid=" . $posterZalRow['id_poster'] . "&placeid=" . $posterZalRow['id'] . "' class='sit__link'>" . "Забронировать" . "</a>";
                        echo "</li>";
                    }
                    echo "</ul>";
                }
                ?>
            </div>
        </section>
    </main>
</body>

</html>