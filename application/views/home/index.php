<?php require_once 'utils/Resources.php';?>

   <div style="justify-content:center;display:flex;flex-direction:row">
   
   
       <div id="columLeft" class="columnLeft">
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_02'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('india_no_kill_tradition'); ?></div>
         <div class="stickitColumna"><?php echo Resources::getText('peta_position_on_no_kill'); ?></div>
       </div>
       <div id="columLeft" class="columnRight">
         <div class="stickitColumna"><?php echo Resources::getText('col_der_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('col_izq_breeders_01'); ?></div>
         <br/>
         <div class="stickitColumna"><?php echo Resources::getText('blue_cross_uk'); ?></div>
       </div>
       
       <div id="columnCenter"  class="columnCenter">   

		<br />
		<div class="tituloSeccion">What is Petzynga?</div>
		<hr />
		<div
			style="font-size: 16px; text-align: justify; padding-top: 20px; padding-bottom: 20px; padding-left: 30px; padding-right: 30px; line-height: 150%">
		      <?php echo Resources::getText('home_page_content'); ?>
		      
		 
		</div>


		<div class="centro">
		
		
		
		
		
			<br />
			<div class="tituloSeccion">Videos of the week</div>
			<hr />
			<div class="videoWrapper">
				<div style="height: 6px" />
				&nbsp;
			</div>
			<iframe width='297' height='221'
				src='http://www.youtube.com/embed/<?php echo $bean->getVideo1Url();?>'
				frameborder='0' allowfullscreen></iframe>
			<iframe width='297' height='221'
				src='http://www.youtube.com/embed/<?php echo $bean->getVideo2Url();?>'
				frameborder='0' allowfullscreen></iframe>
			<iframe width='297' height='221'
				src='http://www.youtube.com/embed/<?php echo $bean->getVideo3Url();?>'
				frameborder='0' allowfullscreen></iframe>
		</div>



		<br />
		
		<div class="tituloSeccion">Featured Breeds</div>
		<hr />


		<div ng-controller="FeaturedDogBreedsCtrl" ng-init="init()">
		
			
			<div style="display: flex; flex-direction: row; flex-wrap: wrap">
		
				<div class='pictureContainerAlpha' ng-click="itemClicked(breed.nameEncoded)" ng-repeat="breed in breeds">
					<div data-nombreCodificado='{{breed.nameEncoded}}'></div>
					<div class="pictureTitleAlpha">{{breed.name}}</div>
					<div>
						<img class="breedImage" ng-src="{{breed.fullPictureUrl}}" />
					</div>
				</div>
		
			</div>
		
			
			   
		    <div ng-controller="DetailCtrl">
		       <dog-breed-details></dog-breed-details>
		    </div>	
		
		
		</div>




		
	   </div>
   
   </div>

</div>
