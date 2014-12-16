<?php


//servidor live

// $GLOBALS['debug'] = false;
// $GLOBALS['env'] = 'live';
// global $usuario; $usuario ='petzynga_gonzalo';
// global $clave; $clave ='manuela';
// global $baseDeDatos; $baseDeDatos ='petzynga_live';
// $GLOBALS['raizCms'] ='/home1/petzynga/public_html/livecms';
// $GLOBALS['dirWeb'] ='';
// $GLOBALS['dirAplicacion'] ='/livecms';
// $GLOBALS['host'] ='petzynga.com';
// $GLOBALS['pathWeb'] = '/home1/petzynga/public_html';
// $GLOBALS['pathCms'] = '/home1/petzynga/public_html/livecms';

//servidor qa
//  $GLOBALS['debug'] = false;
//  $GLOBALS['env'] = 'qa';
//  global $usuario; $usuario ='petzynga_gonzalo';
//    global $clave; $clave ='manuela';
//    global $baseDeDatos; $baseDeDatos ='petzynga_cmsqa';
//    $GLOBALS['raizCms'] ='/home1/petzynga/public_html/qacms';
//    $GLOBALS['dirWeb'] ='/qaweb';
//    $GLOBALS['dirAplicacion'] ='/qacms';
//    $GLOBALS['host'] ='petzynga.com';
//    $GLOBALS['pathWeb'] = '/home1/petzynga/public_html/qaweb';
//    $GLOBALS['pathCms'] = '/home1/petzynga/public_html/qacms';



  //local
  $GLOBALS['debug'] = true;
  $GLOBALS['env'] = 'local';
  global $usuario; $usuario ='almarlam_gonzalo';
  global $clave; $clave ='manuela';
  global $baseDeDatos; $baseDeDatos ='petzynga';
  $GLOBALS['dirWeb'] ='/petzyngaweb';
  $GLOBALS['dirAplicacion'] ='/petzyngacms';
  $GLOBALS['host'] ='localhost';
  $GLOBALS['pathWeb'] = 'C:/xampp/htdocs/petzyngaweb';
  $GLOBALS['pathCms'] = 'C:/xampp/htdocs/petzyngacms';
  //require_once 'utils/Resources.php';
  
  //cache
  require_once("utils/phpfastcache/phpfastcache.php");
  phpFastCache::setup("storage","file");
  phpFastCache::setup("path", $GLOBALS['pathWeb']);       	
  //$cache = phpFastCache();
  

?>
