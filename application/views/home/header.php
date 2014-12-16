<?php require_once $GLOBALS['pathWeb']  . '/utils/Resources.php';?>
<!DOCTYPE html>
<html lang="en">
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

    
    <script src="jquery/external/jquery/jquery.js"></script>
    <script src="jquery/jquery-ui.js"></script>
    <link href="<?php echo URL; ?>jquery/jquery-ui.css" rel="stylesheet"/>
    
    <script>
      $(function() {
        $( "#lookForMe" ).autocomplete({
          source: Global.dirCms + "/svc/conector/dogBreeds.php/selNombres",
          username: 'nina',
          password: 'nina',
          minLength: 2,
          select: function( event, ui ) {
              $("#dogBreedInLookForMe").val(ui.item.nameEncoded);
          }
        });
      });

      function submitLookForMe(){
          var frm=document.frmLookForMe;
          var encoded=frm.dogBreedInLookForMe.value;
          if (!encoded){
            alert("Please type a dog breed name, or part of it");  
            return false; 
          }             
          var url="<?php echo URL . 'dogbreeds/info/'  ?>"+ encoded;
          frm.action=url;
          frm.submit();
      }
    </script>    
    
    
</head>
<body>
<?php include $GLOBALS['pathWeb'] . '/application/views/_templates/analyticstracking.php' ?>
<!-- header -->
<div id="container">
    <!-- Info -->
    <div style="height:235px">
        <img src="<?php echo URL; ?>public/img/logo_header_petzynga.jpg" />
    </div>

    <?php include 'application/views/_templates/menu.php'?>
    
    
    
    

