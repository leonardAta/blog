<?php

  #insert page title
  $page_title = "Daily Learner: Archives";

  #include database
  include 'includes/db.php';

  #include header
  include 'includes/blogheader.php';

  #include functions
  include 'includes/functions.php';

  #include navigation bar
  include 'includes/nav.php';

  if(isset($_GET['date_added'])) {
  	$dateID = $_GET['date_added'];

  }

  

/*  getArchive($conn, function($conn, $stmt) {

              while($row=$stmt->fetch(PDO::FETCH_BOTH)) {
                echo '<ol class="list-unstyled">';
                echo '<li><a href="archive.php">'.$row["my"].'</a></li>';                
                echo '</ol>';
              }

            }); 

 # getPostByDate($conn, $dateID);
 */
?>
<body>
<div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">

           <div class="blog-header">
      <div class="container">
        <h1 class="blog-title">Archives</h1>
        <p class="lead blog-description">A daily journal of a life-long learner and lover of life</p>
      </div>
    </div>

    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">
<?php

      getArchive($conn, function($conn, $stmt) {

              while($row=$stmt->fetch(PDO::FETCH_BOTH)) {
                echo '<ol class="list-unstyled">';
                echo '<li><a href="archive.php"?>'.$row["my"].'</a></li>';                
                echo '</ol>';
              }

            }); 


?>

        <?php
        
            getPostByDate($conn, function($conn, $stmt) {

                while($row=$stmt->fetch(PDO::FETCH_BOTH)) {
                  $admin = getAdminByID($conn, $row['admin_id']);
                  echo '<div class="blog-post">';
                  echo '<h2 class="blog-post-title">'.$row[2].'</h2>';
                  echo '<p class="blog-post-meta">'.$row["arch_date"].' by <a href="#">'.$admin["firstname"].'</a></p>';
                  echo $row['content'];
                  echo '</div>';


                }



            });





        ?>
          


    </div> <!-- /.row -->

</div> <!-- /.container -->  
</body>
<?php
    
      #include footer
      include 'includes/blogfooter.php';
?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.2.1.min.js"> </script>
    
    <script src="js/bootstrap.min.js"></script>


