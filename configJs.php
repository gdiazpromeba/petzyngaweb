
<script type="text/javascript">
var Global={};
<?php
if ($GLOBALS['debug']){
?>
 Global.dirAplicacion = '/petzyngaweb';
 Global.dirCms = '/petzyngacms';
<?php	
}else{
?>
  Global.dirAplicacion = '/qaweb';
  Global.dirCms = '/qacms';
<?php	
}
?>
</script>