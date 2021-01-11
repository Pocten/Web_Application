<!DOCTYPE html>
<html lang="cs">
<head>
  <?php
    $website_title = 'Autorizace na webu';
    require 'blocks/head.php';
  ?>
</head>
<body>
  <?php require 'blocks/header.php'; ?>

  <main class="container mt-5">
    <div class="row">
      <div class="col-md-8 mb-3">
        <?php
          if (!isset($_COOKIE["login"])):
        ?>
        <h4>Přihlašovací formulář</h4>
        <form action="" method="post">
          <label for="login">Login</label>
          <input type="text" name="login" id="login" class="form-control">

          <label for="pass">Heslo</label>
          <input type="password" name="pass" id="pass" class="form-control">

          <div class="alert alert-danger mt-2" id="errorBlock"></div>

          <button type="button" id="auth_user" class="btn btn-success mt-3">
          Přihlaste se
          </button>
        </form>
        <?php
          else:
        ?>
        <h2><?=$_COOKIE['login']?></h2>  
        <button class="btn btn-danger" id="exit_btn">Odhlásit se</button>
        <?php
          endif;
        ?>
      </div>

      <?php require 'blocks/aside.php'; ?>
    </div>
  </main>

  <?php require 'blocks/footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>
    $('#exit_btn').click(function () {
      $.ajax({
        url: 'ajax/exit.php',
        type: 'POST',
        cache: false,
        data: {},
        dataType: 'html',
        success: function(data) {
          document.location.reload(true);
        }
      });
    });

    $('#auth_user').click(function () {
      var login = $('#login').val();
      var pass = $('#pass').val();

      $.ajax({
        url: 'ajax/auth.php',
        type: 'POST',
        cache: false,
        data: {'login' : login, 'pass' : pass},
        dataType: 'html',
        success: function(data) {
          if(data == 'Hotovo') {
            $('#auth_user').text('Hotovo');
            $('#errorBlock').hide();
            document.location.reload(true);
            setTimeout(function(){ 
              window.location.href = "http://wa.toad.cz/~iastrnik/";
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
