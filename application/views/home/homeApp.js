(function(){


  var app = angular.module('homeApp', []);
  

  app.controller('FeaturedDogBreedsCtrl', ['$scope',  '$rootScope', '$http',  function($scope, $rootScope, $http){

	  
	  $scope.init = function(){
		  var url= Global.dirCms + '/svc/conector/frontPage.php/readFeaturedBreeds';
		  $http.get(url).
		    success(function(data, status, headers, config) {
				  $scope.breeds=data;
			    }).
			    error(function(data, status, headers, config) {
			    	 alert("there was a problem getting featured breeds.\nUrl:=" + url);
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