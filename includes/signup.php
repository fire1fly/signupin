<?php
  session_start();
  require_once 'connect.php';

  $full_name = $_POST['full_name'];
  $login = $_POST['login'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $pass_confirm = $_POST['pass_confirm'];

  if ($full_name === '') {
    $error_fields[] = 'full_name';
  }
  if ($login === '') {
    $error_fields[] = 'login';
  }
  if ($email === '') {
    $error_fields[] = 'email';
  }
  if ($pass === '') {
    $error_fields[] = 'pass';
  }
  if ($pass_confirm === '') {
    $error_fields[] = 'pass_confirm';
  }
  if (!$_FILES['avatar']) {
    $error_fields[] = 'avatar';
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

  $login_check = mysqli_query($db, "SELECT * FROM `users` WHERE login = '$login';");
  
  if( mysqli_num_rows($login_check) == 0 ) {
    if ($pass === $pass_confirm) {
      $path_to_avatar = 'uploads/' . time() . $_FILES['avatar']['name'];
      if(!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path_to_avatar )) {
        $response = [
          'status'  => false,
          'type'    => 2,
          'message' => 'Это изображение не может быть загружено!'
        ];
        echo json_encode($response);
      }

      $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

      mysqli_query($db, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`) VALUES (NULL, '$full_name', '$login', '$email', '$pass_hash', '$path_to_avatar')");

      $response = [
        'status'  => true,
        'type'    => 2,
        'message' => 'Регистрация прошла успешно!'
      ];
      echo json_encode($response);

    } else {
      $response = [
        'status'  => false,
        'type'    => 2,
        'message' => 'Пароли не совпадают!'
      ];
      echo json_encode($response);
    }
  } else {
    $response = [
      'status'  => false,
      'type'    => 2,
      'message' => 'Данный логин занят!'
    ];
    echo json_encode($response);
  }
?>