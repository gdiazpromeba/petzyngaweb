(function(){


  var sitemapShelters = angular.module('areaShelters', []);
  
  

  sitemapShelters.controller('MainController', ['$scope', '$rootScope', '$log', '$http', function($scope, $rootScope, $log, $http){
	  
	  $scope.showPanel="";
	  
	  $scope.initialize = function ($country, $area1){
		$scope.country=$country;
    	if ($area1!=null ){
    		$scope.showPanel="Items";
			$scope.conArea1( $area1);
		}else if ($country){
			$scope.showPanel="Areas1";
			$scope.conPais();
		}
	  };
	  
      $scope.buildUrlA1=function(){
    	var url=Global.dirCms + '/svc/conector/sheltersCompressed.php';
    	url+="?country=" + $scope.country;
    	url +='&area1=' + $scope.area1;	
    	$log.info(url);
    	return url;
      };	  
      
	
      
      $scope.buildUrl=function(){
        	var url=Global.dirCms + '/svc/conector/areas.php/selPrimerasAreasSheltersJson';
        	url+="?country=" + $scope.country;
        	$log.info(url);
        	return url;
      };      
      

      
      $scope.conArea1 = function($area1){
    	$scope.area1=$area1;
  		var url=$scope.buildUrlA1();
  		$log.info(url);
  	    $http.get(url).
  	    success(function(data, status, headers, config) {
  		  $scope.countryName = data.countryName;
  	      $scope.items= data.items;
  		  $scope.area1TypeName = data.area1TypeName;
  	    }).
  	    error(function(data, status, headers, config) {
  		  alert('there was a problem');
  	    });			  
      }   
      
      $scope.conPais = function(){
        var url=$scope.buildUrl();
    	$log.info(url);
    	$http.get(url).
    	    success(function(data, status, headers, config) {
    		  $scope.countryName = data.countryName;
    	      $scope.items= data.items;
    	    }).
    	    error(function(data, status, headers, config) {
    		  alert('there was a problem');
    	});			  
      }       
	  
	  
	  
  }]);

  
  
})();