<!DOCTYPE html>
<html lang="cs">
<head>
  <?php
    $website_title = 'Registrace';
    require 'blocks/head.php';
  ?>
</head>
<body>
  <?php require 'blocks/header.php'; ?>

  <main class="container mt-5">
    <div class="row">
      <div class="col-md-8 mb-3">
        <h4>Registrační formulář</h4>
        <form action="" method="post">
          <label for="username">Váše jmeno:</label>
          <input type="text" name="username" id="username" class="form-control">

          <label for="email">Váš e-mail:</label>
          <input type="email" name="email" id="email" class="form-control">

          <label for="login">Login</label>
          <input type="text" name="login" id="login" class="form-control">

          <label for="pass">Heslo</label>
          <input type="password" name="pass" id="pass" class="form-control">

          <label for="pass">Potvrzeni Heslo</label>
          <input type="password" name="pass_conf" id="pass_conf" class="form-control">

          <div class="alert alert-danger mt-2" id="errorBlock"></div>

          <button type="button" id="reg_user" class="btn btn-success mt-3">
            Vytvořit nový účet
          </button>
        </form>
      </div>

      <?php require 'blocks/aside.php'; ?>
    </div>
  </main>

  <?php require 'blocks/footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>
    $('#reg_user').click(function (e) {
      e.preventDefault();

      var name = $('#username').val();
      var email = $('#email').val();
      var login = $('#login').val();
      var pass = $('#pass').val();
      var pass_conf = $('#pass_conf').val();
      const re = /^[A-Za-z0-9]+$/i;
      const re1 = /^[a-zA-Z0-9_\.\-]+@([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,6}$/;

      if (!re.test(name)) {
        $('#errorBlock').show();
        $('#errorBlock').text("Jmeno může obsahovat pouze písmena abecedy nebo číslice");
        return false;
      }

      if (!re1.test(email)) {
        $('#errorBlock').show();
        $('#errorBlock').text("Zadejte e-mail ve formatu test@example.com");
        return false;
      }

      if (!re.test(login)) {
        $('#errorBlock').show();
        $('#errorBlock').text("Login může obsahovat pouze písmena abecedy nebo číslice");
        return false;
      }

      if(pass != pass_conf) {
        $('#errorBlock').show();
        $('#errorBlock').text("Hesla se neshodují");
        return false;
      }

      $.ajax({
        url: 'ajax/reg.php',
        type: 'POST',
        cache: false,
        data: {'username' : name, 'email' : email, 'login' : login, 'pass' : pass},
        dataType: 'html',
        success: function(data) {
          if(data == 'Hotovo') {
            $('#reg_user').text('Vše je připraveno');
            $('#errorBlock').hide();
            setTimeout(function(){ 
              window.location.href = "http://wa.toad.cz/~iastrnik/auth.php";
            }, 200);
          } else {
            $('#errorBlock').show();
            $('#errorBlock').text(data);
          }
        }
      });
    });
  </script>
</body>
</html>
