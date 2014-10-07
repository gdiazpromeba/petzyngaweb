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
      <input type="hidden" name="start" value="<?php echo RequestUtils::getValue('start'); ?>" />
    </form>
    <script type="text/javascript">
      function navega(url){
        document.frmNavegacion.action=url;
        document.frmNavegacion.submit();
      }
    </script>      
      
      
     
      
    </div><!-- newsContainer -->
    
    <!-- if "start" is empty, it means that we are coming from thr front page -->
    <?php
     $start=RequestUtils::getValue('start');
     if (empty($start)){?>
      <span class="navegacionPaginas">
	    <a href='#' onclick=navega('<?php echo URL ?>')> << Back to Home Page </a>
      </span>      
    <?php }else{ ?> 
      <span class="navegacionPaginas">
        <a href='#' onclick=navega('<?php echo URL ?>latestnews/listing/list')> << Back to List </a>
      </span>      
    <?php }?> 
    

