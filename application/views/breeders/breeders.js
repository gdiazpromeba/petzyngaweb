(function(){


  var app = angular.module('geoFlatList', ['ngStorage']);
  
  
  app.controller('GeoListController',  ['$scope', '$http', function($scope, $http){
    $scope.lastSelectedSecondArea={};
    
    $scope.geoList = [];
  
    
    $scope.getItems =function(area1Index){
      var lastSelectedSecondArea = $scope.lastSelectedSecondArea[area1Index];
      if (typeof(lastSelectedSecondArea)=="undefined") return null;
      var ret= $scope.geoList.firstAreas[area1Index].secondAreas[lastSelectedSecondArea].items;
      return ret;
    };
    
    $scope.setLastSelectedSecondArea =function(area1Index, selSecondArea){
        $scope.lastSelectedSecondArea[area1Index]= selSecondArea;
    };
    
    $scope.setCountry = function(country){
    	$scope.url = Global.dirCms + '/svc/conector/sheltersGeo.php?country=' + country ;
        $http.get($scope.url)
        .then(function(result) {
          $scope.geoList = result.data;
        });      	
    };
    
    
  }]);
  
  app.controller('AdvSearchCtrl', ['$scope', '$rootScope', '$log', '$http', '$localStorage', '$timeout', function($scope, $rootScope, $log, $http, $localStorage, $timeout){
	  
	  $scope.storage=$localStorage;
	  

	  
      $scope.storage.usaDistancia = true;
      
     
      

      
      $scope.$watchGroup(['storage.page', 'storage.formParams.firstArea', 'storage.country2'], function(newValues, oldValues) {
    	  
    	  //country
    	  
//    	  if (oldValues[2] != newValues[2]){
//
//    		  $log.info('cambió ek country');
//    		  $scope.readPrimerasAreas($scope.storage.country2);
//    	  }else
//
//    	  
//    	  //page
//    	  if (oldValues[0] != newValues[0]){
//    		  $log.info('cambió la página');
//    		  $scope.callService(false);
//    	  }else
    	  
    	  //firstArea
    	  if (oldValues[1] != newValues[1]){
    		  $log.info('cambió la primera área: vieja=' + oldValues[1] + ' nueva=' +newValues[1]	);
    		  $scope.readSegundasAreas($scope.storage.country2, $scope.storage.formParams.firstArea);
    	  }
    	  

    	});
      
	    $scope.$on("pageMoved", function(evt, page) {
	    	$log.info('received pageMoved event');
	    	$scope.storage.page=page;
	    	$scope.callService(false);
	    });
     
	  
	  $scope.initialize = function(country){
		//carga las dog breeds por única vez
		if (typeof($scope.storage.dogBreeds)=='undefined'){  
			 $scope.readDogBreeds();
	    }
		//una especie de detector de cambio, porque en initialize el watch no anda
		var oldCountry =  $scope.storage.country2;
		var newCountry = country;
		$scope.storage.country2 = country;
		//esto ocurre cuando viene a esta página al principio, o desde otro país
		if (oldCountry != newCountry){
			 $log.info('countries difieren');
			 $scope.storage.formParams={};
			 $scope.storage.firstAreas={};
			 $scope.storage.secondAreas={};
			 $scope.readPrimerasAreas($scope.storage.country2);
			 $scope.callService(true);
		}else{
			 $log.info('countries iguales');
			//volviendo de jun detalle, mismo país
			 initializeMap($scope.storage.tableData, $scope.country);
			 //simular un llamado al servicio
			 $log.info('table total=' + $scope.storage.tableTotal);
			 $timeout(function(){
				 $scope.$broadcast('backToPage', {tableTotal : $scope.storage.tableTotal, page: $scope.storage.page});
			   }, 1000);
			 //el control no toma los valores, hay que reestablecerlos
//			 $(".pagination").jqPagination('option', 'max_page', $scope.storage.pageCount);
//			 $(".pagination").jqPagination('option', 'current_page',  $scope.storage.page);
		}
		
		
		
	
		
	  };
	  

	  $scope.readPrimerasAreas = function(country){
		  var url = Global.dirCms + "/svc/conector/areas.php/selPrimerasAreasBreedersJson?country=" + country + '&addFirstAll=true ';
		  $http.get(url).
		    success(function(data, status, headers, config) {
			  $scope.storage.firstAreas=data.items;
		    }).
		    error(function(data, status, headers, config) {
			  alert('there was a problem reading the 1st areas of ' + country);
		    });				   
	  }	
	  
	  $scope.readSegundasAreas = function(country, firstArea){
		  var url = Global.dirCms + "/svc/conector/areas.php/selSegundasAreasBreedersJson?country=" + country + '&firstArea=' + firstArea  + '&addFirstAll=true ';
		  $http.get(url).
		    success(function(data, status, headers, config) {
			  $scope.storage.secondAreas=data.items;
		    }).
		    error(function(data, status, headers, config) {
			  alert('there was a problem reading the 2nd areas of ' + country);
		    });				  
	  }	
	  
	  $scope.readDogBreeds = function(){
		  var url = Global.dirCms + "/svc/conector/dogBreeds.php/selecciona?start=0&limit=10000";
		  $http.get(url).
		    success(function(data, status, headers, config) {
			  $scope.storage.dogBreeds=data.data;
		    }).
		    error(function(data, status, headers, config) {
			  alert('there was a problem reading the dog breeds');
		    });				  
	  }		  
	  
	  
	  
	  
	  /**
	   * el parámetro "reset" indica si se debe correr el cursor a la primera página 
	   * Eso debe ocurrir sólo cuando el servicio se llama a raíz de haber pulsado "Buscar".
	   * Los "callService" producidos por la navegación del cursor no deben actualizar la current_page
	   */
	  $scope.callService = function(reset){
		  $log.info('llamando al servicio, reset=' + reset);
			var url=$scope.buildUrl(reset);
		    $http.get(url).
		    success(function(data, status, headers, config) {
		      initializeMap(data.data, $scope.country);
			  $scope.storage.tableData=data.data;
			  $scope.storage.tableTotal=data.total;
			  if (reset){
			    $scope.$broadcast('recordCountRetrieved', {tableTotal : data.total});
			  }
		    }).
		    error(function(data, status, headers, config) {
			  alert('there was a problem');
		    });		    	
	   };
	    
	  
	    $scope.buildUrl=function(reset){
	    	var url=  Global.dirCms + "/svc/conector/breeders" +  $scope.storage.country2.charAt(0).toUpperCase() + $scope.storage.country2.slice(1)  + ".php/seleccionaUniversal";
	    	url +="?latitude=0&longitude=0";
	    	var page= $scope.storage.page;
	    	if (isNaN(page)) page=1;
	    	if (reset){
	    	  url +='&start=0&limit=10';
	    	}else{
		      url +='&start=' + ((page-1) * 10);
		      url +='&limit=10';
	    	}
	    	if ($scope.storage.formParams!=undefined){
	    	  if (typeof($scope.storage.formParams.breederName)!='undefined'){
	    		url +='&breederName=' +$scope.storage.formParams.breederName;	
	    	  }
	    	  if (typeof($scope.storage.formParams.zipCode)!='undefined'){
	    		url +='&zipCode=' +$scope.storage.formParams.zipCode;
	    		$scope.usaDistancia = true;
	    	  }else{
	    		$scope.usaDistancia = false;
	    	  }
	    	  if (typeof($scope.storage.formParams.dogBreedId)!='undefined'){
	    		url +='&specialBreedId=' +$scope.storage.formParams.dogBreedId;	
	    	  }	    	
	    	  if (typeof($scope.storage.formParams.firstArea)!='undefined'){
	    		url +='&firstArea=' +$scope.storage.formParams.firstArea;	
	    	  }	
	    	  if (typeof($scope.storage.formParams.secondArea)!='undefined'){
	    		url +='&secondArea=' +$scope.storage.formParams.secondArea;	
	    	  }
	    	}
	    	$log.info(url);
	    	return url;
	    };
	  

	    
	    $scope.itemClicked=function(nameEncoded){
		  $rootScope.$broadcast('itemClicked', nameEncoded);
	    }
	    
	    $scope.buttonClick=function(){
			  $scope.callService(true);
		  }
		  
		  $scope.reset=function(){
			  $scope.storage.formParams={};
		  }	
  
    
  }]); 
  
  app.controller('PageCtrl',  ['$scope', '$log', function($scope, $log){
	    

	    $scope.pageSize=10;
	    
	    $scope.setItemCount = function(itemCount){
	    	$scope.itemCount = itemCount;
	    	if (itemCount < $scope.pageSize){
	    		$scope.page=1;
	    		$scope.pageCount=1;
	    		return;
	    	}
	    	$scope.pageCount=$scope.calculatePages(itemCount);
	    	$scope.page=1;
	    	$log.info('in setItemCount, just set pageCount=' + $scope.pageCount + ' and page=' + $scope.page );
	    }
	    
	    $scope.calculatePages = function (itemCount){
	    	var div = Math.floor(itemCount / $scope.pageSize);
	    	var rem = itemCount % $scope.pageSize;
	    	if (rem > 0) div++;
	    	return div;
	    }
	    
	    $scope.forward = function (){
	    	var tentative = $scope.page +1;
	    	$scope.page = Math.min(tentative, $scope.pageCount);
	    	$log.info('llamado forward, emito pageMOved con page=' + $scope.page);
	    	$scope.$emit('pageMoved', $scope.page);
	    }
	    
	    $scope.back = function(){
	    	var tentative = $scope.page -1;
	    	$scope.page = Math.max(tentative, 1);
	    	$scope.$emit('pageMoved', $scope.page);
	    }
	    
	    $scope.$on("recordCountRetrieved", function(evt, info) {
	    	var tableTotal = info.tableTotal;
	    	$log.info('received recordCountRetrieved event, con TableTotal=' + tableTotal);
	    	$scope.setItemCount(tableTotal);
	    });
	    
	    $scope.$on("backToPage", function(evt, info) {
	    	var tableTotal = info.tableTotal;
	    	var page = info.page;
	    	$log.info('received backToPage event, con TableTotal=' + tableTotal + ' y page=' + page );
	    	$scope.pageCount = $scope.calculatePages(tableTotal);
	    	$scope.page=page;
	    });	    
  }]);
  

  /** 
   * controla el click en la imagen de razas relacionadas
   */
  app.controller('RelatedDogBreedsCtrl', ['$scope',  '$rootScope', '$http',  function($scope, $rootScope, $http){

	  $scope.setBreederId = function(id){
		  $scope.breederId = id;
		  var url= Global.dirCms + '/svc/conector/dogBreeds.php/selNombresPorBreeder?breederId=' + id;
		  $http.get(url).
		    success(function(data, status, headers, config) {
				  $scope.breeds=data.data;
			    }).
			    error(function(data, status, headers, config) {
			    	 alert("there was a problem getting related breeds.\nUrl:=" + url);
		   });		  
	  }
	  
	  $scope.itemClicked=function(nameEncoded){
			  $rootScope.$broadcast('itemClicked', nameEncoded);
	  };

	  
  }]);  
  
  /**
   * copia exacta de la que está en breeds
   */
  app.directive('dogBreedDetails', function() {
	  return {
		  restrict : 'E',		  
		  templateUrl : Global.dirAplicacion + "/public/js/dogbreeds/dog-breed-details.html",
	  }
	});
  
  
  /**
   * copia exacta de lo que hay en breeds.js
   */
  app.controller('DetailCtrl', ['$scope',  '$rootScope', '$http', '$log',  function($scope, $rootScope, $http, $log){
	  $scope.details={};
	  $scope.visible=false;
	  $scope.tabsClicked=[false, true, false, false, false, false];
	  $scope.tabNumber=1;
	  
	  $scope.isVisible=function(){
		  $scope.visible;
	  }
	  
	  $scope.populateDetails = function(nameEncoded){
		  var url=$scope.buildUrl(nameEncoded);
		  $http.get(url).
		    success(function(data, status, headers, config) {
			  $scope.details=data;
			  $scope.rankingText=$scope.details.friendlyText;
		    }).
		    error(function(data, status, headers, config) {
		    	 alert("there was a problem calling the details' service.\nUrl:=" + url);
		  });		    	
	  }	 
	  
	  $scope.buildUrl=function(nameEncoded){
      	var dataString = 'nombreCodificado='+ nameEncoded;
    	var url= Global.dirCms + '/svc/conector/dogBreeds.php/obtienePorNombreCodificado?' + dataString;		  
		return url;
	  }
	  
	 $rootScope.$on('itemClicked', function($event, nameEncoded){
		 $log.info('detecto itemClicked, el nameEncoded es=' + nameEncoded);
		 $scope.populateDetails(nameEncoded);
		 $scope.visible=true;
	 });
	 
	 $scope.setTab = function(value){
		 for (var i=1; i<=5; i++){
			 	  $scope.tabsClicked[i]=false;	
	     };
		 $scope.tabsClicked[value]=true;
		 $scope.tabNumber=value;
		 switch(value){
		 case 1:
			 $scope.rankingText=$scope.details.friendlyText;
			 break;
		 case 2:
			 $scope.rankingText=$scope.details.activeText;
			 break;
		 case 3:
			 $scope.rankingText=$scope.details.healthyText;
			 break;
		 case 4:
			 $scope.rankingText=$scope.details.guardianText;
			 break;
		 case 5:
			 $scope.rankingText=$scope.details.groomingText;
			 break;
		 }
	 }
	 
	 $scope.closeButtonClicked = function(){
		 $rootScope.$broadcast('detailsClosedEvent');
	 }
	  
	  
  }]); 
  


  
  
  
})();