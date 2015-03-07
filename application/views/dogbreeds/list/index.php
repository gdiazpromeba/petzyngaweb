


    
  

 


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
       
         <?php include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/views/dogbreeds/submenuDogBreeds.php' ?>
       
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


         <div ng-controller="DetailCtrl">
           <dog-breed-details item="details"></dog-breed-details>
         </div>
	         
	          
       </div><!-- columnCenter -->
     

              

</div><!--  del flex central -->
</div><!--  container -->
         
        
