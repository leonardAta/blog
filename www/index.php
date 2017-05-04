<?php

  #insert page title
  $page_title = "Daily Learner: Home";

  #include database
  include 'includes/db.php';

  #include header
  include 'includes/blogheader.php';

  #include functions
  include 'includes/functions.php';

  #include navigation bar
  include 'includes/nav.php';

?>

  <body>  

    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">

           <div class="blog-header">
      <div class="container">
        <h1 class="blog-title">The Daily Learner Blog</h1>
        <p class="lead blog-description">A daily journal of a life-long learner and lover of life</p>
      </div>
    </div>

    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">


          <?php 

              fetchPost($conn, function($conn, $stmt) {

                  while ($row = $stmt->fetch (PDO::FETCH_BOTH)) {
                    $admin = getAdminByID($conn, $row['admin_id']);
                    echo '<div class="blog-post">';
                    echo '<h2 class="blog-post-title">'.$row['title'].'</h2>';
                    echo '<p class="blog-post-meta">'.$row["dd"].' by <a href="#">'.$admin["firstname"].'</a></p>';
                    echo $row['content'];
                    echo '</div>';


                  }
              });

          ?>

          <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
          </nav>

        </div><!-- /.blog-main -->

        <?php

          #include sidebar
          include 'sidebar.php';

        ?>
        
    </div><!-- /.row -->

  </div><!-- /.container -->      

<?php
    
      #include footer
      include 'includes/blogfooter.php';
?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.2.1.min.js"> </script>
    
    <script src="js/bootstrap.min.js"></script>
    
  </body>