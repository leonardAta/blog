<div class="col-sm-3 offset-sm-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>

            <?php

            getArchive($conn, function($conn, $stmt) {

              while($row=$stmt->fetch(PDO::FETCH_BOTH)) {
                echo '<ol class="list-unstyled">';
                echo '<li><a href="archive.php">'.$row["my"].'</a></li>';
                echo '</ol>';
              }

            }); {


            }

            ?>

          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="https://github.com/leonardAta">GitHub</a></li>
              <li><a href="https://twitter.com/jay2dtee">Twitter</a></li>
              <li><a href="https://facebook.com/leonard.ata">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

