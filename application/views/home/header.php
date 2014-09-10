<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Petzynga</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php require_once 'configJs.php';?>
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/estilo.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/estiloNews.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/estiloScriplets.css" rel="stylesheet">
    
</head>
<body>
<!-- header -->
<div id="container">
    <!-- Info -->
    <div style="height:155px">
        <img src="<?php echo URL; ?>public/img/nuevologo_.jpg" />
    </div>
    <div class="navigation-div">
       <span class="menuItem"><a href="<?php echo URL; ?>">HOME</a></span>
       <span class="menuItem"><a href="<?php echo URL; ?>dogbreeds/">DOG BREEDS</a></span>
       <span class="menuItem"><a href="<?php echo URL; ?>shelters/countries">SHELTERS</a></span>
    </div>
    
    <div class="left">
      
      <div class="portletLeft">
        Enter your ZIP code
        <form action="<?php echo URL; ?>shelters/listing/usa/initial" method="POST">
          <input class="busquedaZipPortlet" name="zipCode" type="text" /><input type="submit" value="Go"/>
        </form>
        to find Dog Shelters near you!
      </div>

      <br/>
      
      <div class="portletLeft">
        Look for your favorite Dog Breed
        <form action="<?php echo URL . 'dogbreeds/index'  ?>" method="POST">
          <input class="busquedaInput" type="text" name="nombreOParte"  />
          <input type="submit" value="Go"/>
        </form>
        (just type the name, or a part of it)
      </div>
      
    </div><!--end left-->
