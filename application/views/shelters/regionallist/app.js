(function(){


  var app = angular.module('geoFlatList', []);
  
  
  app.controller('GeoListController', function($scope, $http){
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
    }
    
    
  });
  
  app.controller('AdvSearchPicTableCtrl', ['$scope', '$rootScope', '$log', '$http', function($scope, $rootScope, $log, $http){
	  
      $scope.usaDistancia = true;
	  
	  $scope.initialize = function(country){
		$log.info("en init"); 
		$scope.page=1;
		$scope.connectorUrl = Global.dirCms + "/svc/conector/shelters" +  country.charAt(0).toUpperCase() + country.slice(1)  + ".php/seleccionaUniversal";
		$scope.formParams={};
	  };
	  
	  $scope.$watch(function() {
		  return $scope.page;
		}, function(newValue, oldValue) {
			$scope.page=newValue;
			$scope.callService(false);
	  });	 
	  
	  /**
	   * el parámetro "reset" indica si se debe correr el cursor a la primera página 
	   * Eso debe ocurrir sólo cuando el servicio se llama a raíz de haber pulsado "Buscar".
	   * Los "callService" producidos por la navegación del cursor no deben actualizar la current_page
	   */
	  $scope.callService = function(reset){
			var url=$scope.buildUrl();
		    $http.get(url).
		    success(function(data, status, headers, config) {
		      initializeMap(data.data, $scope.country);
			  $scope.tableData=data.data;
			  if ($(".pagination").length){//esto es al principio, por si no encuentra todavía el control
			    var pageCount=$scope.calculatePages(data.total);
			    $(".pagination").jqPagination('option', 'max_page', pageCount);//el recálculo ocurre siempre
			    if (reset){
			    	$(".pagination").jqPagination('option', 'current_page', 1);
			    }
			  }else{
				  alert('no pagination found');
			  }
		    }).
		    error(function(data, status, headers, config) {
			  alert('there was a problem');
		    });		    	
	   };
	    
	   $scope.calculatePages = function(itemCount){
            var pageCount;
            var division= itemCount /10;
            if (division > Math.floor(division)){
              pageCount = Math.floor(division) + 1;
            }else{
         	 pageCount = Math.floor(division);  
            }	
            return pageCount;
	   };
	  
	    $scope.buildUrl=function(){
	    	var url=$scope.connectorUrl;
	    	url +="?latitude=0&longitude=0";
	    	url +='&start=' + (($scope.page-1) * 10);
	    	url +='&limit=10';
	    	if (typeof($scope.formParams.shelterName)!='undefined'){
	    		url +='&shelterName=' + $scope.formParams.shelterName;	
	    	}
	    	if (typeof($scope.formParams.zipCode)!='undefined'){
	    		url +='&zipCode=' + $scope.formParams.zipCode;
	    		$scope.usaDistancia = true;
	    	}else{
	    		$scope.usaDistancia = false;
	    	}
	    	if (typeof($scope.formParams.dogBreedName)!='undefined'){
	    		url +='&dogBreedName=' + $scope.formParams.dogBreedName;	
	    	}	    	
	    	if (typeof($scope.formParams.firstArea)!='undefined'){
	    		url +='&firstArea=' + $scope.formParams.firstArea;	
	    	}	
	    	if (typeof($scope.formParams.secondArea)!='undefined'){
	    		url +='&secondArea=' + $scope.formParams.secondArea;	
	    	}	    	
	    	$log.info(url);
	    	return url;
	    };
	  
	    $rootScope.$on('AdvSearchFormButtonClicked', function($event, $formParams){
	    	$scope.formParams=$formParams;  //paso una variable "formParams" también a este controller
	    	$scope.callService(true);
	    	
	    });
	    
	    $scope.itemClicked=function(nameEncoded){
		  $rootScope.$broadcast('itemClicked', nameEncoded);
	    }
	    
	    
    
    //$log.info("la página es " + $scope.page);
  
    
  }]); 
  
  app.controller('AdvSearchFormParamCtrl', ['$scope',  '$rootScope', function($scope, $rootScope){
	  $scope.formParams={};
	  
	  $scope.buttonClick=function(){
		  $rootScope.$broadcast('AdvSearchFormButtonClicked', $scope.formParams);
	  }
	  
	  $scope.reset=function(){
		  $scope.formParams={};
	  }	  
	  
  }]);   
  
  
  
})();