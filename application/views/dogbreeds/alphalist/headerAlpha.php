<?php require_once $GLOBALS['pathWeb']  . '/utils/Resources.php';?>
<!DOCTYPE html>
<html lang="en"  ng-app="breedsAlpha">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dog Breeds</title>
    <meta name="description" content="<?php echo Resources::getText('meta_description_dog_breeds'); ?>" />
    <meta name="keywords" content="<?php echo Resources::getText('meta_keywords_dog_breeds'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/estilo.css" rel="stylesheet"/>
    <link href="<?php echo URL; ?>public/css/estiloDogBreeds.css" rel="stylesheet"/>
    <?php if ($GLOBALS['env']=="qa") echo  "<link href='" . URL . "public/css/estiloQa.css' rel='stylesheet'/> "; ?>
    
    <script src="<?php echo URL; ?>jquery/external/jquery/jquery.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.min.js"></script>
	<script src="<?php echo URL; ?>/application/views/dogbreeds/alphalist/breedsAlpha.js"></script> 
    
    
    
    
</head>
<body>
<?php include $GLOBALS['pathWeb'] . '/application/views/_templates/analyticstracking.php' ?>
<!-- header -->
<div id="container">
    <!-- Info -->
    <div style="height:155px">
        <img src="<?php echo URL; ?>public/img/nuevologo_.jpg" />
    </div>
    <?php include  'application/views/_templates/menu.php' ?>
    
