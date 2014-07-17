<div class="right">

  <br/>
  <br/>
  <img class="infoDetail" src='<?php echo  $GLOBALS['dirAplicacion']  . "/resources/images/shelterlogos/" . $info->getLogoUrl() ?>'>
  <br/>
  <br/>
  <div class="pictureTitleInfo"><?php echo $info->getName(); ?></div>
  <br/>
  <br/>
    <?php echo $info->getDescription(); ?> 
  <br/>
  <br/>
  <h1>Contact information</h1>
  <br/>
  <?php
    $phone = $info->getPhone();
    if (!empty($phone)){
      echo "Phone:" . $phone;
      echo "<br/>";
      echo "<br/>";
    }
  ?>
  <?php
    $email = $info->getEmail();
    if (!empty($email)){
      echo "Email:<a href='mailto:" . $email . "'>" . $email . "</a>";
      echo "<br/>";
      echo "<br/>";
    }
  ?>
  <?php
    $url = $info->getUrl();
    if (!empty($url)){
      echo "Website:<a href='" . $url . "'>" . $url . "</a>";
      echo "<br/>";
      echo "<br/>";
    }
  ?>
  <h2>Address</h2>
  <br/>
  <?php echo $info->getStreetAddress(); ?> 
  <br/>
  <?php echo $info->getCityName(); ?>,&nbsp;&nbsp;<?php echo $info->getStateName(); ?>&nbsp;&nbsp;<?php echo $info->getZip(); ?> 
  <br/>
  <br/>  
  <span class="navegacionPaginas">
	    <?php 
	      echo "  <a href='" . URL . "/sheltersusa'> << Back to List </a> \n";
	    ?>
  </span>
  
</div>
