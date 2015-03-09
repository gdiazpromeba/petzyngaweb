(function(){


  var sitemapBreeders = angular.module('sitemapBreeders', []);
  
  

  sitemapBreeders.controller('MainController', ['$scope', '$rootScope', '$log', '$http', function($scope, $rootScope, $log, $http){
	  
	  $scope.showPanel="";
	  
	  $scope.initialize = function ($country, $area1, $area2, $breedEncoded){
		$scope.country=$country;
		if ($area1!=null && $area2!=null && $breedEncoded!=null){
    		$scope.showPanel="Items";
			$scope.conArea1Area2Breed( $area1, $area2, $breedEncoded);
		}else if($area1!=null && $area2!=null){
    		$scope.showPanel="Breeds";
			$scope.conArea1Area2( $area1, $area2);
		}else if ($area1!=null){
			$scope.showPanel="Areas2";
			$scope.conArea1( $area1);
		}else{
			$scope.showPanel="Areas1";
			$scope.conPais();
		} 
	  };
	  
      $scope.buildUrlA12Breed=function(){
      	var url=Global.dirCms + '/svc/conector/breeders.php/selDogBreedersByAreasAndBreed';
      	url+="?country=" + $scope.country;
      	url +='&area1=' + $scope.area1;	
      	url +='&area2=' + $scope.area2;	
      	url +='&breedEncoded=' + $scope.breedEncoded;	
      	$log.info(url);
      	return url;
        };	  
        	  
	  
      $scope.buildUrlA12=function(){
    	var url=Global.dirCms + '/svc/conector/breeders.php/selDogBreedsByBreederAreas';
    	url+="?country=" + $scope.country;
    	url +='&area1=' + $scope.area1;	
    	url +='&area2=' + $scope.area2;	
    	$log.info(url);
    	return url;
      };	  
      
      $scope.buildUrlA1=function(){
      	var url=Global.dirCms + '/svc/conector/areas.php/selSegundasAreasBreedersJson';
      	url+="?country=" + $scope.country;
      	url +='&firstArea=' + $scope.area1;	
      	$log.info(url);
      	return url;
      };	
      
      $scope.buildUrl=function(){
        	var url=Global.dirCms + '/svc/conector/areas.php/selPrimerasAreasBreedersJson';
        	url+="?country=" + $scope.country;
        	$log.info(url);
        	return url;
      };  
      
      $scope.conArea1Area2Breed = function($area1, $area2, $breedEncoded){
        $scope.area1=$area1;
  		$scope.area2=$area2;
  		$scope.breedEncoded=$breedEncoded;
  		var url=$scope.buildUrlA12Breed();
  		$log.info(url);
  	    $http.get(url).
  	    success(function(data, status, headers, config) {
  		  $scope.countryName = data.countryName;
  		  $scope.area1TypeName = data.area1TypeName;
  		  $scope.area2TypeName = data.area2TypeName;
  		  $scope.dogBreedName = data.dogBreedName;
  		  $scope.items = data.items;
  	    }).
  	    error(function(data, status, headers, config) {
  		  alert('there was a problem');
  	    });			  
        }      
      
      /**
       * cuando hay área 1 y área 2
       */
      $scope.conArea1Area2 = function($area1, $area2){
  		$scope.area1=$area1;
		$scope.area2=$area2;
		$scope.urlPrefix= Global.dirAplicacion + '/breeders/info/' + $scope.country + '/';
		var url=$scope.buildUrlA12();
		$log.info(url);
	    $http.get(url).
	    success(function(data, status, headers, config) {
		  $scope.countryName = data.countryName;
		  $scope.area1TypeName = data.area1TypeName;
		  $scope.area2TypeName = data.area2TypeName;
		  $scope.items = data.items;
	    }).
	    error(function(data, status, headers, config) {
		  alert('there was a problem');
	    });			  
      }
      
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