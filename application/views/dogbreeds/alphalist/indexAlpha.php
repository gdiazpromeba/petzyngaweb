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
         
         

       
          <div  ng-controller="PicTableController" style="margin-bottom: 20px;display:flex;flex-direction:column" ng-init="init()">
            <div ng-repeat="bloque in bloques" style="margin-left:10px;margin-top:30px">
                  <a name='{{bloque.letra}}'>{{bloque.letra}}</a> &nbsp;<a href='#SelectInitial'>Back to top</a>
              
	              <div style="display:flex;flex-direction:row;justify-content:center;" ng-repeat="row in bloque.rows" >
	         
	          
	                <div style="display:flex;flex-direction:column;" ng-repeat="cell in row.cells">
	           
	                  <div class='pictureContainerAlpha' ng-click="itemClicked(cell.nameEncoded)">
	                     
	                    
	                    
	                    <div class="pictureTitleAlpha">{{cell.name}}</div>
	                    <div><img class="breedImageAlpha" ng-src="{{cell.pictureUrl}}"/></div>
	                    
	                  
	                  </div>
	                  
	           
	                  
	                </div>
	                
	                
	                            
	              </div>
	              
              
              
            </div>
         </div>
       
       


 			         <div ng-show="visible" class="detalleDogBreed" ng-controller="DetailCtrl as det">
			           <div style="position:absolute;top:10px;right:10px;" ng-click="visible=false">
			             <img style="width:20px;height:20px;" ng-src="<?php echo $GLOBALS['dirWeb'] . "/public/img/close_button_turquesa.gif";?>"/>
			           </div>
			           <div id="superior" flex-grow="1" style="color:black;padding:5px">
			             <div class="tituloVentanaDetalle" style="display:block;text-align:center">{{details.dogBreedName}}</div>
			             <div style="display:block">{{details.headerText}}</div>
			           </div>
			           <div id="medio" style="display:flex;flex-grow:1;flex-direction:row;padding:5px;">
			             <div id="detalleFoto" style="flex-grow=2;display:flex;flex-direction:column">
			               <img class="breedImageDetalle" ng-src="<?php echo $GLOBALS['dirAplicacion'] . "/resources/images/breeds/";?>{{details.pictureUrl}}"/>
			               <div class="mainFeatures">{{details.mainFeatures}}</div>
			               <div class="mainFeatures"> "Watch a <a target='_blank' href='http://www.youtube.com/watch?v={{details.videoUrl}}'>Video</a></div>
			             </div> 
			             <div id="stats" style="flex-grow=2;display:flex;flex-direction:column;padding:5px;margin-left:10px">
			               <div class="feature">
			                 <div class="featureTitle">Size</div>
			                 <div class="featureText">{{details.dogSizeName}}</div>
			               </div>
			               <div class="feature">
			                 <div class="featureTitle">Color</div>
			                 <div class="featureText">{{details.colors}}</div>
			               </div>
			               <div class="feature">
			                 <div class="featureTitle">Weight (lbs)</div>
			                 <div class="featureText">from {{details.weightMin}} to {{details.weightMax}}</div>
			               </div>
			               <div class="feature">
			                 <div class="featureTitle">Height (inches)</div>
			                 <div class="featureText">from {{details.sizetMin}} to {{details.sizeMax}}</div>
			               </div>
			               <div class="feature">
			                 <div class="featureTitle">Shedding</div>
			                 <div class="featureText">{{details.dogSheddingAmountName}}, {{details.dogSheddingFrequencyName}}</div>
			               </div>
			               <div class="feature">
			                 <div class="featureTitle">Feeding</div>
			                 <div class="featureText">{{details.feedingArmado}}</div>
			               </div>			               			               			               			               
			             </div>
			           </div>

			             <div class="rankingBlock">
			               <div class="rankingTabs">
			                 <div ng-class="{true: 'rankingHeaderSelected' , false: 'rankingHeader'}[tabsClicked[1]]" ng-click="setTab(1)" >
			                   <div class="rankingTitle" >How friendly are they?</div>
                               <img style="height:20px;margin-left:5px" ng-src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_";?>{{details.friendlyRank}}.gif'/>
                             </div>
			                 <div  ng-class="{true: 'rankingHeaderSelected' , false: 'rankingHeader'}[tabsClicked[2]]" ng-click="setTab(2)" >
			                   <div class="rankingTitle"> How active are they?</div>
                               <img style="height:20px;margin-left:5px" ng-src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_";?>{{details.activeRank}}.gif'/>
                             </div>
			                 <div ng-class="{true: 'rankingHeaderSelected' , false: 'rankingHeader'}[tabsClicked[3]]" ng-click="setTab(3)" >
			                   <div class="rankingTitle"> How healthy are they?</div>
                               <img style="height:20px;margin-left:5px" ng-src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_";?>{{details.healthyRank}}.gif'/>
                             </div>   
			                 <div ng-class="{true: 'rankingHeaderSelected' , false: 'rankingHeader'}[tabsClicked[4]]" ng-click="setTab(4)" >
			                   <div class="rankingTitle"> Are they good guardians?</div>
                               <img style="height:20px;margin-left:5px" ng-src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_";?>{{details.guardianRank}}.gif'/>
                             </div>  
			                 <div ng-class="{true: 'rankingHeaderSelected' , false: 'rankingHeader'}[tabsClicked[5]]" ng-click="setTab(5)" >
			                   <div class="rankingTitle"> How much grooming needed?</div>
                               <img style="height:20px;margin-left:5px" ng-src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_";?>{{details.groomingRank}}.gif'/>
                             </div>                                                                                   
                             
                           </div>
                           <div class="rankingText">{{rankingText}}</div>
			             </div>
			         </div><!-- detalleDogBreed -->        
            
          
       </div><!-- columnCenter -->   
       
</div>
