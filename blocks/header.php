<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Alkaš</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="index.php">Hlavní stranka</a>
    <a class="p-2 text-dark" href="contacts.php">Kontakt</a>
    <?php
      if (isset($_COOKIE["login"]))
        echo '<a class="p-2 text-dark" href="article.php">Přidat článek</a>';
    ?>
  </nav>
  <?php
    if (!isset($_COOKIE["login"])):
  ?>
  <a class="btn btn-outline-primary mr-2 mb-2" href="auth.php">Přihlaste se</a>
  <a class="btn btn-outline-primary mb-2" href="reg.php">Registrace</a>
  <?php
    else:
  ?>
  <a class="btn btn-outline-primary mb-2" href="auth.php">Uživatelský účet</a>
  <?php
    endif;
  ?>
</div>
