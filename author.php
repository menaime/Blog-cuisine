<?php
  include "admin/db_connection.php";
?>

<!DOCTYPE html>
<html lang="fr">

<?php include "layout/head.php"; ?>

<body>

  <!-- Navigation -->
  <?php include "layout/topnavigation.php"; ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Colonne des articles de blog -->
      <div class="col-md-8">
        <?php
        if (isset($_GET['auth'])) {
          // Récupérer l'ID de l'auteur sélectionné depuis l'URL
          $selected_auth_id = $_GET['auth'];

          // Récupérer les détails de l'auteur depuis la base de données
          $sql_select_auth_posts = "SELECT * FROM users WHERE id = {$selected_auth_id}";
          $result_sql_select_auth_post = mysqli_query($dbconnection, $sql_select_auth_posts);

          while ($row_auth_post = mysqli_fetch_assoc($result_sql_select_auth_post)) {
            $view_user_id = $row_auth_post['id'];
            $view_user_name = $row_auth_post['name'];
            $view_user_image = $row_auth_post['image'];
          }
        }
        ?>

        <br>
        <!-- Détails de l'auteur -->
        <div class="card-footer text-muted">
          <img src="admin/images/users/<?php echo $view_user_image; ?>" class="zoom3" alt="Image de l'utilisateur" width="50" align="left" hspace="5">
          <h3><?php echo $view_user_name; ?></h3>
          Développeur web <a href="#">VirtuaPHP</a><br>
          <a href=""><i class="fas fa-envelope"></i></a>&nbsp;&nbsp;<a href=""><i class="fab fa-facebook"></i></a>
        </div>
        <div class="card-footer text-muted">En tant qu'étudiant, ma passion pour le front-end brille comme un éclatant rayon de soleil dans mon parcours académique, car je suis captivé par l'art de donner vie à des interfaces interactives, en harmonisant esthétisme et fonctionnalité.</div>

        <h3 class="my-4">Les derniers articles de <?php echo $view_user_name; ?>
          <!-- <small>Secondary Text</small>-->
        </h1>
        <?php
        // Récupérer les articles de blog de l'auteur sélectionné depuis la base de données
        $sql_select_post_auth = "SELECT * FROM posts WHERE post_status = 1 AND post_autor = {$selected_auth_id} ORDER BY id DESC";
        $result_sql_select_post_auth = mysqli_query($dbconnection, $sql_select_post_auth);
        $post_counter_for_category = 0;

        while ($rowpost = mysqli_fetch_assoc($result_sql_select_post_auth)) {
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
            <img class="card-img-top" src="admin/images/blog/<?php echo $view_post_image; ?>" alt="Image de l'article">
            <div class="card-body">
              <h2 class="card-title"><?php echo $view_post_title; ?></h2>
              <p class="card-text">
                <?php
                // Afficher un extrait du texte de l'article
                echo substr($view_post_text, 0, 400) . "...";
                ?>
              </p>
              <a href="#" class="btn btn-primary">Lire la suite &rarr;</a>
            </div>
          </div>
        <?php
        }

        if ($post_counter_for_category == 0) {
          echo "<h1>Désolé. Aucun article de cet utilisateur !</h1>";
        }
        ?>

        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
          <li class="page-item">
            <a class="page-link" href="#">&larr; Plus ancien</a>
          </li>
          <li class="page-item disabled">
            <a class="page-link" href="#">Plus récent &rarr;</a>
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

  <!-- Scripts JavaScript de Bootstrap -->
  <script src="blog-template/vendor/jquery/jquery.min.js"></script>
  <script src="blog-template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
