!function(){var e=angular.module("geoFlatList",["ngStorage"])
e.controller("GeoListController",["$scope","$http",function(e,a){e.lastSelectedSecondArea={},e.geoList=[],e.getItems=function(a){var r=e.lastSelectedSecondArea[a]
if(void 0===r)return null
var t=e.geoList.firstAreas[a].secondAreas[r].items
return t},e.setLastSelectedSecondArea=function(a,r){e.lastSelectedSecondArea[a]=r},e.setCountry=function(r){e.url=Global.dirCms+"/svc/conector/sheltersGeo.php?country="+r,a.get(e.url).then(function(a){e.geoList=a.data})}}]),e.controller("AdvSearchCtrl",["$scope","$rootScope","$log","$http","$localStorage","$timeout",function(e,a,r,t,o,s){e.storage=o,e.storage.usaDistancia=!0,e.$watchGroup(["storage.page","storage.formParams.firstArea","storage.country2"],function(a,t){t[1]!=a[1]&&(r.info("cambió la primera área: vieja="+t[1]+" nueva="+a[1]),e.readSegundasAreas(e.storage.country2,e.storage.formParams.firstArea))}),e.$on("pageMoved",function(a,t){r.info("received pageMoved event"),e.storage.page=t,e.callService(!1)}),e.initialize=function(a){void 0===e.storage.dogBreeds&&e.readDogBreeds()
var t=e.storage.country2,o=a
e.storage.country2=a,t!=o?(r.info("countries difieren"),e.storage.formParams={},e.storage.firstAreas={},e.storage.secondAreas={},e.readPrimerasAreas(e.storage.country2),e.callService(!0)):(r.info("countries iguales"),initializeMap(e.storage.tableData,e.country),r.info("table total="+e.storage.tableTotal),s(function(){e.$broadcast("backToPage",{tableTotal:e.storage.tableTotal,page:e.storage.page})},1e3))},e.readPrimerasAreas=function(a){var r=Global.dirCms+"/svc/conector/areas.php/selPrimerasAreasBreedersJson?country="+a+"&addFirstAll=true "
t.get(r).success(function(a){e.storage.firstAreas=a.items}).error(function(){alert("there was a problem reading the 1st areas of "+a)})},e.readSegundasAreas=function(a,r){var o=Global.dirCms+"/svc/conector/areas.php/selSegundasAreasBreedersJson?country="+a+"&firstArea="+r+"&addFirstAll=true "
t.get(o).success(function(a){e.storage.secondAreas=a.items}).error(function(){alert("there was a problem reading the 2nd areas of "+a)})},e.readDogBreeds=function(){var a=Global.dirCms+"/svc/conector/dogBreeds.php/selecciona?start=0&limit=10000"
t.get(a).success(function(a){e.storage.dogBreeds=a.data}).error(function(){alert("there was a problem reading the dog breeds")})},e.callService=function(a){r.info("llamando al servicio, reset="+a)
var o=e.buildUrl(a)
t.get(o).success(function(r){initializeMap(r.data,e.country),e.storage.tableData=r.data,e.storage.tableTotal=r.total,a&&e.$broadcast("recordCountRetrieved",{tableTotal:r.total})}).error(function(){alert("there was a problem")})},e.buildUrl=function(a){var t=Global.dirCms+"/svc/conector/breeders"+e.storage.country2.charAt(0).toUpperCase()+e.storage.country2.slice(1)+".php/seleccionaUniversal"
t+="?latitude=0&longitude=0"
var o=e.storage.page
return isNaN(o)&&(o=1),a?t+="&start=0&limit=10":(t+="&start="+10*(o-1),t+="&limit=10"),void 0!=e.storage.formParams&&(void 0!==e.storage.formParams.breederName&&(t+="&breederName="+e.storage.formParams.breederName),void 0!==e.storage.formParams.zipCode?(t+="&zipCode="+e.storage.formParams.zipCode,e.usaDistancia=!0):e.usaDistancia=!1,void 0!==e.storage.formParams.dogBreedId&&(t+="&specialBreedId="+e.storage.formParams.dogBreedId),void 0!==e.storage.formParams.firstArea&&(t+="&firstArea="+e.storage.formParams.firstArea),void 0!==e.storage.formParams.secondArea&&(t+="&secondArea="+e.storage.formParams.secondArea)),r.info(t),t},e.itemClicked=function(e){a.$broadcast("itemClicked",e)},e.buttonClick=function(){e.callService(!0)},e.reset=function(){e.storage.formParams={}}}]),e.controller("PageCtrl",["$scope","$log",function(e,a){e.pageSize=10,e.setItemCount=function(r){return e.itemCount=r,r<e.pageSize?(e.page=1,void(e.pageCount=1)):(e.pageCount=e.calculatePages(r),e.page=1,void a.info("in setItemCount, just set pageCount="+e.pageCount+" and page="+e.page))},e.calculatePages=function(a){var r=Math.floor(a/e.pageSize),t=a%e.pageSize
return t>0&&r++,r},e.forward=function(){var r=e.page+1
e.page=Math.min(r,e.pageCount),a.info("llamado forward, emito pageMOved con page="+e.page),e.$emit("pageMoved",e.page)},e.back=function(){var a=e.page-1
e.page=Math.max(a,1),e.$emit("pageMoved",e.page)},e.$on("recordCountRetrieved",function(r,t){var o=t.tableTotal
a.info("received recordCountRetrieved event, con TableTotal="+o),e.setItemCount(o)}),e.$on("backToPage",function(r,t){var o=t.tableTotal,s=t.page
a.info("received backToPage event, con TableTotal="+o+" y page="+s),e.pageCount=e.calculatePages(o),e.page=s})}]),e.controller("RelatedDogBreedsCtrl",["$scope","$rootScope","$http",function(e,a,r){e.setBreederId=function(a){e.breederId=a
var t=Global.dirCms+"/svc/conector/dogBreeds.php/selNombresPorBreeder?breederId="+a
r.get(t).success(function(a){e.breeds=a.data}).error(function(){alert("there was a problem getting related breeds.\nUrl:="+t)})},e.itemClicked=function(e){a.$broadcast("itemClicked",e)}}]),e.directive("dogBreedDetails",function(){return{restrict:"E",templateUrl:Global.dirAplicacion+"/public/js/dogbreeds/dog-breed-details.html"}}),e.controller("DetailCtrl",["$scope","$rootScope","$http","$log",function(e,a,r,t){e.details={},e.visible=!1,e.tabsClicked=[!1,!0,!1,!1,!1,!1],e.tabNumber=1,e.isVisible=function(){e.visible},e.populateDetails=function(a){var t=e.buildUrl(a)
r.get(t).success(function(a){e.details=a,e.rankingText=e.details.friendlyText}).error(function(){alert("there was a problem calling the details' service.\nUrl:="+t)})},e.buildUrl=function(e){var a="nombreCodificado="+e,r=Global.dirCms+"/svc/conector/dogBreeds.php/obtienePorNombreCodificado?"+a
return r},a.$on("itemClicked",function(a,r){t.info("detecto itemClicked, el nameEncoded es="+r),e.populateDetails(r),e.visible=!0}),e.setTab=function(a){for(var r=1;5>=r;r++)e.tabsClicked[r]=!1
switch(e.tabsClicked[a]=!0,e.tabNumber=a,a){case 1:e.rankingText=e.details.friendlyText
break
case 2:e.rankingText=e.details.activeText
break
case 3:e.rankingText=e.details.healthyText
break
case 4:e.rankingText=e.details.guardianText
break
case 5:e.rankingText=e.details.groomingText}},e.closeButtonClicked=function(){a.$broadcast("detailsClosedEvent")}}])}()
