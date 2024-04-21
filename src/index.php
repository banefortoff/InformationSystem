<?php
$title = "Лучшие ученики";
require "blocks/header.php";
if (!isset($_SESSION['login'])) {
    // Пользователь не авторизован - перенаправление на страницу авторизации
    header('Location: autorization.php');
    exit;
}
?>
<div class="container mt-2">
    <h1>Лучшие ученики</h1>

    <form method="post" action="">
        <input type="submit" value="Все достижения" name="button1" class="btn btn-outline-dark">
        <input type="submit" value="Сумма всех достижений" name="button2" class="btn btn-outline-dark">
        <input type="submit" value="Сумма всех достижений в олимпиадах" name="button3" class="btn btn-outline-dark">
        <input type="submit" value="Сумма всех спортивных достижений" name="button4" class="btn btn-outline-dark">
        <input type="submit" value="Сумма всех социальных достижений" name="button5" class="btn btn-outline-dark">
    </form>

    <?php
    $db = mysqli_connect("localhost", "root", "", "school");
    if (!$db) {
        echo "Error: Could not connect to database.";
        exit;
    }

    $query = "Call get_all_grade();";
    $result = mysqli_query($db, $query);

    function print_table($result, $headers) {
        echo "<table class=\"table table-hover border\"> <br />";
        echo "<b><tr>";
        foreach ($headers as $header) {
            echo "<td>$header</td>";
        }
        echo "</tr></b>";
        while ($row = mysqli_fetch_row($result)) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>$cell</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    function execute_and_print($db, $query, $headers) {
        $result = mysqli_query($db, $query);
        print_table($result, $headers);
        $result->close();
    }

    if (isset($_POST['button1'])) {
        execute_and_print($db, "Select * from view_all_grade;", ["ФИО ученика", "Параллель", "Класс", "Сумма всех достижений", "Сумма всех достижений в олимпиадах", "Сумма всех спортивныых достижений", "Сумма всех социальных достижений"]);
    } else if (isset($_POST['button2'])) {
        execute_and_print($db, "Select * from view_only_all_grade;", ["ФИО ученика", "Параллель", "Класс", "Сумма всех достижений"]);
    } else if (isset($_POST['button3'])) {
        execute_and_print($db, "Select * from view_only_olymp_grade;", ["ФИО ученика", "Параллель", "Класс", "Сумма всех достижений в олимпиадах"]);
    } else if (isset($_POST['button4'])) {
        execute_and_print($db, "Select * from view_only_sport_grade;", ["ФИО ученика", "Параллель", "Класс", "Сумма всех спортивныых достижений"]);
    } else if (isset($_POST['button5'])) {
        execute_and_print($db, "Select * from view_only_social_grade;", ["ФИО ученика", "Параллель", "Класс", "Сумма всех социальных достижений"]);
    }
?>
