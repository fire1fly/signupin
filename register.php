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
  <title>Регистрация</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <form>
    <h2>Регистрация</h2>
    <label for="full_name">ФИО</label>
    <input id="full_name" type="text" name="full_name" value="<?php echo $full_name ?>" required>

    <label for="login">Логин</label>
    <input id="login" type="text" name="login" required>

    <label for="email">Email</label>
    <input id="email" type="email" name="email" required>

    <label for="avatar">Изображение профиля</label>
    <input id="avatar" type="file" name="avatar">

    <label for="pass">Пароль</label>
    <input id="pass" type="password" name="pass" required>

    <label for="pass_confirm">Подтвердите пароль</label>
    <input id="pass_confirm" type="password" name="pass_confirm" required>

    <button class="jq-register-btn" type="submit">Зарегестрироваться</button>
    <p>Уже есть аккаунт? <a href="/">Авторизуйтесь!</a></p>
    <div class="msg"></div>
  </form>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>