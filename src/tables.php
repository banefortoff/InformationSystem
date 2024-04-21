<?php
    $title = "Cтраница с таблицами";
    require "blocks/header.php";
    if (!isset($_SESSION['login'])) {
        // Пользователь не авторизован - перенаправление на страницу авторизации
        header('Location: autorization.php');
        exit;
      }
?>

<div class="container mt-2">
<h1>Просмотр и редактирование таблиц<br></h1>

<form method="post" action="">
<input type="submit" value="Таблица с учениками" name="button1" class="btn btn-outline-dark">
<input type="submit" value="Достижения в олимпиадах" name="button2" class="btn btn-outline-dark">
<input type="submit" value="Спортивные достижения" name="button3" class="btn btn-outline-dark">
<input type="submit" value="Социальные достижения" name="button4" class="btn btn-outline-dark">
<input type="submit" value="Олимпиады" name="button5" class="btn btn-outline-dark">
<?php if ($_SESSION['user_level'] == 1) {?>
<input type="submit" value="Места в олимпиадах" name="button6" class="btn btn-outline-dark">
<input type="submit" value="Уровни олимпиад" name="button7" class="btn btn-outline-dark">
<?php }?>
<input type="submit" value="Спортивные соревнования" name="button8" class="btn btn-outline-dark">
<?php if ($_SESSION['user_level'] == 1) {?>
<input type="submit" value="Места в соревнованиях" name="button9" class="btn btn-outline-dark">
<input type="submit" value="Уровни соревнований" name="button10" class="btn btn-outline-dark">
<?php }?>
</form><br>

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
?>

<?php
if(isset($_POST['button1'])) {
    $result->close();
    $db->next_result();
    $query = "select student_id, student_name, class_parallel, class_letter,
    characteristic_class from students;";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    echo"<h5><b>Таблица с учениками</b></h5>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>ФИО ученика</td><td>Параллель</td>
    <td>Класс</td><td>Характеристика</td><td>Обновить данные</td>";

    if ($_SESSION['user_level'] == 1) {
        echo "<td>Удалить данные</td></tr></b>";
    }

    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>
        <td><A HREF=update.php?id=".$row[0]."&button=1 class=\"link-dark\">Обновить</A></td>";
        if ($_SESSION['user_level'] == 1) {
            echo "<td><A HREF=delete.php?id=".$row[0]."&button=1 class=\"link-dark\">Удалить</A></td>";
        }
       echo "</tr>";
    };
    echo "</table>";
}

if(isset($_POST['button2'])) {
    $result->close();
    $db->next_result();
    $query = "SELECT id_olymp_ach, student_name, name_olymp, 
    olymp_name_place from olymp_achivments join students on 
    students.student_id = olymp_achivments.student_id join olymp_info 
    on olymp_info.olymp_id = olymp_achivments.olymp_id join olymp_places 
    on olymp_places.olymp_place_id = olymp_achivments.olymp_place_id 
    order by id_olymp_ach;";

    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    
    echo"<h5><b>Достижения в олимпиадах</b></h5>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>ФИО ученика</td><td>Название олимпиады</td>
    <td>Место</td><td>Обновить данные</td>";

    if ($_SESSION['user_level'] == 1) {
        echo "<td>Удалить данные</td></tr></b>";
    }

    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td>
        <td><A HREF=update.php?id=".$row[0]."&button=2 class=\"link-dark\">Обновить</A></td>";
        if ($_SESSION['user_level'] == 1) {
            echo "<td><A HREF=delete.php?id=".$row[0]."&button=2 class=\"link-dark\">Удалить</A></td>";
        }
       echo "</tr>";
    };
    echo "</table>";
}

if(isset($_POST['button3'])) {
    $result->close();
    $db->next_result();
    $query = "SELECT id_sport_ach, student_name, name_sport, 
    sport_name_place from sport_achivments join students on 
    students.student_id = sport_achivments.student_id join sport_info 
    on sport_info.sport_id = sport_achivments.sport_id join sport_places 
    on sport_places.sport_place_id = sport_achivments.sport_place_id 
    order by id_sport_ach;";

    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    
    echo"<h5><b>Спортивные достижения</b></h5>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>ФИО ученика</td><td>Название соревнования</td>
    <td>Место</td><td>Обновить данные</td>";

    if ($_SESSION['user_level'] == 1) {
        echo "<td>Удалить данные</td></tr></b>";
    }

    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td>
        <td><A HREF=update.php?id=".$row[0]."&button=3 class=\"link-dark\">Обновить</A></td>";
        if ($_SESSION['user_level'] == 1) {
            echo "<td><A HREF=delete.php?id=".$row[0]."&button=3 class=\"link-dark\">Удалить</A></td>";
        }
        echo "</tr>";
    };
    echo "</table>";
}

if(isset($_POST['button4'])) {
    $result->close();
    $db->next_result();
    $query = "SELECT id_social_ach, student_name, name_social_ach, social_grade
    from social_achivments join students on 
    students.student_id = social_achivments.student_id";

    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    
    echo"<h5><b>Социальные достижения</b></h5>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>ФИО ученика</td><td>Социальное достижение</td>
    <td>Оценка</td><td>Обновить данные</td>";

    if ($_SESSION['user_level'] == 1) {
        echo "<td>Удалить данные</td></tr></b>";
    }

    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td><td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td>
        <td><A HREF=update.php?id=".$row[0]."&button=4 class=\"link-dark\">Обновить</A></td>";
        if ($_SESSION['user_level'] == 1) {
            echo "<td><A HREF=delete.php?id=".$row[0]."&button=4 class=\"link-dark\">Удалить</A></td>";
        }
        echo "</tr>";
    };
    echo "</table>";
}

if(isset($_POST['button5'])) {
    $result->close();
    $db->next_result();
    $query = "SELECT olymp_id, name_olymp, olymp_subject, olymp_level_name
    from olymp_info join olymp_levels on 
    olymp_info.olymp_level_id = olymp_levels.olymp_level_id";

    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    
    echo"<h5><b>Олимпиады</b></h5>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Название олимпиады</td><td>Предмет олимпиады</td>
    <td>Уровень олимпиады</td><td>Обновить данные</td>";

    if ($_SESSION['user_level'] == 1) {
        echo "<td>Удалить данные</td></tr></b>";
    }
    
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td><td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td>
        <td><A HREF=update.php?id=".$row[0]."&button=5 class=\"link-dark\">Обновить</A></td>";
        if ($_SESSION['user_level'] == 1) {
            echo "<td><A HREF=delete.php?id=".$row[0]."&button=5 class=\"link-dark\">Удалить</A></td>";
        }
        echo "</tr>";
    };
    echo "</table>";
}

if(isset($_POST['button6'])) {
    $result->close();
    $db->next_result();
    $query = "SELECT olymp_place_id, olymp_name_place, olymp_place_coef from olymp_places";

    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    
    echo"<h5><b>Места в олимпиадах</b></h5>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Место</td><td>Оценка</td>
    <td>Обновить данные</td>";

    if ($_SESSION['user_level'] == 1) {
        echo "<td>Удалить данные</td></tr></b>";
    }
    
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td><td>$row[1]</td> 
        <td>$row[2]</td>
        <td><A HREF=update.php?id=".$row[0]."&button=6 class=\"link-dark\">Обновить</A></td>";
        if ($_SESSION['user_level'] == 1) {
            echo "<td><A HREF=delete.php?id=".$row[0]."&button=6 class=\"link-dark\">Удалить</A></td>";
        }
        echo "</tr>";
    };
    echo "</table>";

}

if(isset($_POST['button7'])) {
    $result->close();
    $db->next_result();
    $query = "SELECT olymp_level_id, olymp_level_name, olymp_grade from olymp_levels";

    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    
    echo"<h5><b>Уровни олимпиад</b></h5>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Уровень олимпиады</td><td>Оценка</td>
    <td>Обновить данные</td>";

    if ($_SESSION['user_level'] == 1) {
        echo "<td>Удалить данные</td></tr></b>";
    }
    
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td><td>$row[1]</td> 
        <td>$row[2]</td>
        <td><A HREF=update.php?id=".$row[0]."&button=7 class=\"link-dark\">Обновить</A></td>";
        if ($_SESSION['user_level'] == 1) {
            echo "<td><A HREF=delete.php?id=".$row[0]."&button=7 class=\"link-dark\">Удалить</A></td>";
        }
        echo "</tr>";
    };
    echo "</table>";
}

if(isset($_POST['button8'])) {
    $result->close();
    $db->next_result();
    $query = "SELECT sport_id, name_sport, sport_subject, sport_level_name
    from sport_info join sport_levels on 
    sport_info.sport_level_id = sport_levels.sport_level_id";

    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    
    echo"<h5><b>Спортивные соревнования</b></h5>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Название соревнования</td><td>Вид спорта соревнования</td>
    <td>Уровень соревнования</td><td>Обновить данные</td>";

    if ($_SESSION['user_level'] == 1) {
        echo "<td>Удалить данные</td></tr></b>";
    }
    
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td><td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td>
        <td><A HREF=update.php?id=".$row[0]."&button=8 class=\"link-dark\">Обновить</A></td>";
        if ($_SESSION['user_level'] == 1) {
            echo "<td><A HREF=delete.php?id=".$row[0]."&button=8 class=\"link-dark\">Удалить</A></td>";
        }
        echo "</tr>";
    };
    echo "</table>";
}


if(isset($_POST['button9'])) {
    $result->close();
    $db->next_result();
    $query = "SELECT sport_place_id, sport_name_place, sport_place_coef from sport_places";

    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    
    echo"<h5><b>Места в соревнованиях</b></h5>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Место</td><td>Оценка</td>
    <td>Обновить данные</td>";

    if ($_SESSION['user_level'] == 1) {
        echo "<td>Удалить данные</td></tr></b>";
    }
    
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td><td>$row[1]</td> 
        <td>$row[2]</td>
        <td><A HREF=update.php?id=".$row[0]."&button=9 class=\"link-dark\">Обновить</A></td>";
        if ($_SESSION['user_level'] == 1) {
            echo "<td><A HREF=delete.php?id=".$row[0]."&button=9 class=\"link-dark\">Удалить</A></td>";
        }
        echo "</tr>";
    };
    echo "</table>";
}


if(isset($_POST['button10'])) {
    $result->close();
    $db->next_result();
    $query = "SELECT sport_level_id, sport_level_name, sport_grade from sport_levels";

    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    
    echo"<h5><b>Уровни соревнований</b></h5>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Уровень соревнования</td><td>Оценка</td>
    <td>Обновить данные</td>";

    if ($_SESSION['user_level'] == 1) {
        echo "<td>Удалить данные</td></tr></b>";
    }
    
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td><td>$row[1]</td> 
        <td>$row[2]</td>
        <td><A HREF=update.php?id=".$row[0]."&button=10 class=\"link-dark\">Обновить</A></td>";
        if ($_SESSION['user_level'] == 1) {
            echo "<td><A HREF=delete.php?id=".$row[0]."&button=10 class=\"link-dark\">Удалить</A></td>";
        }
        echo "</tr>";
    };
    echo "</table>";
}
?>
