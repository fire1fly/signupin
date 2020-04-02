document.addEventListener('DOMContentLoaded', () => {
  
  $('.jq-login-btn').on('click', (e) => {
    e.preventDefault();
    $(`input`).removeClass('_bg-error');
    let loginValue = $('#login').val(),
        passValue = $('#pass').val();
    
    $.ajax({
      url: '../includes/signin.php',
      type: 'POST',
      dataType: 'json',
      data: {
        login: loginValue,
        pass: passValue
      },
      success: (data) => {
        console.log(data);
        if(data.status == true) {
          document.location.href = '../profile.php';
        } else {
          $('.msg').addClass('msg_error');
          $('.msg').removeClass('msg_success');
          
          if(data.type == 1  ) {
            data.fields.forEach((input) => {
              $(`input[name="${input}"]`).addClass('_bg-error');
            });
          }
          $('.msg').text(data.message);
        }
      }
    });
  });

  let avatar = '';

  $('input[name="avatar"]').on('change', (e) => {
    avatar = e.target.files[0];
  });

  $('.jq-register-btn').on('click', (e) => {
    e.preventDefault();
    $(`input`).removeClass('_bg-error');
    let fullNameValue = $('#full_name').val(),
        loginValue = $('#login').val(),
        emailValue = $('#email').val(),
        passValue = $('#pass').val(),
        passConfValue = $('#pass_confirm').val();

    let formData = new FormData();
    formData.append('full_name', fullNameValue);
    formData.append('login', loginValue);
    formData.append('email', emailValue);
    formData.append('avatar', avatar);
    formData.append('pass', passValue);
    formData.append('pass_confirm', passConfValue);
    
    $.ajax({
      url: '../includes/signup.php',
      type: 'POST',
      dataType: 'json',
      processData: false,
      contentType: false,
      cache: false,
      data: formData,
      success: (data) => {
        console.log(data);
        if(data.status == true) {
          document.location.href = '../index.php';
        } else {
          $('.msg').addClass('msg_error');
          $('.msg').removeClass('msg_success');
          
          if(data.type == 1  ) {
            data.fields.forEach((input) => {
              $(`input[name="${input}"]`).addClass('_bg-error');
            });
          }
          $('.msg').text(data.message);
        }
      }
    });
  });
 
});