<?php require_once $GLOBALS['pathWeb']  . '/utils/Resources.php';?>
<!DOCTYPE html>
<html lang="en" ng-app="homeApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Petzynga</title>
    <meta name="description" content="<?php echo Resources::getText('meta_description_homepage'); ?>" />
    <meta name="keywords" content="<?php echo Resources::getText('meta_keywords_homepage'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php require_once 'configJs.php';?>
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/estilo.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/estiloPortlets.css" rel="stylesheet">
    <?php if ($GLOBALS['env']=="qa") echo  "<link href='" . URL . "public/css/estiloQa.css' rel='stylesheet'/> "; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.min.js"></script>
    <script type="text/javascript" src="<?php echo $GLOBALS['dirWeb']; ?>/application/views/home/homeApp.js"></script> 	 
    
    
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
    
    
    
    

