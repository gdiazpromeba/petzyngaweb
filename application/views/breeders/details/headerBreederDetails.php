<!DOCTYPE html>
<html lang="en"  ng-app="geoFlatList">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Petzynga</title>
    <meta name="description" content="<?php echo $info->getMetaDescripcion(); ?>" />
    <meta name="keywords" content="<?php echo $info->getMetaKeywords();  ?>" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/estilo.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/estiloShelters.css" rel="stylesheet">
    <?php if ($GLOBALS['env']=="qa") echo  "<link href='" . URL . "public/css/estiloQa.css' rel='stylesheet'/> "; ?>  
    
    <?php require_once 'configJs.php';?> 
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.min.js"></script>
    <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->
    <script src="https://rawgithub.com/gsklee/ngStorage/master/ngStorage.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBALS['dirWeb']; ?>/application/views/breeders/breeders.js"></script>    
     
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
