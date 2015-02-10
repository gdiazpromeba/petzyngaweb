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
  
  
  
})();