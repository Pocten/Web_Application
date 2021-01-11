<!DOCTYPE html>
<html lang="cs">
<head>
  <?php
    $website_title = 'Alkaš';
    require 'blocks/head.php';
  ?>
</head>
<body>
  <?php require 'blocks/header.php'; ?>

  <main class="container mt-5">
    <div class="row">
      <div class="col-md-8 mb-3">
        <?php
          require_once 'mysql_connect.php';

        if (isset($_GET['page'])) {   // check if isset get parametr and write it to page veriable  
            $page = (int) $_GET['page']; // change type to int 
        } 
        else {
            $page = 0; // set 1 as default 
        }
        
        $limit = 4;
        $start = $limit * $page;
        
          $sql = "SELECT * FROM `articles` ORDER BY `date` DESC LIMIT $start, $limit";
          $query = $pdo->query($sql);
          while($row = $query->fetch(PDO::FETCH_OBJ)) {
            echo "<h2>$row->title</h2>
              <p>$row->intro</p>
              <p><b>Autor článku:</b> <mark>$row->avtor</mark></p>
              <a href='news.php?id=$row->id' title='$row->title'>
                <button class='btn btn-warning mb-5'>Číst víc</button>
              </a>";
          }
          
        
          $count_query = $pdo->query("SELECT COUNT(*) FROM `articles`");
          $count_array = $count_query->fetch(PDO::FETCH_NUM);
          $count = $count_array[0];
          $pagesCount = $count/$limit;
          ?>
          
        <ul class="pagination justify-content-center">

          <?php for($p = 0; $p <= $pagesCount; $p++) { ?>
            <li class="page-item"><a href="index.php?page=<?php echo $p;?>" class="page-link"><?php echo $p+1 ?></a></li>
          <?php } ?>
          
        </ul>

          
          
          
        
          

      </div>

      <?php require 'blocks/aside.php'; ?>
    </div>
  </main>


<!-- echo '<a href="index.php?page='.$p.'">'.($p + 1).'</a>'; -->
  <?php require 'blocks/footer.php'; ?>
</body>
</html>

