<?php
    $title = "Обновление таблицы";
    require "blocks/header.php";
    if (!isset($_SESSION['login'])) {
        // Пользователь не авторизован - перенаправление на страницу авторизации
        header('Location: autorization.php');
        exit;
    }

?>
<div class="container mt-2">
<h1>Обновление таблицы<br></h1>

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
$id=$_GET['id'];
?>
<?php

//<!--button1================================================================================================================================-->
if (isset($_POST["student_name"]) && isset($_POST["class_parallel"]) && isset($_POST["class_letter"]) &&
    $_POST["student_name"] != '' && $_POST["class_parallel"] != '' && $_POST["class_letter"] != ''
    && is_numeric($_POST["class_parallel"]) && isset($_POST["button11"])) {

    $query = "UPDATE students 
    SET student_name='".$_POST["student_name"]."',  
    class_parallel=".$_POST["class_parallel"].", 
    class_letter='".$_POST["class_letter"]."',
    characteristic_class='".$_POST["characteristic_class"]."'  
    WHERE student_id=".$id;
    $result = mysqli_query($db, $query); 
    header("location:tables.php");
} else if (isset($_POST["button11"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if ($button == 1) {
    $result->close();
    $db->next_result();
    $query = "select student_id, student_name, class_parallel, class_letter,
    characteristic_class from students where student_id =".$id.";";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    echo"<b>Старая информация:</b>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>ФИО ученика</td><td>Параллель</td>
    <td>Класс</td><td>Характеристика</td></tr></b>";
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
    };
    echo "</table><br>";    
    echo"<b>Введите новую информацию:</b>";
    ?>

    <form method="post" action="">
    <input type="text" name="student_name" placeholder="ФИО ученика" class="form-control"><br>
    <input type="text" name="class_parallel" placeholder="Параллель" class="form-control"><br>
    <input type="text" name="class_letter" placeholder="Класс(буква)" class="form-control"><br>
    <textarea type="text" name="characteristic_class" placeholder="Характеристика(не более 400 символов)" class="form-control"></textarea><br>
    <input type="submit" value="Изменить" name="button11" class="btn btn-outline-dark">
    </form><br>
    <?php
}

//<!--button2================================================================================================================================-->

if (isset($_POST["student_name"]) && isset($_POST["name_olymp"]) && isset($_POST["olymp_name_place"])
    && isset($_POST["button22"])) {

    $result->close();
    $db->next_result();
    $query = "select student_id from students where student_name = '".$_POST["student_name"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $student_id = $row['student_id'];
    }

    $result->close();
    $db->next_result();
    $query = "select olymp_id from olymp_info where name_olymp = '".$_POST["name_olymp"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $olymp_id = $row['olymp_id'];
    }

    $result->close();
    $db->next_result();
    $query = "select olymp_place_id from olymp_places where olymp_name_place = '".$_POST["olymp_name_place"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $olymp_place_id = $row['olymp_place_id'];
    }

    $query = "UPDATE olymp_achivments 
    SET student_id=".$student_id.",  
    olymp_id=".$olymp_id.", 
    olymp_place_id=".$olymp_place_id."  
    WHERE id_olymp_ach=".$id.";";
    $result = mysqli_query($db, $query); 
    header("location:tables.php");
} else if (isset($_POST["button22"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if ($button == 2) {
    $result->close();
    $db->next_result();
    $query = "SELECT id_olymp_ach, student_name, name_olymp, 
    olymp_name_place from olymp_achivments join students on 
    students.student_id = olymp_achivments.student_id join olymp_info 
    on olymp_info.olymp_id = olymp_achivments.olymp_id join olymp_places 
    on olymp_places.olymp_place_id = olymp_achivments.olymp_place_id where id_olymp_ach = ".$id.";";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    echo"<b>Старая информация:</b>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>ФИО ученика</td><td>Название олимпиады</td>
    <td>Место</td></tr></b>";
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td></tr>";
    };
    echo "</table><br>";
    echo"<b>Введите новую информацию:</b>";

    $result->close();
    $db->next_result();
    $query = "select student_name from students;";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    ?>
    <form method="post" action="">
    <select name='student_name' class="form-select" aria-label="Default select example">
    <?php
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<option value='$row[0]'>$row[0]</option>";
    };
    ?>
    </select>

    <?php
    $result->close();
    $db->next_result();
    $query = "select DISTINCT name_olymp from olymp_info;";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    ?>
    <select name='name_olymp' class="form-select" aria-label="Default select example">
    <?php
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<option value='$row[0]'>$row[0]</option>";
    };
    ?>
    </select>

    <?php
    $result->close();
    $db->next_result();
    $query = "select olymp_name_place from olymp_places;";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    ?>
    <select name='olymp_name_place' class="form-select" aria-label="Default select example">
    <?php
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<option value='$row[0]'>$row[0]</option>";
    };
    ?>
    </select>

    <input type="submit" value="Изменить" name="button22" class="btn btn-outline-dark">
    </form><br>
    <?php
}

//<!--button3================================================================================================================================-->

if (isset($_POST["student_name"]) && isset($_POST["name_sport"]) && isset($_POST["sport_name_place"])
    && isset($_POST["button33"])) {

    $result->close();
    $db->next_result();
    $query = "select student_id from students where student_name = '".$_POST["student_name"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $student_id = $row['student_id'];
    }

    $result->close();
    $db->next_result();
    $query = "select sport_id from sport_info where name_sport = '".$_POST["name_sport"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $sport_id = $row['sport_id'];
    }

    $result->close();
    $db->next_result();
    $query = "select sport_place_id from sport_places where sport_name_place = '".$_POST["sport_name_place"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $sport_place_id = $row['sport_place_id'];
    }

    $query = "UPDATE sport_achivments 
    SET student_id=".$student_id.",  
    sport_id=".$sport_id.", 
    sport_place_id=".$sport_place_id."  
    WHERE id_sport_ach=".$id.";";
    $result = mysqli_query($db, $query); 
    header("location:tables.php");
} else if (isset($_POST["button33"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if ($button == 3) {
    $result->close();
    $db->next_result();
    $query = "SELECT id_sport_ach, student_name, name_sport, 
    sport_name_place from sport_achivments join students on 
    students.student_id = sport_achivments.student_id join sport_info 
    on sport_info.sport_id = sport_achivments.sport_id join sport_places 
    on sport_places.sport_place_id = sport_achivments.sport_place_id where id_sport_ach = ".$id.";";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    echo"<b>Старая информация:</b>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>ФИО ученика</td><td>Название соревнования</td>
    <td>Место</td></tr></b>";
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td></tr>";
    };
    echo "</table><br>";
    echo"<b>Введите новую информацию:</b>";

    $result->close();
    $db->next_result();
    $query = "select student_name from students;";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    ?>
    <form method="post" action="">
    <select name='student_name' class="form-select" aria-label="Default select example">
    <?php
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<option value='$row[0]'>$row[0]</option>";
    };
    ?>
    </select>

    <?php
    $result->close();
    $db->next_result();
    $query = "select DISTINCT name_sport from sport_info;";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    ?>
    <select name='name_sport' class="form-select" aria-label="Default select example">
    <?php
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<option value='$row[0]'>$row[0]</option>";
    };
    ?>
    </select>

    <?php
    $result->close();
    $db->next_result();
    $query = "select sport_name_place from sport_places;";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    ?>
    <select name='sport_name_place' class="form-select" aria-label="Default select example">
    <?php
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<option value='$row[0]'>$row[0]</option>";
    };
    ?>
    </select>

    <input type="submit" value="Изменить" name="button33" class="btn btn-outline-dark">
    </form><br>
    <?php
}

//<!--button4================================================================================================================================-->

if (isset($_POST["student_name"]) && isset($_POST["name_social_ach"]) && isset($_POST["social_grade"]) &&
    $_POST["student_name"] != '' && $_POST["name_social_ach"] != '' && $_POST["social_grade"] != ''
    && is_numeric($_POST["social_grade"]) && isset($_POST["button44"])) {

    $result->close();
    $db->next_result();
    $query = "select student_id from students where student_name = '".$_POST["student_name"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $student_id = $row['student_id'];
    }

    $query = "UPDATE social_achivments 
    SET student_id=".$student_id.",  
    name_social_ach='".$_POST["name_social_ach"]."' , 
    social_grade='".$_POST["social_grade"]."'  
    WHERE id_social_ach =".$id;

    $result = mysqli_query($db, $query); 
    header("location:tables.php");
} else if (isset($_POST["button44"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if ($button == 4) {
    $result->close();
    $db->next_result();
    $query = "SELECT id_social_ach, student_name, name_social_ach, social_grade
    from social_achivments join students on 
    students.student_id = social_achivments.student_id where id_social_ach = ".$id.";";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    echo"<b>Старая информация:</b>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>ФИО ученика</td><td>Социальное достижение</td>
    <td>Оценка</td></tr></b>";
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td></tr>";
    };
    echo "</table><br>";    
    echo"<b>Введите новую информацию:</b>";
    ?>

    <form method="post" action="">
    <input type="text" name="student_name" placeholder="ФИО ученика" class="form-control"><br>
    <input type="text" name="name_social_ach" placeholder="Социальное достижение" class="form-control"><br>
    <input type="text" name="social_grade" placeholder="Оценка" class="form-control"><br>
    <input type="submit" value="Изменить" name="button44" class="btn btn-outline-dark">
    </form><br>
    <?php
}

//<!--button5================================================================================================================================-->

if (isset($_POST["name_olymp"]) && isset($_POST["olymp_subject"]) && isset($_POST["olymp_level_name"]) &&
    $_POST["name_olymp"] != '' && $_POST["olymp_subject"] != '' && $_POST["olymp_level_name"] != ''
    && isset($_POST["button55"])) {

    $result->close();
    $db->next_result();
    $query = "select olymp_level_id from olymp_levels where olymp_level_name = '".$_POST["olymp_level_name"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $olymp_level_id = $row['olymp_level_id'];
    }

    $query = "UPDATE olymp_info 
    SET name_olymp='".$_POST["name_olymp"]."',  
    olymp_subject='".$_POST["olymp_subject"]."' , 
    olymp_level_id=".$olymp_level_id."  
    WHERE olymp_id =".$id;

    $result = mysqli_query($db, $query); 
    header("location:tables.php");
} else if (isset($_POST["button55"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if ($button == 5) {
    $result->close();
    $db->next_result();
    $query = "SELECT olymp_id, name_olymp, olymp_subject, olymp_level_name
    from olymp_info join olymp_levels on 
    olymp_info.olymp_level_id = olymp_levels.olymp_level_id where olymp_id = ".$id.";";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    echo"<b>Старая информация:</b>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Название олимпиады</td><td>Предмет олимпиады</td>
    <td>Уровень олимпиады</td></tr></b>";
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td><td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td></tr>";
    };
    echo "</table><br>";    
    echo"<b>Введите новую информацию:</b>";
    ?>

    <form method="post" action="">
    <input type="text" name="name_olymp" placeholder="Название олимпиады" class="form-control"><br>
    <input type="text" name="olymp_subject" placeholder="Предмет олимпиады" class="form-control"><br>

    <?php
    $result->close();
    $db->next_result();
    $query = "select olymp_level_name from olymp_levels;";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    ?>
    <select name='olymp_level_name' class="form-select" aria-label="Default select example">
    <?php
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<option value='$row[0]'>$row[0]</option>";
    };
    ?>
    </select>
   <br><input type="submit" value="Изменить" name="button55" class="btn btn-outline-dark">
    </form><br>
    <?php
}

//<!--button6================================================================================================================================-->

if (isset($_POST["olymp_name_place"]) && isset($_POST["olymp_place_coef"]) &&
    $_POST["olymp_name_place"] != '' && $_POST["olymp_place_coef"] != ''
    && is_numeric($_POST["olymp_place_coef"]) && isset($_POST["button66"])) {

    $query = "UPDATE olymp_places 
    SET olymp_name_place='".$_POST["olymp_name_place"]."',  
    olymp_place_coef=".$_POST["olymp_place_coef"]." 
    WHERE olymp_place_id=".$id;
    $result = mysqli_query($db, $query); 
    header("location:tables.php");
} else if (isset($_POST["button66"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if ($button == 6) {
    $result->close();
    $db->next_result();
    $query = "SELECT olymp_place_id, olymp_name_place, olymp_place_coef from olymp_places where olymp_place_id =".$id.";";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    echo"<b>Старая информация:</b>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Место</td><td>Оценка</td></tr></b>";
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
        <td>$row[2]</td></tr>";
    };
    echo "</table><br>";    
    echo"<b>Введите новую информацию:</b>";
    ?>

    <form method="post" action="">
    <input type="text" name="olymp_name_place" placeholder="Место" class="form-control"><br>
    <input type="text" name="olymp_place_coef" placeholder="Оценка" class="form-control"><br>
    <input type="submit" value="Изменить" name="button66" class="btn btn-outline-dark">
    </form><br>
    <?php
}

//<!--button7================================================================================================================================-->

if (isset($_POST["olymp_level_name"]) && isset($_POST["olymp_grade"]) &&
    $_POST["olymp_level_name"] != '' && $_POST["olymp_grade"] != ''
    && is_numeric($_POST["olymp_grade"]) && isset($_POST["button77"])) {

    $query = "UPDATE olymp_levels 
    SET olymp_level_name='".$_POST["olymp_level_name"]."',  
    olymp_grade=".$_POST["olymp_grade"]." 
    WHERE olymp_level_id=".$id;
    $result = mysqli_query($db, $query); 
    header("location:tables.php");
} else if (isset($_POST["button77"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if ($button == 7) {
    $result->close();
    $db->next_result();
    $query = "SELECT olymp_level_id, olymp_level_name, olymp_grade from olymp_levels where olymp_level_id =".$id.";";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    echo"<b>Старая информация:</b>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Уровень олимпиады</td><td>Оценка</td></tr></b>";
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
        <td>$row[2]</td></tr>";
    };
    echo "</table><br>";    
    echo"<b>Введите новую информацию:</b>";
    ?>

    <form method="post" action="">
    <input type="text" name="olymp_level_name" placeholder="Уровень олимпиады" class="form-control"><br>
    <input type="text" name="olymp_grade" placeholder="Оценка" class="form-control"><br>
    <input type="submit" value="Изменить" name="button77" class="btn btn-outline-dark">
    </form><br>
    <?php
}

//<!--button8================================================================================================================================-->

if (isset($_POST["name_sport"]) && isset($_POST["sport_subject"]) && isset($_POST["sport_level_name"]) &&
    $_POST["name_sport"] != '' && $_POST["sport_subject"] != '' && $_POST["sport_level_name"] != ''
    && isset($_POST["button88"])) {

    $result->close();
    $db->next_result();
    $query = "select sport_level_id from sport_levels where sport_level_name = '".$_POST["sport_level_name"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $sport_level_id = $row['sport_level_id'];
    }

    $query = "UPDATE sport_info 
    SET name_sport='".$_POST["name_sport"]."',  
    sport_subject='".$_POST["sport_subject"]."' , 
    sport_level_id=".$sport_level_id."  
    WHERE sport_id =".$id;
    $result = mysqli_query($db, $query); 
    header("location:tables.php");
} else if (isset($_POST["button88"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if ($button == 8) {
    $result->close();
    $db->next_result();
    $query = "SELECT sport_id, name_sport, sport_subject, sport_level_name
    from sport_info join sport_levels on 
    sport_info.sport_level_id = sport_levels.sport_level_id where sport_id = ".$id.";";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    echo"<b>Старая информация:</b>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Название соревнования</td><td>Предмет соревнования</td>
    <td>Уровень соревнования</td></tr></b>";
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td><td>$row[1]</td> 
        <td>$row[2]</td><td>$row[3]</td></tr>";
    };
    echo "</table><br>";    
    echo"<b>Введите новую информацию:</b>";
    ?>

    <form method="post" action="">
    <input type="text" name="name_sport" placeholder="Название соревнования" class="form-control"><br>
    <input type="text" name="sport_subject" placeholder="Вид спорта соревнования" class="form-control"><br>

    <?php
    $result->close();
    $db->next_result();
    $query = "select sport_level_name from sport_levels;";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);
    ?>
    <select name='sport_level_name' class="form-select" aria-label="Default select example">
    <?php
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<option value='$row[0]'>$row[0]</option>";
    };
    ?>
    </select>
   <br><input type="submit" value="Изменить" name="button88" class="btn btn-outline-dark">
    </form><br>
    <?php
}

//<!--button9================================================================================================================================-->

if (isset($_POST["sport_name_place"]) && isset($_POST["sport_place_coef"]) &&
    $_POST["sport_name_place"] != '' && $_POST["sport_place_coef"] != ''
    && is_numeric($_POST["sport_place_coef"]) && isset($_POST["button99"])) {

    $query = "UPDATE sport_places 
    SET sport_name_place='".$_POST["sport_name_place"]."',  
    sport_place_coef=".$_POST["sport_place_coef"]." 
    WHERE sport_place_id=".$id;
    $result = mysqli_query($db, $query); 
    header("location:tables.php");
} else if (isset($_POST["button66"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if ($button == 9) {
    $result->close();
    $db->next_result();
    $query = "SELECT sport_place_id, sport_name_place, sport_place_coef from sport_places where sport_place_id =".$id.";";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    echo"<b>Старая информация:</b>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Место</td><td>Оценка</td></tr></b>";
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
        <td>$row[2]</td></tr>";
    };
    echo "</table><br>";    
    echo"<b>Введите новую информацию:</b>";
    ?>

    <form method="post" action="">
    <input type="text" name="sport_name_place" placeholder="Место" class="form-control"><br>
    <input type="text" name="sport_place_coef" placeholder="Оценка" class="form-control"><br>
    <input type="submit" value="Изменить" name="button99" class="btn btn-outline-dark">
    </form><br>
    <?php
}

//<!--button10================================================================================================================================-->

if (isset($_POST["sport_level_name"]) && isset($_POST["sport_grade"]) &&
    $_POST["sport_level_name"] != '' && $_POST["sport_grade"] != ''
    && is_numeric($_POST["sport_grade"]) && isset($_POST["button1010"])) {

    $query = "UPDATE sport_levels 
    SET sport_level_name='".$_POST["sport_level_name"]."',  
    sport_grade=".$_POST["sport_grade"]." 
    WHERE sport_level_id=".$id;
    $result = mysqli_query($db, $query); 
    header("location:tables.php");
} else if (isset($_POST["button1010"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if ($button == 10) {
    $result->close();
    $db->next_result();
    $query = "SELECT sport_level_id, sport_level_name, sport_grade from sport_levels where sport_level_id =".$id.";";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    echo"<b>Старая информация:</b>";
    echo "<table class=\"table table-hover border\"> <br />";
    echo "<b><tr><td>id</td><td>Уровень соревнования</td><td>Оценка</td></tr></b>";
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_row($result);
        echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
        <td>$row[2]</td></tr>";
    };
    echo "</table><br>";    
    echo"<b>Введите новую информацию:</b>";
    ?>

    <form method="post" action="">
    <input type="text" name="sport_level_name" placeholder="Уровень соревнования" class="form-control"><br>
    <input type="text" name="sport_grade" placeholder="Оценка" class="form-control"><br>
    <input type="submit" value="Изменить" name="button1010" class="btn btn-outline-dark">
    </form><br>
    <?php
}
