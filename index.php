<?php
  session_start();

  if($_SESSION['user']) {
    header('Location: profile.php');
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Форма авторизации</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <form>
    <label for="login">Логин</label>
    <input id="login" type="text" name="login">
    <label for="pass">Пароль</label>
    <input type="password" name="pass" id="pass">
    <button class="jq-login-btn" type="submit">Войти</button>
    <p>У вас нет аккаунта? <a href="register.php">Зарегестрируйтесь!</a></p>
    <div class="msg"></div>
  </form>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>