<div class="costado">
      
  
      <div class="portletCostado">
        Enter your ZIP code
        <form action="<?php echo URL; ?>shelters/listing/usa/initial" method="POST">
          <input class="busquedaZipPortlet" name="zipCode" type="text" /><input type="submit" value="Go"/>
        </form>
        to find Dog Shelters near you!
      </div>

      <br/>
      
      <div class="portletCostado">
        Look for your favorite Dog Breed
        <form action="<?php echo URL . 'dogbreeds/index'  ?>" method="POST">
          <input class="busquedaInput" type="text" name="nombreOParte"  />
          <input type="submit" value="Go"/>
        </form>
        (just type the name, or a part of it)
      </div>
      
</div>
