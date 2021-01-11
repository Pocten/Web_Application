<?php
  if($_COOKIE['login'] == '') {
    header('Location: reg.php');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <?php
    $website_title = 'Přidání článku';
    require 'blocks/head.php';
  ?>
</head>
<body>
  <?php require 'blocks/header.php'; ?>

  <main class="container mt-5">
    <div class="row">
      <div class="col-md-8 mb-3">
        <h4>Přidání článku</h4>
        <form action="" method="post">
          <label for="title">Název článku</label>
          <input type="text" name="title" id="title" class="form-control">

          <label for="intro">Intro článku</label>
          <textarea name="intro" id="intro" class="form-control"></textarea>

          <label for="text">Text článku</label>
          <textarea name="text" id="text" class="form-control"></textarea>

          <div class="alert alert-danger mt-2" id="errorBlock"></div>

          <button type="button" id="article_send" class="btn btn-success mt-3">
            Přidat
          </button>
        </form>

        <div class="alert alert-success mt-3" role="alert">
            <ul>Kliknutím na toto tlačítko publikujete psaný článek, který jste napsali. 
              <li>Do formuláře „Název článku“ prosím napište maximálně jednu větu.</li> 
              <li>Do formuláře "Intro článku" napište 2–3 věty, které jasně uvedou, o čem je tento článek.</li>
            </ul>
        </div>

        <div class="alert alert-warning" role="alert">
            <ul>POZOR!!!
              <li>"Název článku" nesmí mít méně než 3 písmena!</li>
              <li>"Intro článku" nesmí mít méně než 15 písmen!</li>
              <li>"Text článku" nesmí mít méně než 20 písmen! </li>
            </ul>
        </div>
      </div>

      <?php require 'blocks/aside.php'; ?>
    </div>
  </main>

  <?php require 'blocks/footer.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>
    $('#article_send').click(function () {
      var title = $('#title').val();
      var intro = $('#intro').val();
      var text = $('#text').val();

      $.ajax({
        url: 'ajax/add_article.php',
        type: 'POST',
        cache: false,
        data: {'title' : title, 'intro' : intro, 'text' : text},
        dataType: 'html',
        success: function(data) {
          if(data == 'Hotovo') {
            $('#article_send').text('Vše je připraveno');
            $('#errorBlock').hide();
            setTimeout(function(){ 
              window.location.href = "http://wa.toad.cz/~iastrnik/index.php";
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
