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
                    echo '<p class="blog-post-meta">'.$row["dd"].' by<a href="#">'.$admin["firstname"].'</a></p>';
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

        <div class="col-sm-3 offset-sm-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
              <li><a href="#">February 2014</a></li>
              <li><a href="#">January 2014</a></li>
              <li><a href="#">December 2013</a></li>
              <li><a href="#">November 2013</a></li>
              <li><a href="#">October 2013</a></li>
              <li><a href="#">September 2013</a></li>
              <li><a href="#">August 2013</a></li>
              <li><a href="#">July 2013</a></li>
              <li><a href="#">June 2013</a></li>
              <li><a href="#">May 2013</a></li>
              <li><a href="#">April 2013</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

 <?php

    #include footer
    include 'includes/footer.php';

 ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.2.1.min.js"></script>
   
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   
  </body>
</html>
