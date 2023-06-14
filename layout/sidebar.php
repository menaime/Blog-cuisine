<div class="col-md-4">
  <?php 
    // Vérifie si l'utilisateur est connecté ou non
    if (!isset($_SESSION['type'])) {
  ?>
  <!-- Formulaire de connexion -->
  <div class="login-form">
    <div class="or-seperator"><i>Connection</i></div>
    <form action="layout/login.php" method="post">
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user"></i> </span>
          <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required="required">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-lock"></i> </span>
          <input type="password" class="form-control" name="password" placeholder="Mot de Pass" required="required">
        </div>
      </div>        
      <div class="form-group">
        <button type="submit" name="login" class="btn btn-success btn-block login-btn">Sign in</button>
      </div>
      <div class="clearfix">
        <label class="pull-left checkbox-inline"><input type="checkbox"> Souvient tou de moi</label>
        <br>
        <a href="#" class="pull-right text-success">Mot de passe oublier?</a>
      </div>  
    </form>
    <div class="hint-text small">Vous n'avez pas de compte? <a href="#" class="text-success">Enregistrez-vous!</a></div>
  </div>
  <?php 
    } else {
      // L'utilisateur est connecté, affiche les informations du compte
      $success_login_id = $_SESSION['id'];
      $success_login_name_admin = $_SESSION['name'];
      $success_login_username_admin = $_SESSION['username'];
      $success_login_email_admin = $_SESSION['email'];
      $success_login_type_password_admin = $_SESSION['password'];
      $success_login_gender_admin = $_SESSION['gender'];
      $success_login_image_admin = $_SESSION['image'];
      $success_login_code_admin = $_SESSION['code'];
      $success_login_status_admin = $_SESSION['status'];
      $success_login_type_admin = $_SESSION['type'];
  ?>
  <!-- Affiche les informations de l'utilisateur -->
  <div class="card my-4">
    <div class="card-header">
      <p align="center"><img class="zoom3" src="admin/images/users/<?php echo $success_login_image_admin; ?>" width="110"></p>
      <p align="center"><b>Bienvenu <?php echo $success_login_name_admin; ?></b></p>
    </div>
    <div class="card-header">
      <!-- Options de l'utilisateur -->
      <p align="center">
        <?php 
          if ($_SESSION['type'] =='1') {
        ?>
        <a href="admin/" class="btn btn-default btn-flat" target="_blank">Administration</a>
        <?php
          } else {
        ?>
        <a href="profil.php/" class="btn btn-default btn-flat">Profil</a>
        <?php } ?>
        <a href="layout/logout.php" class="btn btn-default btn-flat">Déconnection</a>
      </p>
    </div>
  </div>
  <?php 
    }
  ?>

  <!-- Widget de recherche -->
  <div class="card my-4">
    <h5 class="card-header">Recherche</h5>
    <div class="card-body">
      <form action="search.php" method="post">
        <div class="input-group">
          <input type="text" class="form-control" name="search_text" placeholder="mots clef....">
          <span class="input-group-btn">
            <button class="btn btn-secondary" name="search" type="submit">Go!</button>
          </span>
        </div>
      </form>
    </div>
  </div>

  <!-- Widget des catégories -->
  <div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6">
          <ul class="list-unstyled mb-0">
            <?php 
              // Sélectionne toutes les catégories
              $sql_select_category_wiget = "SELECT * FROM categories";
              $result_sql_select_category_wiget = mysqli_query($dbconnection, $sql_select_category_wiget);

              $category_counter = 0;
              while ($rowcategory_wiget = mysqli_fetch_assoc($result_sql_select_category_wiget)) {
                $category_counter++;
                $id_category_wiget = $rowcategory_wiget['id'];
                $title_category_wiget = $rowcategory_wiget['cat_title'];
            ?>
            <li>
              <a href="category.php?catid=<?=$id_category_wiget; ?>">
                <?php 
                  // Affiche les titres des catégories en alternance
                  if ($category_counter % 2 != 0) {
                    echo $title_category_wiget;
                  }
                ?>
              </a>
            </li>
            <?php 
              }
            ?>
          </ul>
        </div>
        <div class="col-lg-6">
          <ul class="list-unstyled mb-0">
            <?php 
              // Sélectionne toutes les catégories
              $sql_select_category_wiget1 = "SELECT * FROM categories";
              $result_sql_select_category_wiget1 = mysqli_query($dbconnection, $sql_select_category_wiget1);

              $category_counter1 = 0;
              while ($rowcategory_wiget1 = mysqli_fetch_assoc($result_sql_select_category_wiget1)) {
                $category_counter1++;
                $id_category_wiget1 = $rowcategory_wiget1['id'];
                $title_category_wiget1 = $rowcategory_wiget1['cat_title'];
            ?>
            <li>
              <a href="category.php?catid=<?=$id_category_wiget1; ?>">
                <?php 
                  // Affiche les titres des catégories en alternance
                  if ($category_counter1 % 2 == 0) {
                    echo $title_category_wiget1;
                  }
                ?>
              </a>
            </li>
            <?php 
              }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Widget des articles populaires -->
  <div class="card my-4">
    <h5 class="card-header">Popular posts</h5>
    <?php 
      $counter_popular = 0;
      // Sélectionne les articles les plus populaires
      $sql_select_post_popular = "SELECT * FROM posts WHERE post_status = 1 ORDER BY post_visit_counter DESC LIMIT 0,5";
      $result_sql_select_post_popular = mysqli_query($dbconnection, $sql_select_post_popular);
      while ($rowpost_popular = mysqli_fetch_assoc($result_sql_select_post_popular)) {
        $view_post_id_popular = $rowpost_popular['id'];
        $view_post_category_popular = $rowpost_popular['post_category'];
        $view_post_title_popular = $rowpost_popular['post_title'];
        $view_post_autor_popular = $rowpost_popular['post_autor'];
        $view_post_date_popular = $rowpost_popular['post_date'];
        $view_post_edit_date_popular = $rowpost_popular['post_edit_date'];
        $view_post_image_popular = $rowpost_popular['post_image'];
        $view_post_text_popular = $rowpost_popular['post_text'];
        $view_post_tag_popular = $rowpost_popular['post_tag'];
        $view_post_visit_counter_popular = $rowpost_popular['post_visit_counter'];
        $view_post_status_popular = $rowpost_popular['post_status'];
        $view_post_priority_popular = $rowpost_popular['post_priority'];
                 
        $counter_popular++;
    ?>
    <div class="card-body">
      <img class="card-img-top" src="admin/images/blog/<?php echo $view_post_image_popular;?>" alt="<?php echo $view_post_image_popular;?>">
      <b>
        <a href="post.php?postid=<?=$view_post_id_popular ?>" style="color: #cc0000"><?php echo $view_post_title_popular; ?></a>
      </b>
    </div>
    <?php } ?>
  </div>
</div>
