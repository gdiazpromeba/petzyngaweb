(function(){


  var app = angular.module('breedsAlpha', []);
  
  
  
  app.controller('PicTableController', ['$scope', '$rootScope', '$log', '$http', function($scope, $rootScope, $log, $http){
	  
     console.log('hola controller');
     
	  

	  $scope.init = function(){
		  console.log('en init');
			var url= Global.dirCms + '/svc/conector/dogBreeds.php/seleccionaNgAlpha';
		    $http.get(url).
		    success(function(data, status, headers, config) {
			  $scope.bloques=data.bloques;
		    }).
		    error(function(data, status, headers, config) {
			  alert('there was a problem');
		    });		    	
	   };
	    

	    
	    $scope.itemClicked=function(nameEncoded){
		  $rootScope.$broadcast('itemClicked', nameEncoded);
	    }
	    
	    
    
    //$log.info("la página es " + $scope.page);
  
    
  }]);
  

  
  app.controller('DetailCtrl', ['$scope',  '$rootScope', '$http',  function($scope, $rootScope, $http){
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
			  alert("there was a problem calling the details' service");
		  });		    	
	  }	 
	  
	  $scope.buildUrl=function(nameEncoded){
      	var dataString = 'nombreCodificado='+ nameEncoded;
    	var url= Global.dirCms + '/svc/conector/dogBreeds.php/obtienePorNombreCodificado?' + dataString;		  
		return url;
	  }
	  
	 $rootScope.$on('itemClicked', function($event, nameEncoded){
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
	  
	  
  }]); 
  
  

  
  
  
})();