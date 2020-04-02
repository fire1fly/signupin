<?php
  session_start();
  require_once 'connect.php';

  $login = $_POST['login'];
  $pass = $_POST['pass'];

  $error_fields = [];

  if ($login === '') {
    $error_fields[] = 'login';
  }
  if ($pass === '') {
    $error_fields[] = 'pass';
  }

  if (!empty($error_fields)) {
    $response = [
      'status'  => false,
      'type'    => 1,
      'message' => 'Проверьте правильность введенных полей',
      'fields'  => $error_fields
    ];

    echo json_encode($response);

    die();
  }

  $user_check = mysqli_query($db, "SELECT * FROM `users` WHERE login = '$login';");

  if( mysqli_num_rows($user_check) > 0 ) {
    $pass_check = mysqli_query($db, "SELECT `password` FROM `users` WHERE login = '$login';");
    $pass_hash = mysqli_fetch_assoc($pass_check);
    if (password_verify($pass, $pass_hash['password'])) {
      // успешная авторизация

      // формируем данные пользователя для сессии
      $user = mysqli_fetch_assoc($user_check);
      $user_full_name_arr = explode(' ', $user['full_name']);
      $_SESSION['user'] = [
        'id'        => $user['id'],
        'surname'   => $user_full_name_arr[0],
        'name'      => $user_full_name_arr[1],
        'midname'   => $user_full_name_arr[2],
        'login'     => $user['login'],
        'email'     => $user['email'],
        'avatar'    => $user['avatar']
      ];

      $response = [
        'status'  => true,
        'type'    => 2,
        'message' => 'Авторизация прошла успешно!'
      ];

      echo json_encode($response);

      // header('Location: ../profile.php');
      
    } else {
      // $_SESSION['message'] = 'Вы ввели неверный пароль!';
      // header('Location: ../index.php');
      $response = [
        'status'  => false,
        'type'    => 2,
        'message' => 'Вы ввели неверный пароль!'
      ];

      echo json_encode($response);
    }
  } else {
    // $_SESSION['message'] = 'Пользователя с таким логином не существует!';
    // header('Location: ../index.php');
    $response = [
      'status'  => false,
      'type'    => 2,
      'message' => 'Пользователя с таким логином не существует!'
    ];

    echo json_encode($response);
  }

?>