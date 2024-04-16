<?php
    $title = "Портфолио";
    require "blocks/header.php";
    if (!isset($_SESSION['login'])) {
        // Пользователь не авторизован - перенаправление на страницу авторизации
        header('Location: autorization.php');
        exit;
    }
?>

<div class="container mt-2">
<h1>Страница портфолио Учеников<br></h1>
Введите имя ученика:

<form method="post" action="">
<input type="text" name="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username'];} ?>" class="form-control"><br>
<input type="submit" value="Вывести портфолио со всеми достижениями" name="button1" class="btn btn-outline-dark">
<input type="submit" value="Вывести портфолио с достижениями в олимпиадах" name="button2" class="btn btn-outline-dark">
<input type="submit" value="Вывести портфолио со всеми спортивными достижениями" name="button3" class="btn btn-outline-dark">
<input type="submit" value="Вывести портфолио со всеми социальными достижениями" name="button4" class="btn btn-outline-dark">
</form><br>

<?php
function olymp($db) {
    $row_string = '';
    $query = "call get_olymp_ach_by_name('" . $_POST['username'] . "');";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    if ($num_results <= 0) {
        echo "<br>";
        echo "<h1>У данного ученика нет достижений в олимпиадах</h1>";
        echo "<br>";
    } else {
        echo "<table class=\"table table-hover border\"> <br />";
        echo "<b><tr><td>ФИО ученика</td><td>Параллель</td>
        <td>Класс</td><td>Олимпиада</td><td>Место</td>
        <td>Уровень достижения</td></tr></b>";
        for ($i = 0; $i < $num_results; $i++) {
            $row = mysqli_fetch_row($result);
            echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
            <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>
            <td>$row[5]</td>";
            $row_string .= $row[3] . ' ' . $row[4] . '; ';
        };
        echo "</table>";
    }
    $result->close();
    $db->next_result();
    return $row_string;
}

function sport($db) {
    $row_string = '';
    $query = "call get_sport_ach_by_name('" . $_POST['username'] . "');";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    if ($num_results <= 0) {
        echo "<br>";
        echo "<h1>У данного ученика нет спортивных достижений</h1>";
        echo "<br>";
    } else {
        echo "<table class=\"table table-hover border\"> <br />";
        echo "<b><tr><td>ФИО ученика</td><td>Параллель</td>
        <td>Класс</td><td>Спортивное соревнование</td><td>Место</td>
        <td>Уровень достижения</td></tr></b>";
        for ($i = 0; $i < $num_results; $i++) {
            $row = mysqli_fetch_row($result);
            echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
            <td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>
            <td>$row[5]</td>";
            $row_string .= $row[3] . ' ' . $row[4] . '; ';
        };
        echo "</table>";
    }

    $result->close();
    $db->next_result();
    return $row_string;
}

function social($db) {
    $row_string = '';
    $query = "call get_social_ach_by_name('" . $_POST['username'] . "');";
    $result = mysqli_query($db, $query);
    $num_results = mysqli_num_rows($result);

    if ($num_results <= 0) {
        echo "<br>";
        echo "<h1>У данного ученика нет социальных достижений</h1>";
        echo "<br>";
    } else {
        echo "<table class=\"table table-hover border\"> <br />";
        echo "<b><tr><td>ФИО ученика</td><td>Параллель</td>
        <td>Класс</td><td>Социальное достижение</td></tr></b>";
        for ($i = 0; $i < $num_results; $i++) {
            $row = mysqli_fetch_row($result);
            echo "<tr><td>$row[0]</td> <td>$row[1]</td> 
            <td>$row[2]</td><td>$row[3]</td>";
            $row_string .= $row[3] . '; ';
        };
        echo "</table>";
    }

    $result->close();
    $db->next_result();
    return $row_string;
}

function char($db, $rowstringDOC) {
?>
    <div class="alert alert-dark" role="alert">
        <?php
        $query = "select characteristic_class from students where student_name = '" . $_POST['username'] . "';";
        $result = mysqli_query($db, $query);
        while ($row = $result->fetch_assoc()) {
            $rowCHAR = $row['characteristic_class'];
        }
        echo "<p>Характеристика ученика:</p>\n" . $rowCHAR . "<br>";
        global $charDOC;
        $charDOC = $rowCHAR;
        global $usernameDOC;
        $usernameDOC = $_POST['username'];
        $result->close();
        $db->next_result();
        ?>
    </div>

    <form method="post" action="save_file.php">
        <input type="hidden" id="rowstringDOC" name="rowstringDOC" value='<?= $rowstringDOC ?>' />
        <input type="hidden" id="usernameDOC" name="usernameDOC" value='<?= $usernameDOC ?>' />
        <input type="hidden" id="charDOC" name="charDOC" value='<?= $charDOC ?>' />
        <input type="submit" name="button5" value="Распечатать портфолио без характеристики" class="btn btn-outline-dark">
        <input type="submit" name="button6" value="Распечатать портфолио с характеристикой" class="btn btn-outline-dark">
    </form>
<?php
}

$db = mysqli_connect("localhost", "root", "", "school");
if (!$db) {
    echo "Error: Could not connect to database.";
    exit;
}

$query = "Call get_all_grade();";
$result = mysqli_query($db, $query);
$query = "select 1";
$result = mysqli_query($db, $query);
$result->close();
$db->next_result();
$count = 1;

if (isset($_POST['button1']) || isset($_POST['button2']) || isset($_POST['button3']) || isset($_POST['button4'])) {
    $query = "SELECT student_id FROM students WHERE student_name = '" . $_POST['username'] . "';";
    $result = mysqli_query($db, $query);
    $count = mysqli_num_rows($result);
    $result->close();
    $db->next_result();
}

if ($count <= 0) {
    echo "<br>";
    echo "<h1>Такого ученика нет в базе данных</h1>";
} else if (isset($_POST['button1'])) {
    $rowstringDOC = olymp($db);
    $rowstringDOC .= sport($db);
    $rowstringDOC .= social($db);
    char($db, $rowstringDOC);
} else if (isset($_POST['button2'])) {
    $rowstringDOC = olymp($db);
    char($db, $rowstringDOC);
} else if (isset($_POST['button3'])) {
    $rowstringDOC = sport($db);
    char($db, $rowstringDOC);
} else if (isset($_POST['button4'])) {
    $rowstringDOC = social($db);
    char($db, $rowstringDOC);
}
