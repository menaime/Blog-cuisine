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

      <!-- Colonne des articles de blog -->
      <div class="col-md-8">
        <?php 
        if (isset($_GET['catid'])) 
        {
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

          // Récupérer l'identifiant de la catégorie sélectionnée
          $selected_category_page= $_GET['catid'];
          $sql_select_category_page = "SELECT * FROM categories WHERE id = {$selected_category_page}";
          $result_sql_select_category_page = mysqli_query($dbconnection, $sql_select_category_page);
          while ($rowcategorypage = mysqli_fetch_assoc($result_sql_select_category_page))
          {
            $view_category_id = $rowcategorypage['id'];
            $view_cat_title = $rowcategorypage['cat_title'];
          }
        }
         ?>

        <h1 class="my-4"><?php echo $view_cat_title; ?></h1>
        <?php 
          // Récupérer les articles de la catégorie sélectionnée
          $sql_select_post = "SELECT * FROM posts WHERE post_status = 1 AND post_category = {$selected_category_page} ORDER BY id desc LIMIT {$start} ,{$no_posts_per_page}";
          $result_sql_select_post = mysqli_query($dbconnection, $sql_select_post);
          $post_counter_for_category = 0;
          while ($rowpost = mysqli_fetch_assoc($result_sql_select_post))
          {
            $post_counter_for_category++;
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
              <img class="card-img-top" src="admin/images/blog/<?php  echo $view_post_image; ?>" alt="Card image cap">
              <div class="card-body">
                <h2 class="card-title"><?php echo $view_post_title; ?></h2>
                <p class="card-text">
                  <?php echo substr($view_post_text, 0, 400) . "...";?>
                </p>
                <a href="#" class="btn btn-primary">Lire la suite &rarr;</a>
              </div>
              <?php 
                // Récupérer les informations sur l'auteur de l'article
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
                <img src="admin/images/users/<?php echo $view_users_image; ?>" class="zoom3" alt="User Image" width="50" align="left" hspace="5">
                Par <a href="#"><?php echo $view_users_name; ?></a> <br>Bloggeur <a href="#">CuisinePHP</a>
                | <?php echo $view_post_date; ?>
              </div>
            </div>
          <?php
          }

          if ($post_counter_for_category==0) {
            echo "<h1>Désolé. Aucun article dans cette catégorie !</h1>";
          }
        ?>

        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
          <li class="page-item">
            <?php 
              // Gestion de la page précédente
              $select_post_query = "SELECT * FROM posts WHERE post_status = 1 AND post_category = {$selected_category_page}";
              $result_select_post_query = mysqli_query ($dbconnection, $select_post_query);
              $sum_posts = mysqli_num_rows($result_select_post_query) ;
                  
              $allpages = ceil($sum_posts / $no_posts_per_page);
                  
              if($page > 1)
              {
                $previous= $page - 1;
              ?>
              <a class="page-link" href="category.php?catid=<?= $view_category_id; ?>&page=<?php echo $previous ?>">&larr; Précédent</a>
            <?php } ?>
          </li>
          <li class="page-item">
            <?php 
              // Gestion de la page suivante
              if ($page < $allpages)
              {
                $next= $page + 1;
            ?>
            <a class="page-link" href="category.php?catid=<?= $view_category_id; ?>&page=<?php echo $next ?>">Suivant &rarr;</a>
            <?php } ?>
          </li>
        </ul>

      </div>

      <!-- Colonne des widgets de la barre latérale -->
      <?php include "layout/sidebar.php"; ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Pied de page -->
  <?php include "layout/footer.php"; ?>

  <!-- JavaScript de base de Bootstrap -->
  <script src="blog-template/vendor/jquery/jquery.min.js"></script>
  <script src="blog-template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
