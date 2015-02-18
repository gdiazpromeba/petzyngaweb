


    
  

 


         <?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/utils/RequestUtils.php';
  require_once 'configJs.php';
?>

<div style="display:flex;justify-content:center">

    
    <script type="text/javascript">
      var ultimoNombreCodificado;





      
      $(document).ready(function(){

             
        $("#cierraVentanita").click(function(){
        	$("#ventanita").fadeOut();
        });
        $("#moreDetails").click(function(){
            var url='<?php echo URL .  "dogbreeds/info/";?>' + ultimoNombreCodificado;
            location.replace( url);
        });   


		$('.pagination').jqPagination({
			link_string	: '/?page={page_number}',
			max_page	: 40,
			paged		: function(page) {
				$("#hiddenPageNumber").val(page);
				$("#hiddenPageNumber").trigger('input');
			}
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

 
    
	    
      

          <div  ng-controller="PicTableController" style="margin-bottom: 20px">
            <input  type="number"  id="hiddenPageNumber" style="display:none" ng-model="page"  style="width: 80px"/>
            <div style="display:flex;flex-direction:row;justify-content:center" ng-repeat="row in tableData.rows" >
              <div style="display:flex;flex-direction:column" ng-repeat="cell in row.cells" last-detector-directive>
                <div class='pictureContainerAlpha' ng-click="itemClicked(cell.nameEncoded)">
                  <div data-nombreCodificado='{{cell.nameEncoded}}'/> 
                  <div class="pictureTitleAlpha">{{cell.name}}</div>
                  <div><img class="breedImageAlpha" ng-src="<?php echo $GLOBALS['dirAplicacion'] . "/resources/images/breeds/";?>{{cell.pictureUrl}}"/></div>
                </div>
              </div>            
            </div><!-- rows -->
          </div>

    

			         <div ng-show="visible" class="detalleDogBreed" ng-controller="DetailCtrl as det">
			           <div id="superior" flex-grow="1" style="color:black;padding:5px">
			             <div style="display:block">{{details.dogBreedName}}</div>
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
                               <img style="height:20px;margin-left:5px" ng-src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_";?>{{details.friendlyRank}}.jpg'/>
                             </div>
			                 <div  ng-class="{true: 'rankingHeaderSelected' , false: 'rankingHeader'}[tabsClicked[2]]" ng-click="setTab(2)" >
			                   <div class="rankingTitle"> How active are they?</div>
                               <img style="height:20px;margin-left:5px" ng-src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_";?>{{details.activeRank}}.jpg'/>
                             </div>
			                 <div ng-class="{true: 'rankingHeaderSelected' , false: 'rankingHeader'}[tabsClicked[3]]" ng-click="setTab(3)" >
			                   <div class="rankingTitle"> How healthy are they?</div>
                               <img style="height:20px;margin-left:5px" ng-src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_";?>{{details.healthyRank}}.jpg'/>
                             </div>   
			                 <div ng-class="{true: 'rankingHeaderSelected' , false: 'rankingHeader'}[tabsClicked[4]]" ng-click="setTab(4)" >
			                   <div class="rankingTitle"> Are they good guardians?</div>
                               <img style="height:20px;margin-left:5px" ng-src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_";?>{{details.guardianRank}}.jpg'/>
                             </div>  
			                 <div ng-class="{true: 'rankingHeaderSelected' , false: 'rankingHeader'}[tabsClicked[5]]" ng-click="setTab(5)" >
			                   <div class="rankingTitle"> How much grooming needed?</div>
                               <img style="height:20px;margin-left:5px" ng-src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/estrellas_";?>{{details.groomingRank}}.jpg'/>
                             </div>                                                                                   
                             
                           </div>
                           <div class="rankingText">{{rankingText}}</div>
			             </div>
			         </div><!-- detalleDogBreed -->

         

         
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
     

              

</div><!--  del flex central -->
</div><!--  container -->
         
        
