<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php session_start(); ?>

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="autorization.php">Гимназия 32</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
     aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php">Лучшие ученики</a>
        <a class="nav-link active" aria-current="page" href="portfolio.php">Портфолио</a>
        <?php if (isset($_SESSION['user_level']) && $_SESSION['user_level'] == 1) 
        { ?> <a class="nav-link active" aria-current="page" href="star.php">Звезда Гимназии</a> <?php } ?>
        <a class="nav-link active" aria-current="page" href="statistic.php">Статистика</a>
        <a class="nav-link active" aria-current="page" href="tables.php">Редактирование таблиц</a>
        <a class="nav-link active" aria-current="page" href="insert.php">Добавление новых записей</a>
      </div>
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</header>
