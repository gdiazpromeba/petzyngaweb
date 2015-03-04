 <?php require_once 'utils/Resources.php';?>
 
<div style="display:flex;justify-content:center">




    <div class="columnLeft">
      <div class="stickitColumna"><?php echo Resources::getText("india_no_kill_tradition"); ?></div>
      <div class="stickitColumna"><?php echo Resources::getText("peta_position_on_no_kill"); ?></div>
    </div>
    <div class="columnRight">
      <div class="stickitColumna"><?php echo Resources::getText("mspca_angell"); ?></div>
      <div class="stickitColumna"><?php echo Resources::getText("saluki"); ?></div>
    </div>

    <div id="columnCenter"  class="columnCenter" style="margin-left:10px">
    
      <?php include $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dirWeb'] . '/application/views/shelters/submenuShelters.php' ?>
	  

      <div ng-controller="GeoListController"  ng-init="setCountry('<?php echo $country; ?>')">
        <div style="padding:5px;width:100%;display:flex;flex-direction:row;justify-content:space-around">
          <div class="tituloFormBusqueda">Search for shelters in ... </div>
        </div>
        <div ng-repeat="area1 in geoList.firstAreas" style="border-color:red;border-style:none;text-align:left;padding:5px;">
           <button class="butFirstArea" ng-click="area1.collapsed = !area1.collapsed">{{area1.name}}</button>
           <div ng-show="!area1.collapsed" style="padding-left:5px">
             <div ng-repeat="area2 in area1.secondAreas" style="display:flex;flex-direction:column;align-items:flex-start;margin-top:10px;">
               <button  class="butSecondArea" ng-click="area2.collapsed = !area2.collapsed" >{{area2.name}}</button>
               <div style="display: flex;width:100%;flex-direction:row;flex-wrap:wrap;justify-content:space-around">
                 <div ng-repeat="item in area2.items">
                   <a href="{{item.url}}" style="padding:5px;">{{item.name}}</a> 
                 </div>
               </div>
             </div>
           </div>
       </div> 
     </div>
           
        

    </div><!-- columnCenter -->
</div>