<?php require_once 'utils/Resources.php';?>

<div class="siteDescription">
      <?php echo Resources::getText('home_page_content'); ?>
      
      <div style="float:right;padding-right:3px">
        <img src="public/img/look_for_me.gif" style="width:150px"/>
        <form action="<?php echo URL . 'dogbreeds/index'  ?>" method="POST" name="frmLookForMe">
          <input class="busquedaInput" type="text" name="lookForMe" id="lookForMe"  style="color: gray;width:180px" placeholder="(e.g. Labrador)"/>
          <input type="hidden" name="dogBreedInLookForMe" id="dogBreedInLookForMe"/>
          <input type="button" value="Go" onclick="javascript:submitLookForMe()"/>
        </form>
      </div> 
</div>


<div class="centro">
    
 
    
    
  <div class="tituloSeccion">Videos of the week</div>
    <div class="videoWrapper">
      <div style="height:6px"/>&nbsp;</div>
      <iframe width='297' height='221' src='http://www.youtube.com/embed/<?php echo $bean->getVideo1Url();?>' frameborder='0' allowfullscreen></iframe>
      <iframe width='297' height='221' src='http://www.youtube.com/embed/<?php echo $bean->getVideo2Url();?>' frameborder='0' allowfullscreen></iframe>
      <iframe width='297' height='221' src='http://www.youtube.com/embed/<?php echo $bean->getVideo3Url();?>' frameborder='0' allowfullscreen></iframe>
  </div>
    
    <div class="tituloSeccion">Featured Breeds</div>

    <table class='homePicturesTable' width="100%">
        <tr>
          <td class='tdPictureContainer'>
            <a href='<?php echo URL;?>dogbreeds/info/<?php echo $bean->getDogBreed1NameEncoded(); ?>'>
              <table class='pictureInternalTable'>
                <tr><td class='pictureTitle'><?php echo $bean->getDogBreed1Name(); ?></td></tr>
                <tr><td><img class='breedImage' src='<?php  echo $GLOBALS['dirAplicacion']; ?>/resources/images/breeds/<?php echo $bean->getDogBreed1Picture(); ?>'></td></tr>
              </table>
            </a>
          </td>
          <td class='tdPictureContainer'>
            <a href='<?php echo URL;?>dogbreeds/info/<?php echo $bean->getDogBreed2NameEncoded(); ?>'>
              <table class='pictureInternalTable'>
                <tr><td class='pictureTitle'><?php echo $bean->getDogBreed2Name(); ?></td></tr>
                <tr><td><img class='breedImage' src='<?php  echo $GLOBALS['dirAplicacion']; ?>/resources/images/breeds/<?php echo $bean->getDogBreed2Picture(); ?>'></td></tr>
              </table>
            </a>
          </td>
          <td class='tdPictureContainer'>
            <a href='<?php echo URL;?>dogbreeds/info/<?php echo $bean->getDogBreed3NameEncoded(); ?>'>
              <table class='pictureInternalTable'>
                <tr><td class='pictureTitle'><?php echo $bean->getDogBreed3Name(); ?></td></tr>
                <tr><td><img class='breedImage' src='<?php  echo $GLOBALS['dirAplicacion']; ?>/resources/images/breeds/<?php echo $bean->getDogBreed3Picture(); ?>'></td></tr>
              </table>
            </a>
          </td>
        </tr>
    </table>
    
    <div id="footer">Copyright &copy; 2014 Petzynga </div>

</div><!-- de centro -->    


