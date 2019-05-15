<?php
function display_errors($errors){
  $display= '<ul class="bg-danger">';
  foreach ($errors as $error) {
    $display .= '<li class="text-light">'.$error.'</li>';
  }
  $display.= '</ul>';
  return $display;
}
function sanitize($dirty){
  return htmlentities($dirty, ENT_QUOTES,"UTF-8");
}

function login($user_id, $url){
  $_SESSION['SBUser']=$user_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $db->query("UPDATE cumbrescampweb.users SET u_lastLogin ='$date' WHERE id_usuario= '$user_id'");
  $_SESSION['success_flash']='You are now logged in!';
  header('Location:'.$url);
}
function signup_successfully($url="login.php"){
  $_SESSION['success_flash']="User signed up correctly.";
  header('Location: '.$url);
}
function item_add(){
  $_SESSION['success_flash']="Item Added to Cart.";
}
function is_logged_in(){
  if(isset($_SESSION['SBUser'])&&$_SESSION['SBUser']>0){
    return true;
  }
  return false;
}

function login_error_redirect($url = 'login.php'){
  $_SESSION['error_flash']="Debes hacer login para acceder a esta página.";
  header('Location: '.$url);
}

function permission_error_redirect($url="login.php"){
  $_SESSION['error_flash']="No tienes permiso para acceder a la página.";
  header('Location: '.$url);
}

function has_permission($permission){
  global $user_data;
  $permissions = explode('.',$user_data['permissions']);
  if(in_array($permission,$permissions,true)){
    return true;
  }
  return false;
}

 ?>
