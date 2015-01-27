    <!-- pequeño form y javascript para invocar la pantalla de detalle con un parámetro "start" como post -->
    <form name="frmNavegacion" action="" method="post">
      <input type="hidden" name="start" value="<?php echo $_REQUEST['start']; ?>" />
    </form>
    <script type="text/javascript">
      function navega(url){
        document.frmNavegacion.action=url;
        document.frmNavegacion.submit();
      }

      function navegaSigAnt(url, sentido){
    	  var inp = document.createElement("input");
    	  inp.setAttribute("type", "hidden");
    	  inp.setAttribute("name", "navegacion");
    	  inp.setAttribute("value", sentido);
          document.frmNavegacion.appendChild(inp);
          document.frmNavegacion.action=url;
          document.frmNavegacion.submit();
      }      
    </script>

<div style="display:flex;justify-content:center">
    
      <div  class="columnLeft">
         <div class="stickitColumna"><?php echo Resources::getText('breeders_directory'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('puppy_mills_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('shelters_directory'); ?></div>
       </div>
       <div  class="columnRight">
         <div class="stickitColumna"><?php echo Resources::getText('videos_of_the_week'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('blue_cross_uk'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('tica'); ?></div>
       </div>
       
       <div id="columnCenter"  class="columnCenter">

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
			          echo "  <a href='#' onclick=\"navegaSigAnt('" . URL . "latestnews/listing', 'anterior')\"> << Previous </a> &nbsp;&nbsp;\n";
			        }
			        
			        if ($_REQUEST['haySiguiente']){
			          echo "  <a href='#' onclick=\"navegaSigAnt('" . URL . "latestnews/listing', 'siguiente')\">  Next >> </a> \n";
			        }
			        
			      ?>
			    </span> 			  
			   
	  </div>
  

     

</div>   