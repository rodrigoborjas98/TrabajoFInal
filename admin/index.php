<?php
include 'includes/head.php';
require_once '../core/init.php';
include 'includes/navigation.php';

if(isset($_GET['finalizar'])){
  session_destroy();
}

if(!is_logged_in()){
  login_error_redirect();
}

?>
<hr>
<h2 class="text-center">Administrator Home</h2><hr>
<?php
 include 'includes/footer.php';?>
