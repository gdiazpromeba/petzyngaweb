<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';
  require_once 'configJs.php';
?>

<div style="display:flex;justify-content:center">
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
    
      <div  class="columnLeft">
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_02'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_03'); ?></div>
       </div>
       <div  class="columnRight">
         <div class="stickitColumna"><?php echo Resources::getText('col_der_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_der_02'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_der_03'); ?></div>
       </div>

       <div id="columnCenter"  class="columnCenter">
         <div id="arrayLetrasTop" style="width:550px;margin-left:50px;display:table;">
           <div style='display:table-cell;width:120px;padding-right:10px'>
              <br/><a name='SelectInitial'>Select by letter</a>
            </div>
            <div style="display:table-cell;width:400px;">
                <br/>       
                <?php
                  foreach ($arrayLetras as $letter){
                  	 echo "  <div style='display:table-cell;padding-right:10px'>";
                  	 echo"     <a href='#" . $letter . "'>" . $letter . "</a>";
                  	 echo "  </div>";
                  }
                  echo "     <div style='text-align:left;padding-top:10px'>";
                  echo "       <a href='" . URL . "dogbreeds/advancedSearch' >Advanced Search</a>"; 
                  echo "     </div>";
                 ?>
            </div>
         </div><!-- arrayLetrasTop -->
         
         <table class="picturesTable"  >
               <?php
                 $cols=3;
                 $index=0; 
                 foreach ($arrayLetras as $letter){
                   $letterBreeds=$mapLetras[$letter];
                   echo "<tr>  <td style='height:70px;vertical-align:bottom;text-align:left;padding-left:20px;' colspan='" . $cols . "'> <a name='" . $letter .  "'>" . $letter . "</a> &nbsp;<a href='#SelectInitial'>Back to top</a> </td>  </tr>\n";
                   //calculo cantidad de filas
                   $filas=floor(count($letterBreeds) / $cols);
                   if (($filas * $cols)<count($letterBreeds)) $filas++; 
                   $index=0;
                   for ($i=0; $i<$filas; $i++){
                   	  echo "<tr> \n";
                   	  for ($e=0; $e<$cols; $e++){
                   	  	if ($index>=count($letterBreeds)) break;
                   	    $bean=$letterBreeds[$index];
                   	    $index++;
                   	    echo "<td class='tdPictureContainer'> \n";
                   	    echo "<div class='pictureContainerAlpha'> \n";
                   	    echo "      <div data-nombreCodificado='" .  $bean->getNameEncoded() . "'/>";
                   	    //echo "    <a href='javascript:void(0)' onclick=navega('" . URL . "dogbreeds/info/" .  $bean->getNameEncoded() . "')> \n";
                   	    echo "      <table class='pictureInternalTable'> \n";
                   	    echo "        <tr><td class='pictureTitleAlpha'>" . $bean->getNombre() . "</td></tr> \n";
                   	    echo "        <tr><td><img class='breedImageAlpha' src='" . $GLOBALS['dirAplicacion'] . "/resources/images/breeds/" . $bean->getPictureUrl() . "' alt='" . $bean->getNombre() . "'></td></tr>";
                   	    echo "      </table> \n";
                   	    //echo "    </a> \n";
                   	    echo "</div>";
                   	    echo "</td> \n";
                   	  }                     	
                   	  echo "</tr> \n";
                   }
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
          
       </div><!-- columnCenter -->   
       
</div>
