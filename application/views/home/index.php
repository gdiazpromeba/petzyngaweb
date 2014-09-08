<div id="right">
    <br/>
    <div class="tituloBusqueda">News</div>
    <div class="newsContainer">
      <div class="newsTitle">
        <?php
          echo $bean->getNews1Title();
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
            echo "Read more ...";
           ?>
         </div><!-- el read more -->      
      </div><!-- newsContent -->
    </div><!-- newsContainer -->
    
    <div class="newsContainer">
      <div class="newsTitle">
        <?php
          echo $bean->getNews2Title();
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
            echo "Read more ...";
           ?>
         </div><!-- el read more -->      
      </div><!-- newsContent -->
    </div><!-- newsContainer -->
    
    
</div><!-- id=right -->


