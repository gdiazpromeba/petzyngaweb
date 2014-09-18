    <div class="newsContainer">
      <div class="newsTitle">
        <?php
          echo $bean->getNewsTitle();
         ?>
      </div><!-- title -->
      <div class="newsSource">
        <?php
          echo $bean->getNewsSource();
         ?>
      </div><!-- Source -->
      <div class="newsContent">
        <?php
          echo $bean->getNewsText();
         ?>
      </div><!-- newsContent -->
      
    <!-- pequeño form y javascript para volver a la pantalla de lista con un parámetro "start" como post -->
    <form name="frmNavegacion" action=""" method="post">
      <input type="hidden" name="start" value=<?php echo $_REQUEST['start']; ?> />
    </form>
    <script type="text/javascript">
      function navega(url){
        document.frmNavegacion.action=url;
        document.frmNavegacion.submit();
      }
    </script>      
      
      
     
      
    </div><!-- newsContainer -->
    
    <span class="navegacionPaginas">
	      <?php 
	        echo "  <a href='#' onclick=navega('" . URL . "latestnews/listing')> << Back to List </a> \n";
	      ?>
    </span>      

