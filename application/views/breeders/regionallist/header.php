<?php require_once $GLOBALS['pathWeb']  . '/utils/Resources.php';?>
<!DOCTYPE html>
<html lang="en" ng-app="geoFlatList">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Petzynga</title>
    <meta name="description" content="<?php echo Resources::getText($metaDescriptionKey); ?>" />
    <meta name="keywords" content="<?php echo Resources::getText($metaKeywordsKey); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/estilo.css" rel="stylesheet"/>
    <link href="<?php echo URL; ?>public/css/estiloShelters.css" rel="stylesheet"/>
    <?php if ($GLOBALS['env']=="qa") echo  "<link href='" . URL . "public/css/estiloQa.css' rel='stylesheet'/> "; ?>
    
    <!--  google maps -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <?php require_once 'configJs.php';?> 

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>  
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.min.js"></script>
    <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->
    <script type="text/javascript" src="<?php echo $GLOBALS['dirWeb']; ?>/application/views/breeders/regionallist/app.js"></script>        
    
   
    
<style>
.ui-menu .ui-menu-item {
    font-size: small;
    text-align: left;
}
</style>     
   
</head>
<body>
<?php include $GLOBALS['pathWeb'] . '/application/views/_templates/analyticstracking.php' ?>
<!-- header -->
<div id="container">
    <!-- Info -->
    <div style="height:155px">
        <img src="<?php echo URL; ?>public/img/nuevologo_.jpg" />
    </div>
    <?php include 'application/views/_templates/menu.php'?>
