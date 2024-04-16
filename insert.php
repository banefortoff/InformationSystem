<?php
    $title = "Добавление записи";
    require "blocks/header.php";
    if (!isset($_SESSION['login'])) {
        // Пользователь не авторизован - перенаправление на страницу авторизации
        header('Location: autorization.php');
        exit;
    }
?>
<div class="container mt-2">
<h1>Добавление записей в таблицы<br></h1>

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
//<!--button1================================================================================================================================-->
if (isset($_POST["student_name"]) && isset($_POST["class_parallel"]) && isset($_POST["class_letter"]) &&
    $_POST["student_name"] != '' && $_POST["class_parallel"] != '' && $_POST["class_letter"] != ''
    && is_numeric($_POST["class_parallel"]) && isset($_POST["button11"])) {

    $result->close();
    $db->next_result();
    $query = "SELECT MAX(student_id) + 1 from students;";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $max_id = $row['MAX(student_id) + 1'];
    }

    $result->close();
    $db->next_result();
    $query = "insert into students (student_id, student_name, class_parallel, class_letter, characteristic_class) 
    values (".$max_id.",'".$_POST["student_name"]."',".$_POST["class_parallel"]."
    ,'".$_POST["class_letter"]."', '".$_POST["characteristic_class"]."');";
    $result = mysqli_query($db, $query);
} else if (isset($_POST["button11"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if(isset($_POST['button1'])) {
    echo"<b>Введите новую запись:</b>";
    ?>
    <form method="post" action="">
    <input type="text" name="student_name" placeholder="ФИО ученика" class="form-control"><br>
    <input type="text" name="class_parallel" placeholder="Параллель" class="form-control"><br>
    <input type="text" name="class_letter" placeholder="Класс(буква)" class="form-control"><br>
    <textarea type="text" name="characteristic_class" 
    placeholder="Характеристика(не более 400 символов)" class="form-control"></textarea><br>
    <input type="submit" value="Добавить запись" name="button11" class="btn btn-outline-dark">
    </form><br>
    <?php
}


//<!--button2================================================================================================================================-->


if (isset($_POST["student_name"]) && isset($_POST["name_olymp"]) && isset($_POST["olymp_name_place"]) &&
    $_POST["student_name"] != '' && $_POST["name_olymp"] != '' && $_POST["olymp_name_place"] != ''
    && isset($_POST["button22"])) {
    $result->close();
    $db->next_result();
    $query = "SELECT MAX(id_olymp_ach) + 1 from olymp_achivments;";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $max_id = $row['MAX(id_olymp_ach) + 1'];
    }
    
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

    $query = "insert into olymp_achivments (id_olymp_ach, student_id, olymp_id,
    olymp_place_id) values (".$max_id.",".$student_id.",".$olymp_id."
    ,".$olymp_place_id.");";
    
    $result = mysqli_query($db, $query); 
} else if (isset($_POST["button22"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if(isset($_POST['button2'])) {
    echo"<b>Введите новую запись:</b>";

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

    <input type="submit" value="Добавить запись" name="button22" class="btn btn-outline-dark">
    </form><br>
    <?php
}


//<!--button3================================================================================================================================-->


if (isset($_POST["student_name"]) && isset($_POST["name_sport"]) && isset($_POST["sport_name_place"]) &&
    $_POST["student_name"] != '' && $_POST["name_sport"] != '' && $_POST["sport_name_place"] != ''
    && isset($_POST["button33"])) {
    $result->close();
    $db->next_result();
    $query = "SELECT MAX(id_sport_ach) + 1 from sport_achivments;";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $max_id = $row['MAX(id_sport_ach) + 1'];
    }
    
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

    $query = "insert into sport_achivments (id_sport_ach, student_id, sport_id,
    sport_place_id) values (".$max_id.",".$student_id.",".$sport_id."
    ,".$sport_place_id.");";
    $result = mysqli_query($db, $query); 
} else if (isset($_POST["button33"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if(isset($_POST['button3'])) {
    echo"<b>Введите новую запись:</b>";

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

    <input type="submit" value="Добавить запись" name="button33" class="btn btn-outline-dark">
    </form><br>
    <?php
}


//<!--button4================================================================================================================================-->


if (isset($_POST["student_name"]) && isset($_POST["name_social_ach"]) && isset($_POST["social_grade"]) &&
    $_POST["student_name"] != '' && $_POST["name_social_ach"] != '' && $_POST["social_grade"] != ''
    && is_numeric($_POST["social_grade"]) && isset($_POST["button44"])) {

    $result->close();
    $db->next_result();
    $query = "SELECT MAX(id_social_ach) + 1 from social_achivments;";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $max_id = $row['MAX(id_social_ach) + 1'];
    }

    $result->close();
    $db->next_result();
    $query = "select student_id from students where student_name = '".$_POST["student_name"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $student_id = $row['student_id'];
    }

    $query = "insert into social_achivments (id_social_ach, student_id, name_social_ach, social_grade)
    values (".$max_id.", ".$student_id.", '".$_POST["name_social_ach"]."', ".$_POST["social_grade"].");";

    $result = mysqli_query($db, $query);
} else if (isset($_POST["button44"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if (isset($_POST['button4'])) { 
    echo"<b>Введите новую запись:</b>";
    ?>
    <form method="post" action="">
    <input type="text" name="student_name" placeholder="ФИО ученика" class="form-control"><br>
    <input type="text" name="name_social_ach" placeholder="Социальное достижение" class="form-control"><br>
    <input type="text" name="social_grade" placeholder="Оценка" class="form-control"><br>
    <input type="submit" value="Добавить запись" name="button44" class="btn btn-outline-dark">
    </form><br>
    <?php
}



//<!--button5================================================================================================================================-->


if (isset($_POST["name_olymp"]) && isset($_POST["olymp_subject"]) && isset($_POST["olymp_level_name"]) &&
    $_POST["name_olymp"] != '' && $_POST["olymp_subject"] != '' && $_POST["olymp_level_name"] != ''
    && isset($_POST["button55"])) {

    $result->close();
    $db->next_result();
    $query = "SELECT MAX(olymp_id) + 1 from olymp_info;";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $max_id = $row['MAX(olymp_id) + 1'];
    }


    $result->close();
    $db->next_result();
    $query = "select olymp_level_id from olymp_levels where olymp_level_name = '".$_POST["olymp_level_name"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $olymp_level_id = $row['olymp_level_id'];
    }

    $query = "insert into olymp_info (olymp_id, name_olymp, olymp_subject, olymp_level_id)
    values (".$max_id.", '".$_POST["name_olymp"]."', '".$_POST["olymp_subject"]."', ".$olymp_level_id.");";
    $result = mysqli_query($db, $query); 
} else if (isset($_POST["button55"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if (isset($_POST['button5'])) { 
    
    echo"<b>Введите новую запись:</b>";
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
   <br><input type="submit" value="Добавить запись" name="button55" class="btn btn-outline-dark">
    </form><br>
    <?php
}


//<!--button6================================================================================================================================-->


if (isset($_POST["olymp_name_place"]) && isset($_POST["olymp_place_coef"]) &&
    $_POST["olymp_name_place"] != '' && $_POST["olymp_place_coef"] != ''
    && is_numeric($_POST["olymp_place_coef"]) && isset($_POST["button66"])) {
    $result->close();
    $db->next_result();
    $query = "SELECT MAX(olymp_place_id) + 1 from olymp_places;";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $max_id = $row['MAX(olymp_place_id) + 1'];
    }

    $query = "insert into olymp_places (olymp_place_id, olymp_name_place, olymp_place_coef) 
    values (".$max_id.", '".$_POST["olymp_name_place"]."', ".$_POST["olymp_place_coef"].");";
    $result = mysqli_query($db, $query); 
} else if (isset($_POST["button66"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if (isset($_POST['button6'])) {  
    echo"<b>Введите новую запись:</b>";
    ?>
    <form method="post" action="">
    <input type="text" name="olymp_name_place" placeholder="Место" class="form-control"><br>
    <input type="text" name="olymp_place_coef" placeholder="Оценка" class="form-control"><br>
    <input type="submit" value="Добавить запись" name="button66" class="btn btn-outline-dark">
    </form><br>
    <?php
}


//<!--button7================================================================================================================================-->


if (isset($_POST["olymp_level_name"]) && isset($_POST["olymp_grade"]) &&
    $_POST["olymp_level_name"] != '' && $_POST["olymp_grade"] != ''
    && is_numeric($_POST["olymp_grade"]) && isset($_POST["button77"])) {
    $result->close();
    $db->next_result();
    $query = "SELECT MAX(olymp_level_id) + 1 from olymp_levels;";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $max_id = $row['MAX(olymp_level_id) + 1'];
    }

    $query = "insert into olymp_levels (olymp_level_id, olymp_level_name, olymp_grade) 
    values (".$max_id.", '".$_POST["olymp_level_name"]."', ".$_POST["olymp_grade"].");";

    $result = mysqli_query($db, $query); 
} else if (isset($_POST["button77"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if (isset($_POST['button7'])) { 
    echo"<b>Введите новую запись:</b>";
    ?>
    <form method="post" action="">
    <input type="text" name="olymp_level_name" placeholder="Уровень олимпиады" class="form-control"><br>
    <input type="text" name="olymp_grade" placeholder="Оценка" class="form-control"><br>
    <input type="submit" value="Добавить запись" name="button77" class="btn btn-outline-dark">
    </form><br>
    <?php
}


//<!--button8================================================================================================================================-->


if (isset($_POST["name_sport"]) && isset($_POST["sport_subject"]) && isset($_POST["sport_level_name"]) &&
    $_POST["name_sport"] != '' && $_POST["sport_subject"] != '' && $_POST["sport_level_name"] != ''
    && isset($_POST["button88"])) {

    $result->close();
    $db->next_result();
    $query = "SELECT MAX(sport_id) + 1 from sport_info;";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $max_id = $row['MAX(sport_id) + 1'];
    }

    $result->close();
    $db->next_result();
    $query = "select sport_level_id from sport_levels where sport_level_name = '".$_POST["sport_level_name"]."';";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $sport_level_id = $row['sport_level_id'];
    }

    $query = "insert into sport_info (sport_id, name_sport, sport_subject, sport_level_id)
    values (".$max_id.", '".$_POST["name_sport"]."', '".$_POST["sport_subject"]."', ".$sport_level_id.");";

    $result = mysqli_query($db, $query); 
} else if (isset($_POST["button88"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if (isset($_POST['button8'])) {   
    echo"<b>Введите новую запись:</b>";
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
   <br><input type="submit" value="Добавить запись" name="button88" class="btn btn-outline-dark">
    </form><br>
    <?php
}


//<!--button9================================================================================================================================-->


if (isset($_POST["sport_name_place"]) && isset($_POST["sport_place_coef"]) &&
    $_POST["sport_name_place"] != '' && $_POST["sport_place_coef"] != ''
    && is_numeric($_POST["sport_place_coef"]) && isset($_POST["button99"])) {
    $result->close();
    $db->next_result();
    $query = "SELECT MAX(sport_place_id) + 1 from sport_places;";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $max_id = $row['MAX(sport_place_id) + 1'];
    }

    $query = "insert into sport_places (sport_place_id, sport_name_place, sport_place_coef) 
    values (".$max_id.", '".$_POST["sport_name_place"]."', ".$_POST["sport_place_coef"].");";

    $result = mysqli_query($db, $query); 
} else if (isset($_POST["button66"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if (isset($_POST['button9'])) { 
    echo"<b>Введите новую запись:</b>";
    ?>
    <form method="post" action="">
    <input type="text" name="sport_name_place" placeholder="Место" class="form-control"><br>
    <input type="text" name="sport_place_coef" placeholder="Оценка" class="form-control"><br>
    <input type="submit" value="Добавить запись" name="button99" class="btn btn-outline-dark">
    </form><br>
    <?php
}


//<!--button10================================================================================================================================-->


if (isset($_POST["sport_level_name"]) && isset($_POST["sport_grade"]) &&
    $_POST["sport_level_name"] != '' && $_POST["sport_grade"] != ''
    && is_numeric($_POST["sport_grade"]) && isset($_POST["button1010"])) {

    $result->close();
    $db->next_result();
    $query = "SELECT MAX(sport_level_id) + 1 from sport_levels;";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()) {
        $max_id = $row['MAX(sport_level_id) + 1'];
    }

    $query = "insert into sport_levels (sport_level_id, sport_level_name, sport_grade) 
    values (".$max_id.", '".$_POST["sport_level_name"]."', ".$_POST["sport_grade"].");";
 
    $result = mysqli_query($db, $query); 
} else if (isset($_POST["button1010"])){
    echo "<h1 style=\"color: #FF2400\">Введена информация с неверным типом данных или не все поля заполнены, повторите запрос</h1>";
}

if (isset($_POST['button10'])) {   
    echo"<b>Введите новую запись:</b>";
    ?>
    <form method="post" action="">
    <input type="text" name="sport_level_name" placeholder="Уровень соревнования" class="form-control"><br>
    <input type="text" name="sport_grade" placeholder="Оценка" class="form-control"><br>
    <input type="submit" value="Добавить запись" name="button1010" class="btn btn-outline-dark">
    </form><br>
    <?php
}
