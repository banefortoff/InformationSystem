<?php
$title = "Удаление записи";
require "blocks/header.php";
if (!isset($_SESSION['login'])) {
    // Пользователь не авторизован - перенаправление на страницу авторизации
    header('Location: autorization.php');
    exit;
}
?>

<div class="container mt-2">
    <h1>Удаление строки из таблицы<br></h1>

    <?php
    $db = mysqli_connect("localhost", "root", "", "school");
    if (!$db) {
        echo "Error: Could not connect to database.";
        exit;
    }

    $query = "Call get_all_grade();";
    $result = mysqli_query($db, $query);
    $query = "select 1";
    $result = mysqli_query($db, $query);
    $button = $_GET['button'];
    $id = $_GET['id'];

    if ($_SESSION['user_level'] == 1) {
    ?>

        <div class="alert alert-dark" role="alert">
            <?php
            echo "<b>Вы точно хотите удалить данную запись?</b>";
            ?>
        </div>
        <form method="post" action="">
            <input type="submit" value="Да" name="buttonYES" class="btn btn-outline-dark">
            <input type="submit" value="Нет" name="buttonNO" class="btn btn-outline-dark">
        </form><br>


    <?php

        function delete_record($db, $table, $column, $id) {
            $query = "delete from " . $table . " where " . $column . " = " . $id . ";";
            $result = mysqli_query($db, $query);
            if ($result == FALSE) {
                echo "<h1 style=\"color: #FF2400\">Не удалось удалить данные</h1>";
            }
        }

        $actions = [
            1 => ["students", "student_id"],
            2 => ["olymp_achivments", "id_olymp_ach"],
            3 => ["sport_achivments", "id_sport_ach"],
            4 => ["social_achivments", "id_social_ach"],
            5 => ["olymp_info", "olymp_id"],
            6 => ["olymp_places", "olymp_place_id"],
            7 => ["olymp_levels", "olymp_level_id"],
            8 => ["sport_info", "sport_id"],
            9 => ["sport_places", "sport_place_id"],
            10 => ["sport_levels", "sport_level_id"]
        ];

        if (isset($_POST['buttonNO'])) {
            header("location:tables.php");
        } elseif (isset($_POST['buttonYES'])) {

            if (array_key_exists($button, $actions)) {
                $result->close();
                $db->next_result();
                delete_record($db, $actions[$button][0], $actions[$button][1], $id);
            }

            header("location:tables.php");
        }
    }
