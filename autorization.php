<?php
$title = "Авторизация";
require "blocks/header.php";

if (isset($_POST['logout'])) {
  // Выход из системы
  session_destroy();
  header('Location: autorization.php');
  exit;
}

if (isset($_POST['login']) && isset($_POST['pass'])) {
  $login = $_POST['login'];
  $pass = $_POST['pass'];

  $db = mysqli_connect("localhost", "root", "", "school");
  if (!$db) {
    echo "Error: Could not connect to database.";
    exit;
  }

  // Поиск пользователя в базе данных
  $query = "SELECT * FROM users WHERE login='$login'";
  $result = mysqli_query($db, $query);

  if ($result) {
    if ($user = mysqli_fetch_assoc($result)) {
      // Пользователь найден
      // Проверка пароля
      if (password_verify($pass, $user['pass'])) {
        // Авторизация успешна
        $_SESSION['login'] = $login;
        $_SESSION['user_level'] = $user['user_level'];
        header('Location: autorization.php');
      } else {
        // Неверный пароль
        echo " <div class=\"container mt-2\"> 
            <h1 style=\"color: #FF2400\">Неверный логин или пароль</h1>";
      }
    } else {
      // Пользователь не найден
      echo " <div class=\"container mt-2\"> 
        <h1 style=\"color: #FF2400\">Неверный логин или пароль</h1>";
    }
  } else {
    // Ошибка выполнения запроса
    echo " <div class=\"container mt-2\"> 
      <h1 style=\"color: #FF2400\">Ошибка выполнения запроса</h1>";
  }
  mysqli_close($db);
}
?>

<?php if (isset($_SESSION['login'])) : ?>
  <div class="container mt-2">
    <div class="alert alert-dark" role="alert">
      <p>Вы вошли как <b><?= htmlspecialchars($_SESSION['login']) ?></b></p>
    </div>
    <form method="post">
      <input type="submit" class="btn btn-outline-dark" name="logout" value="Выйти">
    </form>
  <?php else : ?>
    <div class="container mt-2">
      <h1>Авторизация</h1>
      <form method="post">
        <label for="login" class="form-label">Имя пользователя:</label><br>
        <input type="text" class="form-control-sm" name="login" id="login" required><br>
        <label for="pass" class="form-label">Пароль:</label><br>
        <input type="password" class="form-control-sm" name="pass" id="pass" required><br><br>
        <input type="submit" class="btn btn-outline-dark" value="Войти">
      </form>
    <?php endif;?>
