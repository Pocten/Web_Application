<?php
  require_once 'mysql_connect.php';

  if (isset($_POST['username']) && isset($_POST['mess'])) {
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));

    $sql = 'INSERT INTO comments(name, mess, article_id) VALUES(?, ?, ?)';
    $query = $pdo->prepare($sql);
    $query->execute([$username, $mess, $_GET['id']]);
    header("Location: http://wa.toad.cz/~iastrnik/news.php?id={$_GET['id']}");
    exit();
  }

?>

<!DOCTYPE html>
<html lang="cs">
<head>
  <?php
    $sql = 'SELECT * FROM `articles` WHERE `id` = :id';
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $_GET['id']]);

    $article = $query->fetch(PDO::FETCH_OBJ);

    $website_title = $article->title;
    require 'blocks/head.php';
  ?>
</head>
<body>
  <?php require 'blocks/header.php'; ?>

  <main class="container mt-5">
    <div class="row">
      <div class="col-md-8 mb-3">
        <div class="jumbotron">
          <h1><?=$article->title?></h1>
          <p><b>Autor článku:</b> <mark><?=$article->avtor?></mark></p>
          <?php
            $date = date('d ', $article->date);
            $array = ["Ledna", "Února", "Března", "Dubna", "Května", "Června", "Července", "Srpna", "Září", "října", "Listopadu", "Prosince"];
            $date .= $array[date('n', $article->date) - 1];
            $date .= date(' H:i', $article->date);
          ?>
          <p><b>Čas publikace:</b> <u><?=$date?></u></p>
          <p>
            <?=$article->intro?>
            <br><br>
            <?=$article->text?>
          </p>
        </div>

        <?php
          if (isset($_COOKIE["login"])):
        ?>

        <h3 class="mt-5">Komentáře</h3>
        <form action="news.php?id=<?=$_GET['id']?>" method="post">
          <label for="username">Váše jmeno:</label>
          <input type="text" name="username" value="<?=$_COOKIE['login']?>" id="username" class="form-control">

          <label for="mess">Zpráva:</label>
          <textarea name="mess" id="mess" class="form-control"></textarea>

          <button type="submit" id="mess_send" class="btn btn-success mt-3 mb-5">
            Přidat komentář
          </button>
        </form>

        <?php
          else:
        ?>

        <div class="alert alert-danger mb-5" role="alert">
          <p>Pokud chcete psát komentáře - <a href="reg.php">zaregistrujte se</a></p>
        </div>

        <?php endif; ?>


        <?php


          $sql = 'SELECT * FROM `comments` WHERE `article_id` = :id ORDER BY `id` DESC';
          $query = $pdo->prepare($sql);
          $query->execute(['id' => $_GET['id']]);
          $comments = $query->fetchAll(PDO::FETCH_OBJ);

          

          foreach ($comments as $comment) {
            echo "<div class='alert alert-info mb-2'>
              <h4>$comment->name</h4>
              <p>$comment->mess</p>
            </div>";
          }
        ?>
      </div>

      <?php require 'blocks/aside.php'; ?>
    </div>
  </main>

  <?php require 'blocks/footer.php'; ?>

<script>
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>

</body>
</html>
