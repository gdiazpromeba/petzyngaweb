<?php require_once 'utils/Resources.php';?>

<div class="siteDescription">
      <?php echo Resources::getText('home_page_content'); ?>
</div>


<div class="centro">
    
    <div class="tituloSeccionNews">News</div>
    <div class="newsContainer">
      <div class="newsTitle">
        <?php
          $hrefNews1= URL . "latestnews/info/" . $bean->getNews1UrlEncoded();
          echo "<a href='" . $hrefNews1  . "'>" . $bean->getNews1Title() . "</a> \n";
         ?>
      </div><!-- title -->
      <div class="newsSource">
        <?php
          echo $bean->getNews1Source();
         ?>
      </div><!-- Source -->
      <div class="newsContent">
        <?php
          echo $bean->getNews1Text();
         ?>
         <div class="newsSource" style="display: inline">
           <?php
            echo "<a href='" . $hrefNews1  . "'>Read more ...</a> \n";
           ?>
         </div><!-- el read more -->      
      </div><!-- newsContent -->
    </div><!-- newsContainer -->
    
    <div class="newsContainer">
      <div class="newsTitle">
        <?php
          $hrefNews2= URL . "latestnews/info/" . $bean->getNews2UrlEncoded();
          echo "<a href='" . $hrefNews2  . "'>" . $bean->getNews2Title() . "</a> \n";
         ?>
      </div><!-- title -->
      <div class="newsSource">
        <?php
          echo $bean->getNews2Source();
         ?>
      </div><!-- Source -->
      <div class="newsContent">
        <?php
          echo $bean->getNews2Text();
         ?>
         <div class="newsSource" style="display: inline">
           <?php
            echo "<a href='" . $hrefNews2  . "'>Read more ...</a> \n";
           ?>
         </div><!-- el read more -->      
      </div><!-- newsContent -->
    </div><!-- newsContainer -->
    
    
  <div class="tituloSeccionNews">Videos of the week</div>
    <div class="videoWrapper">
      <div style="height:6px"/>&nbsp;</div>
      <iframe width='297' height='221' src='http://www.youtube.com/embed/<?php echo $bean->getVideo1Url();?>' frameborder='0' allowfullscreen></iframe>
      <iframe width='297' height='221' src='http://www.youtube.com/embed/<?php echo $bean->getVideo2Url();?>' frameborder='0' allowfullscreen></iframe>
      <iframe width='297' height='221' src='http://www.youtube.com/embed/<?php echo $bean->getVideo3Url();?>' frameborder='0' allowfullscreen></iframe>
  </div>
    
    <div class="tituloSeccionNews">Featured Breeds</div>

    <table class='homePicturesTable'>
        <tr>
          <td class='tdPictureContainer'>
            <a href='<?php echo URL;?>dogbreeds/info/<?php echo str_replace(" ", "_", $bean->getDogBreed1Name()); ?>'>
              <table class='pictureInternalTable'>
                <tr><td class='pictureTitle'><?php echo $bean->getDogBreed1Name(); ?></td></tr>
                <tr><td><img class='breedImage' src='<?php  echo $GLOBALS['dirAplicacion']; ?>/resources/images/breeds/<?php echo $bean->getDogBreed1Picture(); ?>'></td></tr>
              </table>
            </a>
          </td>
          <td class='tdPictureContainer'>
            <a href='<?php echo URL;?>dogbreeds/info/<?php echo str_replace(" ", "_", $bean->getDogBreed2Name()); ?>'>
              <table class='pictureInternalTable'>
                <tr><td class='pictureTitle'><?php echo $bean->getDogBreed2Name(); ?></td></tr>
                <tr><td><img class='breedImage' src='<?php  echo $GLOBALS['dirAplicacion']; ?>/resources/images/breeds/<?php echo $bean->getDogBreed2Picture(); ?>'></td></tr>
              </table>
            </a>
          </td>
          <td class='tdPictureContainer'>
            <a href='<?php echo URL;?>dogbreeds/info/<?php echo str_replace(" ", "_", $bean->getDogBreed3Name()); ?>'>
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


