<?php
/**Constanten voor Siteroot**/
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'C:' . DS . 'wamp64' . DS . 'www' . DS  . 'webshop2');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');
defined('IMAGES_PATH') ? null : define('IMAGES_PATH', SITE_ROOT . DS . 'admin' . DS . 'img');
?>

<?php require_once ("config.php"); ?>
<?php require_once ("Database.php"); ?>
<?php require_once ("functions.php"); ?>
<?php require_once ("Db_object.php") ?>
<?php require_once ("Session.php"); ?>
<?php require_once ("Customer.php");?>
<?php require_once ("Admin.php"); ?>
<?php require_once ("Super_category.php"); ?>
<?php require_once ("Category.php");?>
<?php  require_once ("Sub_category.php");?>
<?php require_once ("Photo.php"); ?>
<?php require_once ("Product.php"); ?>



