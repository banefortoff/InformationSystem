<?php
    $title = "Cтатистика";
    require "blocks/header.php";
if (!isset($_SESSION['login'])) {
    // Пользователь не авторизован - перенаправление на страницу авторизации
    header('Location: autorization.php');
    exit;
  }
?>

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

<div class="container mt-2">
<h1>Страница со статистикой</h1>
<h4>Выберите интересующие вас данные</h4>

<!--button1================================================================================================================================-->
<br>
<?php
if(isset($_POST['button1'])) {
    $result->close();
    $db->next_result();
    $query = "select count(student_name) from students where all_grade > 0;";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    ?>
    <div class="alert alert-dark" role="alert">
    <?php
    echo "Количество одарённых учеников: <b>$row[0]</b>";
    ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dark" role="alert">
    <?php echo "Количество одарённых учеников: ...";?>
    </div>
    <?php   
}
?>

<form method="post" action="">
<input type="submit" name="button1" value="Вывести" class="btn btn-outline-dark">
</form>

<!--button2================================================================================================================================-->
<br><br>
<?php
if(isset($_POST['button2'])) {
    $result->close();
    $db->next_result();
    $query = "select count(student_name) from students where sum_olymp_grade > 0;";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    ?>
    <div class="alert alert-dark" role="alert">
    <?php
    echo "Количество учеников с достижениями в олимпиадах: <b>$row[0]</b>";
    ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dark" role="alert">
    <?php echo "Количество учеников с достижениями в олимпиадах: ...";?>
    </div>
    <?php   
}
?>

<form method="post" action="">
<input type="submit" name="button2" value="Вывести" class="btn btn-outline-dark">
</form>

<!--button3================================================================================================================================-->
<br><br>
<?php
if(isset($_POST['button3'])) {
    $result->close();
    $db->next_result();
    $query = "select count(student_name) from students where sum_sport_grade > 0;";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    ?>
    <div class="alert alert-dark" role="alert">
    <?php
    echo "Количество учеников со спортивными достижениями: <b>$row[0]</b>";
    ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dark" role="alert">
    <?php echo "Количество учеников со спортивными достижениями: ...";?>
    </div>
    <?php   
}
?>

<form method="post" action="">
<input type="submit" name="button3" value="Вывести" class="btn btn-outline-dark">
</form>

<!--button4================================================================================================================================-->
<br><br>
<?php
if(isset($_POST['button4'])) {
    $result->close();
    $db->next_result();
    $query = "select count(student_name) from students where sum_social_grade > 0;";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    ?>
    <div class="alert alert-dark" role="alert">
    <?php
    echo "Количество учеников с социальными достижениями: <b>$row[0]</b>";
    ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dark" role="alert">
    <?php echo "Количество учеников с социальными достижениями: ...";?>
    </div>
    <?php   
}
?>

<form method="post" action="">
<input type="submit" name="button4" value="Вывести" class="btn btn-outline-dark">
</form>

<!--button5================================================================================================================================-->
<br><br>
<?php
    if(isset($_POST['button5'])) {
    $result->close();
    $db->next_result();
    $query = "call get_count_students_by_parallel('".$_POST['parallel']."');";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    ?>
    <div class="alert alert-dark" role="alert">
    <?php
    echo "Количество одарённых учеников в <b>".$_POST['parallel']." параллели</b> : <b>$row[0]</b>";
    ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dark" role="alert">
    <?php echo "Количество одарённых учеников в параллели: ...";?>
    </div>
    <?php   
}
?>

<?php
$result->close();
$db->next_result();
$query = "select DISTINCT class_parallel from students order by class_parallel desc;";
$result = mysqli_query($db, $query);
$num_results = mysqli_num_rows($result);
?>
<form method="post" action="">
<select name='parallel' class="form-select" aria-label="Default select example">
<?php
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_row($result);
    echo "<option value='$row[0]'>$row[0]</option>";
};
?>
</select>
<input type="submit" name="button5" value="Вывести" class="btn btn-outline-dark">
</form>

<!--button6================================================================================================================================-->
<br><br>
<?php
if(isset($_POST['button6'])) {
    $result->close();
    $db->next_result();
    $query = "call get_count_by_olymp_name('".$_POST['olymp_name']."');";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    ?>
    <div class="alert alert-dark" role="alert">
    <?php
    echo "Количество учеников, учавствующих в <b>".$_POST['olymp_name']."</b>: <b>$row[0]</b>";
    ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dark" role="alert">
    <?php echo "Количество учеников, учавствующих в олимпиаде: ...";?>
    </div>
    <?php   
}
?>

<?php
$result->close();
$db->next_result();
$query = "select DISTINCT name_olymp from olymp_achivments join students on students.student_id = olymp_achivments.student_id join olymp_info on olymp_achivments.olymp_id = olymp_info.olymp_id;";
$result = mysqli_query($db, $query);
$num_results = mysqli_num_rows($result);
?>
<form method="post" action="">
<select name='olymp_name' class="form-select" aria-label="Default select example">
<?php
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_row($result);
    echo "<option value='$row[0]'>$row[0]</option>";
};
?>
</select>
<input type="submit" name="button6" value="Вывести" class="btn btn-outline-dark">
</form>

<!--button7================================================================================================================================-->
<br><br>
<?php
if(isset($_POST['button7'])) {
    $result->close();
    $db->next_result();
    $query = "call get_count_by_sport_name('".$_POST['sport_name']."');";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    ?>
    <div class="alert alert-dark" role="alert">
    <?php
    echo "Количество учеников, учавствующих в <b>".$_POST['sport_name']."</b>: <b>$row[0]</b>";
    ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dark" role="alert">
    <?php echo "Количество учеников, учавствующих в соревновании: ...";?>
    </div>
    <?php   
}
?>

<?php
$result->close();
$db->next_result();
$query = "select DISTINCT name_sport from sport_achivments join students on students.student_id = sport_achivments.student_id join sport_info on sport_achivments.sport_id = sport_info.sport_id;";
$result = mysqli_query($db, $query);
$num_results = mysqli_num_rows($result);
?>
<form method="post" action="">
<select name='sport_name' class="form-select" aria-label="Default select example">
<?php
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_row($result);
    echo "<option value='$row[0]'>$row[0]</option>";
};
?>
</select>
<input type="submit" name="button7" value="Вывести" class="btn btn-outline-dark">
</form>

<!--button8================================================================================================================================-->
<br><br>
<?php
if(isset($_POST['button8'])) {
    $result->close();
    $db->next_result();
    $query = "call get_count_by_sport_subject('".$_POST['sport_subject']."');";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    ?>
    <div class="alert alert-dark" role="alert">
    <?php
    echo "Количество учеников, получивших достижение, связанное с видом спорта <b>".$_POST['sport_subject']."</b>: <b>$row[0]</b>";
    ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dark" role="alert">
    <?php echo "Количество учеников, получивших достижение, связанное с видом спорта: ...";?>
    </div>
    <?php   
}
?>

<?php
$result->close();
$db->next_result();
$query = "Select DISTINCT sport_subject from sport_achivments join students on students.student_id = sport_achivments.student_id join sport_info on sport_achivments.sport_id = sport_info.sport_id;";
$result = mysqli_query($db, $query);
$num_results = mysqli_num_rows($result);
?>
<form method="post" action="">
<select name='sport_subject' class="form-select" aria-label="Default select example">
<?php
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_row($result);
    echo "<option value='$row[0]'>$row[0]</option>";
};
?>
</select>
<input type="submit" name="button8" value="Вывести" class="btn btn-outline-dark">
</form>

<!--button9================================================================================================================================-->
<br><br>
<?php
if(isset($_POST['button9'])) {
    $result->close();
    $db->next_result();
    $query = "Call get_count_by_subject('".$_POST['subject']."');";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    ?>
    <div class="alert alert-dark" role="alert">
    <?php
    echo "Количество учеников, получивших достижение, связанное с предметом <b>".$_POST['subject']."</b>: <b>$row[0]</b>";
    ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dark" role="alert">
    <?php echo "Количество учеников, получивших достижение, связанное с предметом: ...";?>
    </div>
    <?php   
}
?>

<?php
$result->close();
$db->next_result();
$query = "Select DISTINCT olymp_subject from olymp_achivments join students on students.student_id = olymp_achivments.student_id join olymp_info on olymp_achivments.olymp_id = olymp_info.olymp_id;";
$result = mysqli_query($db, $query);
$num_results = mysqli_num_rows($result);
?>
<form method="post" action="">
<select name='subject' class="form-select" aria-label="Default select example">
<?php
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_row($result);
    echo "<option value='$row[0]'>$row[0]</option>";
};
?>
</select>
<input type="submit" name="button9" value="Вывести" class="btn btn-outline-dark">
</form>

<!--button10================================================================================================================================-->
<br><br>
<?php
if(isset($_POST['button10'])) {
    $result->close();
    $db->next_result();
    $query = "call get_count_by_olymp_level('".$_POST['olymp_level']."');";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    ?>
    <div class="alert alert-dark" role="alert">
    <?php
    echo "Количество учеников, получивших достижение в олимпиаде уровня(<b>".$_POST['olymp_level']."</b>): <b>$row[0]</b>";
    ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dark" role="alert">
    <?php echo "Количество учеников, получивших достижение в олимпиаде уровня: ...";?>
    </div>
    <?php   
}
?>

<?php
$result->close();
$db->next_result();
$query = "select olymp_level_name from olymp_levels;";
$result = mysqli_query($db, $query);
$num_results = mysqli_num_rows($result);
?>
<form method="post" action="">
<select name='olymp_level' class="form-select" aria-label="Default select example">
<?php
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_row($result);
    echo "<option value='$row[0]'>$row[0]</option>";
};
?>
</select>
<input type="submit" name="button10" value="Вывести" class="btn btn-outline-dark">
</form>

<!--button11================================================================================================================================-->
<br><br>
<?php
if(isset($_POST['button11'])) {
    $result->close();
    $db->next_result();
    $query = "call get_count_by_sport_level('".$_POST['sport_level']."');";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($result);
    ?>
    <div class="alert alert-dark" role="alert">
    <?php
    echo "Количество учеников, получивших достижение в спортивном соревновании уровня(<b>".$_POST['sport_level']."</b>): <b>$row[0]</b>";
    ?>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-dark" role="alert">
    <?php echo "Количество учеников, получивших достижение в спортивном соревновании уровня: ...";?>
    </div>
    <?php   
}
?>

<?php
$result->close();
$db->next_result();
$query = "select sport_level_name from sport_levels;";
$result = mysqli_query($db, $query);
$num_results = mysqli_num_rows($result);
?>
<form method="post" action="">
<select name='sport_level' class="form-select" aria-label="Default select example">
<?php
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_row($result);
    echo "<option value='$row[0]'>$row[0]</option>";
};
?>
</select>
<input type="submit" name="button11" value="Вывести" class="btn btn-outline-dark">
</form>
<br><br>

<?php
    require "blocks/footer.php";
?>
