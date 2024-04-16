<?php
$title = "Save_file";
require "blocks/header.php";
if (!isset($_SESSION['login'])) {
    // Пользователь не авторизован - перенаправление на страницу авторизации
    header('Location: autorization.php');
    exit;
}

if(isset($_POST['button6'])) {
        $usernameDOC = $_POST['usernameDOC'];
        $rowstringDOC = $_POST['rowstringDOC'];
        $charDOC = $_POST['charDOC'];

        require_once 'vendor/autoload.php';
        $document = new \PhpOffice\PhpWord\TemplateProcessor('./portfolio.docx');
        $outputFile = 'Портфолио '.$_POST["usernameDOC"].'.docx';

        $document->setValue('row_string', $rowstringDOC);
        $document->setValue('name', $usernameDOC);
        $document->setValue('char', $charDOC);
    
        $document->saveAs($outputFile);
        header("location:portfolio.php");
    }

if(isset($_POST['button5'])) {
    $usernameDOC = $_POST['usernameDOC'];
    $rowstringDOC = $_POST['rowstringDOC'];


    require_once 'vendor/autoload.php';
    $document = new \PhpOffice\PhpWord\TemplateProcessor('./portfolio_NC.docx');
    $outputFile = 'Портфолио '.$_POST["usernameDOC"].'(без характеристики).docx';

    $document->setValue('row_string', $rowstringDOC);
    $document->setValue('name', $usernameDOC);

    $document->saveAs($outputFile);
    header("location:portfolio.php");     
}
