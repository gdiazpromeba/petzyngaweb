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
       
       
       
       
       
       <div id="columnCenter"  class="columnCenter" ng-controller="HomePageCtrl"  ng-init="init(<?php echo $initParams; ?>)">   
       
       <div id="seccionContenido" ng-show="contenidoVisible" >

		  <br />
		  <div class="tituloSeccion">What is Petzynga?</div>
		  <hr />
		  <div class="homePageMainText" ng-bind-html="datos.homePageHeader"></div>

		  <div class="centro">
		  <br />
			<div class="tituloSeccion">Videos of the week</div>
			<hr />
			<iframe  width='297' height='221' frameborder='0' src="{{datos.videoUrls[1]}}" allowfullscreen></iframe>
			<iframe  width='297' height='221' frameborder='0' src="{{datos.videoUrls[2]}}" allowfullscreen></iframe>
		  </div>
		  <br />
		
		  <div class="tituloSeccion">Featured Breeds</div>
		  <hr />

			
			<div style="display: flex; flex-direction: row; flex-wrap: wrap">
		       
				<div class='pictureContainerAlpha' ng-click="itemClicked(breed.nameEncoded)" ng-repeat="breed in datos.featuredBreeds">
				  <a href="{{breed.link}}">
					<div data-nombreCodificado='{{breed.nameEncoded}}'></div>
					<div class="pictureTitleAlpha">{{breed.name}}</div>
					<div>
						<img class="breedImage" ng-src="{{breed.fullPictureUrl}}" />
					</div>
				  </a>	
				</div>
		      
		
			</div>
		</div> <!--  sección contenido -->
		
		<div id="seccionDetalleRaza"  >
		       <dog-breed-details-embebido></dog-breed-details-embebido>
	   </div> <!--  sección detalle raza -->
   
   </div>

</div>
