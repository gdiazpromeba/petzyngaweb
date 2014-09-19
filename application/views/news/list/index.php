<div class="centroNews">

    <!-- peque�o form y javascript para invocar la pantalla de detalle con un par�metro "start" como post -->
    <form name="frmNavegacion" action="" method="post">
      <input type="hidden" name="start" value="<?php echo $_REQUEST['start']; ?>" />
    </form>
    <script type="text/javascript">
      function navega(url){
        document.frmNavegacion.action=url;
        document.frmNavegacion.submit();
      }
    </script>


<?php foreach ($news as $bean) { ?>
    
    <div class="newsContainer">
      <div class="newsTitle">
        <?php
          echo "<a href='#' onclick=navega('" .  URL ."latestnews/info/" . $bean->getUrlEncoded() .  "')>" . $bean->getNewsTitle() . "</a> \n";
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
         <div class="newsSource" style="display: inline">
           <?php
            echo "<a href='#' onclick=navega('" .  URL . "latestnews/info/" . $bean->getUrlEncoded() .  "')>Read more ...</a> \n";
           ?>
         </div><!-- el read more -->      
      </div><!-- newsContent -->
    </div><!-- newsContainer -->
    
  <?php } ?>    
  
    <span class="navegacionPaginas">
      <?php 
        if ($_REQUEST['hayAnterior']){
          echo "  <a href='#' onclick=navega('" . URL . "latestnews/listing/previous')> << Previous </a> &nbsp;&nbsp;\n";
        }
        
        if ($_REQUEST['haySiguiente']){
          echo "  <a href='#' onclick=navega('" . URL . "latestnews/listing/next')>  Next >> </a> \n";
        }
        
      ?>
    </span> 

</div>   