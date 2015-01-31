 <?php require_once 'utils/Resources.php';?>
<div id="columnaCentralAvanzada">
    <!-- pequeño form y javascript para invocar la pantalla de detalle con un parámetro "start" como post -->
    <form name="frmNavegacion" action="" method="post">
      <input type="hidden" name="start" value="<?php echo $_REQUEST['start']; ?>" />
      <input type="hidden" name="firstArea" value="<?php echo $_REQUEST['firstArea']; ?>" />      
      <input type="hidden" name="secondArea" value="<?php echo $_REQUEST['secondArea']; ?>" />
      <input type="hidden" name="zipCode"   value="<?php echo $_REQUEST['zipCode']; ?>" />
      <input type="hidden" name="breederName" value="<?php echo $_REQUEST['breederName']; ?>" />
      <input type="hidden" name="country" id="country" value="<?php echo $_REQUEST['country']; ?>" />
      
    </form>
    <script type="text/javascript">
      function navega(url){
        document.frmNavegacion.action=url;
        document.frmNavegacion.submit();
      }

    </script>

    <div class="descriptiveParagraph2">
      <b><?php echo Resources::getText($headerTitleKey); ?></b>
      <br/>
      <?php echo Resources::getText($headerTextKey); ?>
    </div>
	<?php include 'formBusqueda.php'?>
	
    <div>
    <br/>
    <br/>
   
   
              <table class="regionalTable" id="regionalTable">
                <tbody></tbody>
              </table>
    </div>
    
	<div class="gigantic pagination">
	    <a href="#" class="first" data-action="first">&laquo;</a>
	    <a href="#" class="previous" data-action="previous">&lsaquo;</a>
	     <input type="text" readonly="readonly" data-max-page="40" />
	    <a href="#" class="next" data-action="next">&rsaquo;</a>
	    <a href="#" class="last" data-action="last">&raquo;</a>
	</div>    

</div>
