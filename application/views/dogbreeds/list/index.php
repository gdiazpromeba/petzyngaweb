<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';
  require_once 'configJs.php';
?>

<div style="display:flex;justify-content:center">
    <!-- peque�o form y javascript para invocar la pantalla de detalle con un par�metro "start" como post -->
    <form name="frmNavegacion" method="post" >
      <input type="hidden" name="start" value="<?php echo RequestUtils::getValue('start'); ?>" />
      <input type="hidden" name="letraInicial" value="<?php echo RequestUtils::getValue('letraInicial'); ?>" />      
      <input type="hidden" name="nombreOParte" value="<?php echo RequestUtils::getValue('nombreOParte'); ?>" />
      <input type="hidden" name="selDogSize" value="<?php echo RequestUtils::getValue('selDogSize'); ?>" />
      <input type="hidden" name="selDogFeeding" value="<?php echo RequestUtils::getValue('selDogFeeding'); ?>" />
      <input type="hidden" name="selUpkeep" value="<?php echo RequestUtils::getValue('selUpkeep'); ?>" />
    </form>
    
    <script type="text/javascript">
      var ultimoNombreCodificado;
    
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

      $(document).ready(function(){
        $(".pictureContainerAlpha").click(function(){
            var imageSource=$(this).find("img").attr("src");
            ultimoNombreCodificado = $(this).find("div").attr("data-nombreCodificado");
        	$("#ventanita #ventanitaImg").attr("src", imageSource);
        	var dataString = 'nombreCodificado='+ ultimoNombreCodificado;
        	var url= Global.dirCms + '/svc/conector/dogBreeds.php/obtienePorNombreCodificado';
            $.ajax({
            	  type: "POST", 
                  url: url, 
                  data: dataString,
                  success: function(data){
                	  var obj = jQuery.parseJSON( data );
                      $("#derechaTitulo").html(obj.dogBreedName);
                      $("#friendlyRank").attr("src", Global.dirCms  + "/resources/images/estrellas_"  + obj.friendlyRank + '.jpg');
                      $("#activeRank").attr("src", Global.dirCms  + "/resources/images/estrellas_"  + obj.activeRank + '.jpg');
                      $("#healthyRank").attr("src", Global.dirCms  + "/resources/images/estrellas_"  + obj.healthyRank + '.jpg');
                      $("#guardianRank").attr("src", Global.dirCms  + "/resources/images/estrellas_"  + obj.guardianRank + '.jpg');
                      $("#groomingRank").attr("src", Global.dirCms  + "/resources/images/estrellas_"  + obj.groomingRank + '.jpg');
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert( " Status: " + textStatus); alert("Error: " + errorThrown); 
                  }
             });
             $("#ventanita").fadeIn(600);
            
         });    
        $("#cierraVentanita").click(function(){
        	$("#ventanita").fadeOut();
        });
        $("#moreDetails").click(function(){
            var url='<?php echo URL .  "dogbreeds/info/";?>' + ultimoNombreCodificado;
            location.replace( url);
        });        
      });
      
      
    </script>    

 

       <div id="columLeft" class="columnLeft">
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_02'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_03'); ?></div>
       </div>
       <div id="columLeft" class="columnRight">
         <div class="stickitColumna"><?php echo Resources::getText('col_der_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_der_02'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_der_03'); ?></div>
       </div>
       
       <div id="columnCenter"  class="columnCenter">
         <?php include 'formBusqueda.php'?>
         <br/>
         <div style='text-align:left;height:50px;padding-top:10px;margin-left:65px'>
           <a href='<?php  echo URL ?>dogbreeds/alphabeticalSearch' >Alphabetical Search</a>
         </div> 
         
         
         <table class="picturesTable">
           <?php
                 $cols=3;
                 $keys = array_keys($dogBreeds);
                 $index=0; 
                 for ($row=0; $row <5 && $index < count($keys) ; $row++){
                   echo "<tr> \n"; 
                   for ($col=0; $col<$cols && $index < count($keys) ; $col++){
                      $bean=$dogBreeds[$keys[$index]];
                      
                      echo "<td class='tdPictureContainer'> \n";
                      echo "<div class='pictureContainerAlpha'> \n";
                      echo "      <div data-nombreCodificado='" .  $bean->getNameEncoded() . "'/>"; 
                      //echo "    <a href='javascript:void(0)' onclick=navega('" . URL . "dogbreeds/info/" .  $bean->getNameEncoded() . "')> \n";
                      echo "      <table class='pictureInternalTable'> \n";
                      echo "        <tr><td class='pictureTitleAlpha'>" . $bean->getNombre() . "</td></tr> \n";
                      echo "        <tr><td><img class='breedImageAlpha' src='" . $GLOBALS['dirAplicacion'] . "/resources/images/breeds/" . $dogBreeds[$keys[$index]]->getPictureUrl() . "' alt='" . $bean->getNombre() . "'></td></tr>";
                      echo "      </table> \n";
                      //echo "    </a> \n";
                      echo "</div>";
                      echo "</td> \n";
                      
                      $index++;
                   }
                   echo "</tr> \n"; 
                 }
            ?>
         </table> 
         
         <div id="ventanita"  style="display: none; position:fixed;left:50%;top:50%;  zindex:9999; transform: translate(-50%, -50%); background-color:white; width:690px; padding: 20px; ">
                <img class='breedImage' id="ventanitaImg" style=" width:467px;height:350px;g;float:left" >
                <div id="derecha" style="width:200px;float:right;">
                  <div id="derechaTitulo" class='pictureTitle' style="margin-bottom: 20px"></div>
                  <div class="winRankLine">
                    <span class="winRankText">Friendly</span>
                    <img id="friendlyRank" class="winRankImg" src="" />
                  </div> 
                  <div class="winRankLine">
                    <span class="winRankText" >Active</span>
                    <img id="activeRank" class="winRankImg" src="" />
                  </div>                  
                  <div class="winRankLine">
                    <span class="winRankText" >Healthy</span>
                    <img id="healthyRank" class="winRankImg" src="" />
                  </div>
                  <div class="winRankLine">
                    <span class="winRankText" >Guardian</span>
                    <img id="guardianRank" class="winRankImg" src="" />
                  </div>
                  <div class="winRankLine">
                    <span class="winRankText" >Grooming</span>
                    <img id="groomingRank" class="winRankImg" src="" />
                  </div>
                  <br/>  
                </div>
                <div >
                  <div class="winRankButton"  id="cierraVentanita"  style="position:absolute;top:320px;right:130px;padding-top:10px;width:50px" >Close</div>       
                  <div id="moreDetails" class="winRankButton"  style="position:absolute;top:320px;right:20px;padding-top:10px;width:80px">More Details</div>
                </div>                 
         </div>   
         
         <span class="navegacionPaginas">
           <?php 
             if ($_REQUEST['hayAnterior']){
               echo "  <a href='javascript:void(0)' onclick=\"navegaSigAnt('" . URL . "dogbreeds/advancedSearch', 'anterior')\" > << Previous </a> &nbsp;&nbsp;\n";
             }
        
             if ($_REQUEST['haySiguiente']){
               echo "  <a href='javascript:void(0)' onclick=\"navegaSigAnt('" . URL . "dogbreeds/advancedSearch', 'siguiente')\" >  Next >> </a> \n";
             }
        
           ?>
           <br/>
           <br/>
         </span>         
                       
       </div><!-- del central -->
              

</div>
