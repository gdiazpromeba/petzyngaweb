<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';
  require_once 'configJs.php';
?>

<div class="rightDogBreeds">
    <!-- pequeño form y javascript para invocar la pantalla de detalle con un parámetro "start" como post -->
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
        $(".pictureContainer").click(function(){
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
	<?php include 'formBusqueda.php'?>


              <table class="picturesTable">
               <?php
                 $keys = array_keys($dogBreeds);
                 $index=0; 
                 for ($row=0; $row <5 && $index < count($keys) ; $row++){
                   echo "<tr> \n"; 
                   for ($col=0; $col<4 && $index < count($keys) ; $col++){
                      $bean=$dogBreeds[$keys[$index]];
                      
                      echo "<td class='tdPictureContainer'> \n";
                      echo "<div class='pictureContainer'> \n";
                      echo "      <div data-nombreCodificado='" .  $bean->getNameEncoded() . "'/>"; 
                      //echo "    <a href='javascript:void(0)' onclick=navega('" . URL . "dogbreeds/info/" .  $bean->getNameEncoded() . "')> \n";
                      echo "      <table class='pictureInternalTable'> \n";
                      echo "        <tr><td class='pictureTitle'>" . $bean->getNombre() . "</td></tr> \n";
                      echo "        <tr><td><img class='breedImage' src='" . $GLOBALS['dirAplicacion'] . "/resources/images/breeds/" . $dogBreeds[$keys[$index]]->getPictureUrl() . "' alt='" . $bean->getNombre() . "'></td></tr>";
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
          echo "  <a href='javascript:void(0)' onclick=\"navegaSigAnt('" . URL . "dogbreeds', 'anterior')\" > << Previous </a> &nbsp;&nbsp;\n";
        }
        
        if ($_REQUEST['haySiguiente']){
          echo "  <a href='javascript:void(0)' onclick=\"navegaSigAnt('" . URL . "dogbreeds', 'siguiente')\" >  Next >> </a> \n";
        }
        
      ?>
      <br/>
      <br/>
    </span>
</div>
