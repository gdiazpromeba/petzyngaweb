<div class="centroNews">

<?php foreach ($news as $bean) { ?>

    <div class="newsContainer">
      <div class="newsTitle">
        <?php
          echo $bean->getNewsTitle();
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
            echo "Read more ...";
           ?>
         </div><!-- el read more -->      
      </div><!-- newsContent -->
    </div><!-- newsContainer -->
    
  <?php } ?>    

</div>   