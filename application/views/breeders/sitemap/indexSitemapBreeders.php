 <?php require_once 'utils/Resources.php';?>
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
       
       <div id="columnCenter"  class="columnCenter" style="margin-left:10px;display:flex;flex-direction:column">
       
          <?php include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/views/breeders/submenuBreeders.php' ?>

		  <div ng-controller="MainController" ng-init="initialize(<?php echo $initParams;?>)">
		    {{showPanels}}
		    <div ng-show="showPanel=='Items'">
		      <div class="areaHeader">
		        <div class="countryTitle">Search for breeders in {{countryName}}</div>
		        <div class="area1Title">{{area1TypeName}} : {{area1}}</div>
		        <div class="area2Title">{{area2TypeName}} : {{area2}}</div>
		        <div class="area2Title">Breed : {{dogBreedName}}</div>
		      </div>
		      <div class="areaItemContainer" ng-repeat="item in items">
		        <a href="{{item.url}}">{{item.name}}</a>
		      </div>
		    </div>
		    
		    <div ng-show="showPanel=='Breeds'">
		      <div class="areaHeader">
		        <div class="countryTitle">Search for breeders in {{countryName}}</div>
		        <div class="area1Title">{{area1TypeName}} : {{area1}}</div>
		        <div class="area2Title">{{area2TypeName}} : {{area2}}</div>
		      </div>
		      <div class="areaItemContainer" ng-repeat="item in items">
		        <a href="{{item.url}}">{{item.name}}</a>
		      </div>
		    </div>		    

		    <div ng-show="showPanel=='Areas2'">
		      <div class="areaHeader">
		        <div class="countryTitle">Search for breeders in {{countryName}}</div>
		        <div class="area1Title">{{area1TypeName}} : {{area1}}</div>
		      </div>
		      <div class="areaItemContainer" ng-repeat="item in items">
		        <a href="{{item.urlEncoded}}">{{item.name}}</a>
		      </div>
		    </div>
		    
		    <div ng-show="showPanel=='Areas1'">
		      <div class="areaHeader">
		        <div class="countryTitle">Search for breeders in {{countryName}}</div>
		      </div>
		      <div class="areaItemContainer" ng-repeat="item in items">
		        <a href="{{item.urlEncoded}}">{{item.name}}</a>
		      </div>
		    </div>		    
		    
		  
		  </div>

		  
	   </div>



	

</div>
