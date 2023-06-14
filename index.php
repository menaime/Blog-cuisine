<?php
  include "admin/db_connection.php";
?>

<!DOCTYPE html>
<html lang="fr">

<?php include "layout/head.php"; ?>

<body>

  <!-- Navigation -->
  <?php include "layout/topnavigation.php"; ?>

  <!-- Contenu de la page -->
  <div class="container">

    <div class="row">

      <!-- Colonnes des articles de blog -->
      <div class="col-md-8">

        <h1 class="my-4">Blog culinaire
          <small>Les meilleures recettes</small>
        </h1>

        <?php 
          $no_posts_per_page = 5;
          if (isset($_GET['page']))
          {
            $page = $_GET['page'];
          }
          else
          {
            $page = 1;
          }
          $start = $no_posts_per_page * $page - $no_posts_per_page;
          $sql_select_post = "SELECT * FROM posts WHERE post_status = 1 ORDER BY id desc LIMIT {$start} ,{$no_posts_per_page} ";
          $result_sql_select_post = mysqli_query($dbconnection, $sql_select_post);
          while ($rowpost = mysqli_fetch_assoc($result_sql_select_post))
          {
            $view_post_id = $rowpost['id'];
            $view_post_category = $rowpost['post_category'];
            $view_post_title = $rowpost['post_title'];
            $view_post_autor = $rowpost['post_autor'];
            $view_post_date = $rowpost['post_date'];
            $view_post_edit_date = $rowpost['post_edit_date'];
            $view_post_image = $rowpost['post_image'];
            $view_post_text = $rowpost['post_text'];
            $view_post_tag = $rowpost['post_tag'];
            $view_post_visit_counter = $rowpost['post_visit_counter'];
            $view_post_status = $rowpost['post_status'];
            $view_post_priority = $rowpost['post_priority'];
        ?>

        <!-- Article de blog -->
        <div class="card mb-4">
          <img class="card-img-top" src="admin/images/blog/<?php  echo $view_post_image; ?>" alt="Image de l'article">
          <div class="card-body">
            <h2 class="card-title"><?php echo $view_post_title; ?></h2>
            <p class="card-text">
              <?php //echo $view_post_text; 
              echo substr($view_post_text, 0, 400) . "...";?>
            </p>
            <a href="post.php?postid=<?= $view_post_id; ?>" class="btn btn-primary">Lire plus &rarr;</a>
          </div>
          <?php 
            $sql_select_users_article = "SELECT * FROM users WHERE id={$view_post_autor}";
            $result_sql_select_users_article = mysqli_query($dbconnection, $sql_select_users_article);
            while ($rowusers_article = mysqli_fetch_assoc($result_sql_select_users_article))
            {
              $view_users_id = $rowusers_article['id'];
              $view_users_name = $rowusers_article['name'];
              $view_users_image = $rowusers_article['image'];
            } 
          ?>
          <div class="card-footer text-muted">
            <img src="admin/images/users/<?php echo $view_users_image; ?>" class="zoom3" alt="Image de l'utilisateur" width="50" align="left" hspace="5">
            Par <a href="author.php?auth=<?= $view_users_id; ?>"><?php echo $view_users_name; ?></a> <br>Développeur Web <a href="#">Blog cuisine</a>
            | <?php echo $view_post_date; ?>
          </div>
        </div>
      <?php } ?>


        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
          <li class="page-item">
            <?php 
              $select_post_query = "SELECT * FROM posts WHERE post_status = 1";
              $result_select_post_query = mysqli_query ($dbconnection, $select_post_query);
              $sum_posts = mysqli_num_rows($result_select_post_query) ;
              
              $allpages = ceil($sum_posts / $no_posts_per_page);
              
              if($page > 1)
              {
                $previous= $page - 1;
              ?>
            <a class="page-link" href="index.php?page=<?php echo $previous ?>">&larr; Retour</a>
            <?php } ?>
          </li>
          <li class="page-item">
            <?php 
              if ($page < $allpages)
              {
                $next= $page + 1;
              ?>
            <a class="page-link" href="index.php?page=<?php echo $next ?>">Suivant &rarr;</a>
            <?php } ?>
          </li>
        </ul>

      </div>

      <!-- Colonnes de la barre latérale -->
      <?php include "layout/sidebar.php"; ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Pied de page -->
  <?php include "layout/footer.php"; ?>


  <!-- Scripts JavaScript de Bootstrap -->
  <script src="blog-template/vendor/jquery/jquery.min.js"></script>
  <script src="blog-template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
