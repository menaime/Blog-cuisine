# Page d'accueil du blog culinaire

La page `index.php` est la page d'accueil du blog culinaire. Elle affiche une liste des articles les plus récents et permet aux utilisateurs de naviguer entre les différentes pages d'articles.

## Inclusion des fichiers nécessaires

La page commence par inclure le fichier de connexion à la base de données (`db_connection.php`) et les fichiers de mise en page (`head.php`, `topnavigation.php`, `sidebar.php`, `footer.php`). Ces fichiers contiennent des parties réutilisables du code.

## Contenu de la page

La page est divisée en deux parties : les colonnes des articles de blog et la colonne de la barre latérale.

### Colonnes des articles de blog

La colonne des articles de blog (`.col-md-8`) affiche les articles les plus récents. Le nombre d'articles affichés par page est défini par la variable `$no_posts_per_page`.

Une boucle `while` est utilisée pour récupérer les articles de la base de données en fonction de leur statut (`post_status`) et les afficher sous forme de cartes (`card`). Chaque carte contient le titre de l'article, une image, un extrait et un lien vers l'article complet. Les informations sur l'auteur de chaque article sont également affichées, y compris son nom, son image et la date de publication de l'article.

La pagination est également gérée pour permettre à l'utilisateur de naviguer entre les différentes pages d'articles.

### Colonnes de la barre latérale

La colonne de la barre latérale (`sidebar.php`) contient des widgets supplémentaires tels que des catégories, des tags, des articles populaires, etc. Ces widgets fournissent une navigation et un accès rapide à d'autres sections du blog.

## Pied de page

Le pied de page (`footer.php`) est inclus à la fin de la page et contient les informations de copyright ou d'autres éléments communs à toutes les pages.

## Scripts JavaScript

Enfin, les scripts JavaScript de Bootstrap sont inclus à la fin de la page pour ajouter des fonctionnalités interactives au blog.

Ceci est une explication générale de la structure et du contenu de la page `index.php` du blog culinaire.
