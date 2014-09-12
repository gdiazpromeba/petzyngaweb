<div class="centroNews">

<?php foreach ($news as $bean) { 

    $href= URL . "latestnews/info/" . $bean->getUrlEncoded(); 
    ?>
    
    <div class="newsContainer">
      <div class="newsTitle">
        <?php
          echo "<a href='" . $href  . "'>" . $bean->getNewsTitle() . "</a> \n";
         ?>
      </div><!-- title -->
      <div class="newsSource">
        <?php
          echo $bean->getNewsSource();
         ?>
      </div><!-- Source -->
      <div class="newsContent">
        <?php
          echo $bean->getNewsText();
         ?>
         <div class="newsSource" style="display: inline">
           <?php
            echo "<a href='" . $href .  "'>Read more ...</a> \n";
           ?>
         </div><!-- el read more -->      
      </div><!-- newsContent -->
    </div><!-- newsContainer -->
    
  <?php } ?>    

</div>   