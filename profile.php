<?php
  session_start();

  if(!$_SESSION['user']) {
    header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Профиль</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="wrap">
  <div class="profile">
    <div class="top">
      <span class="top-text">Профиль</span>
      <span class="top-text"><a href="/includes/logout.php">Выйти</a></span>
    </div>
    <div class="content">
      <div class="content-avatar">
        <div class="content-avatar__wrap">
          <img src="<?php echo $_SESSION['user']['avatar'] ?>" alt="<?php echo $_SESSION['user']['surname'] . ' ' . $_SESSION['user']['name'] ?>">
        </div>
      </div>
      <div class="content-info">
        <span class="content-info-text">Имя: <?php echo $_SESSION['user']['name'] ?></span>
        <span class="content-info-text">Фамилия: <?php echo $_SESSION['user']['surname'] ?></span>
        <span class="content-info-text">Отчество: <?php echo $_SESSION['user']['midname'] ?></span>
        <span class="content-info-text">Ваш email: <?php echo $_SESSION['user']['email'] ?></span>
      </div>
    </div>
  </div>
</div>

</body>
</html>
