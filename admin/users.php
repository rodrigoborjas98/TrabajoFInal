<?php
include 'includes/head.php';
include 'includes/navigation.php';
require_once '../core/init.php';

if(!has_permission('admin')){
  permission_error_redirect('index.php');
}

if(!is_logged_in()){
  login_error_redirect();
}
?>
users
<?php
 include 'includes/footer.php';?>
