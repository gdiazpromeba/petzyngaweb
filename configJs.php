
<script type="text/javascript">
var Global={};
<?php
if ($GLOBALS['debug']){
?>
 Global.dirAplicacion = '/petzyngaweb';
<?php	
}else{
?>
  Global.dirAplicacion = '/qaweb';
<?php	
}
?>
</script>