<?php
$title = "Звезда гимназии";
require "blocks/header.php";

if (!isset($_SESSION['login'])) {
    // Пользователь не авторизован - перенаправление на страницу авторизации
    header('Location: autorization.php');
    exit;
}
if ($_SESSION['user_level'] == 1) {
?>
<div class="container mt-2">
<h1>Звезда гимназии<br></h1>

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

$result->close();
$db->next_result();
$query = "select student_name from students;";
$result = mysqli_query($db, $query);
$num_results = mysqli_num_rows($result);
?>

<form method="post" action="">
<?php echo "Ученик:";?>    
<select name='student_name' class="form-select" aria-label="Default select example">
<?php
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_row($result);
    echo "<option value='$row[0]'>$row[0]</option>";
};
?>
</select>

<br>
<?php echo "Место:";?>
<select name='place' class="form-select" aria-label="Default select example">
  <option value="1">1-ое место</option>
  <option value="2">2-ое место</option>
  <option value="3">3-е место</option>
</select>

<br>
<?php echo "Категория:";?>
<select name='category' class="form-select" aria-label="Default select example">
  <option value="Интеллект">Интеллект</option>
  <option value="Спорт">Спорт</option>
  <option value="Общественная детельность">Общественная детельность</option>
</select>

<br>
<input type="submit" value="Создать диплом" name="button" class="btn btn-outline-dark">
</form><br>

<?php
if(isset($_POST['button'])) {
        $usernameDOC = $_POST['student_name'];
        $categoryDOC = $_POST['category'];

        require_once 'vendor/autoload.php';

        if (isset($_POST["student_name"]) && isset($_POST["category"])) {

            if ($_POST["place"] == 1) {
                $document = new \PhpOffice\PhpWord\TemplateProcessor('./Star_1.docx');
            }
            
            if ($_POST["place"] == 2) {
                $document = new \PhpOffice\PhpWord\TemplateProcessor('./Star_2.docx');
            }

            if ($_POST["place"] == 3) {
                $document = new \PhpOffice\PhpWord\TemplateProcessor('./Star_3.docx');
            }

            $outputFile = 'Звезда Гимназии '.$_POST["student_name"].'.docx';
            $document->setValue('name', $usernameDOC);
            $document->setValue('category', $categoryDOC);
        
            $document->saveAs($outputFile);
        }
    }
}
