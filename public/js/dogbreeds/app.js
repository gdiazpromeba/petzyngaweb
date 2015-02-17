(function(){


  var app = angular.module('breeds', []);
  
  
  
  app.controller('PicTableController', ['$scope', '$rootScope', '$log', '$http', function($scope, $rootScope, $log, $http){
	  
	  $scope.init = function(){
		$log.info("en init"); 
		$scope.page=1;
		$scope.connectorUrl = Global.dirCms + '/svc/conector/dogBreeds.php/seleccionaNg';
		$scope.formParams={};
	  };
	  
	  $scope.init();
	  
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
			  $scope.tableData=data.data;
			  if ($(".pagination").length){//esto es al principio, por si no encuentra todavía el control
			    var pageCount=$scope.calculatePages(data.size);
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
            var division= itemCount /15;
            if (division > Math.floor(division)){
              pageCount = Math.floor(division) + 1;
            }else{
         	 pageCount = Math.floor(division);  
            }	
            return pageCount;
	   };
	  
	    $scope.buildUrl=function(){
	    	var url=$scope.connectorUrl;
	    	url +='?start=' + (($scope.page-1) * 15);
	    	if (typeof($scope.formParams.letraInicial)!='undefined'){
	    		url +='&inicial=' + $scope.formParams.letraInicial;	
	    	}
	    	if (typeof($scope.formParams.nombreOParte)!='undefined'){
	    		url +='&nombreOParte=' + $scope.formParams.nombreOParte;	
	    	}
	    	if (typeof($scope.formParams.selDogSize)!='undefined'){
	    		url +='&size=' + $scope.formParams.selDogSize;	
	    	}	    	
	    	if (typeof($scope.formParams.selDogFeeding)!='undefined'){
	    		url +='&alimentacion=' + $scope.formParams.selDogFeeding;	
	    	}	
	    	if (typeof($scope.formParams.selUpkeep)!='undefined'){
	    		url +='&upkeep=' + $scope.formParams.selUpkeep;	
	    	}	    	
	    	$log.info(url);
	    	return url;
	    };
	  
	    $rootScope.$on('buttonClicked', function($event, $formParams){
	    	$scope.formParams=$formParams;  //paso una variable "formParams" también a este controller
	    	$scope.callService(true);
	    	
	    });
	    
	    
    
    //$log.info("la página es " + $scope.page);
  
    
  }]);
  
  app.controller('ParameterController', ['$scope',  '$rootScope', function($scope, $rootScope){
	  $scope.formParams={};
	  
	  $scope.buttonClick=function(){
		  $rootScope.$broadcast('buttonClicked', $scope.formParams);
	  }
	  
	  $scope.reset=function(){
		  $scope.formParams={};
	  }	  
	  
  }]);  
  
  
//  app.controller('PicTableController', ['$scope',  function($scope){
//
//	  $scope.watch(function (){
//		  return $scope.page;
//	  }, function(newValue, oldValue){
//		  alert('new value=' + newValue);
////		  $scope.page  = newValue;
////		  var url='http://localhost/petzyngacms/svc/conector/dogBreeds.php/seleccionaNg';
//          //$log.info('page=' + $scope.page);
//	  
////		  $http.get(url, {'start': $scope.start}).
////		  success(function(data, status, headers, config) {
////			  $scope.tableData=data;
////		  }).
////		  error(function(data, status, headers, config) {
////			  alert('there was a problem');
////		  });
//	  });
//    
//  }]);  
  
  app.directive('lastDetectorDirective', function() {
	  return function(scope, element, attrs) {
	      if (scope.$last){
	      //window.alert("im the last!");
	      
	        $(".pictureContainerAlpha").click(function(){

	            var imageSource=$(this).find("img").attr("src");
	            ultimoNombreCodificado = $(this).find("div").attr("data-nombreCodificado");
	        	$("#ventanita #ventanitaImg").attr("src", imageSource);
	        	var dataString = 'nombreCodificado='+ ultimoNombreCodificado;
	        	var url= Global.dirCms + '/svc/conector/dogBreeds.php/obtienePorNombreCodificado';
	            $.ajax({
	            	  type: "POST", 
	                  url: url, 
	                  data: dataString,
	                  success: function(data){
	                	  var obj = jQuery.parseJSON( data );
	                      $("#derechaTitulo").html(obj.dogBreedName);
	                      $("#friendlyRank").attr("src", Global.dirCms  + "/resources/images/estrellas_"  + obj.friendlyRank + '.jpg');
	                      $("#activeRank").attr("src", Global.dirCms  + "/resources/images/estrellas_"  + obj.activeRank + '.jpg');
	                      $("#healthyRank").attr("src", Global.dirCms  + "/resources/images/estrellas_"  + obj.healthyRank + '.jpg');
	                      $("#guardianRank").attr("src", Global.dirCms  + "/resources/images/estrellas_"  + obj.guardianRank + '.jpg');
	                      $("#groomingRank").attr("src", Global.dirCms  + "/resources/images/estrellas_"  + obj.groomingRank + '.jpg');
	                  },
	                  error: function(XMLHttpRequest, textStatus, errorThrown) { 
	                        alert( " Status: " + textStatus); alert("Error: " + errorThrown); 
	                  }
	             });
	             $("#ventanita").fadeIn(600);
	           
	         });	      
	      
	      
	      
	    }
	  };
  });
  
  
  
})();