<?php
 require $_SERVER['DOCUMENT_ROOT'].'/TrabajoFinal/core/init.php';
include 'includes/head.php';

$email= ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email= trim($email);

$password= ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password= trim($password);

$errors= array();

?>
<style >
  body{
    background-image: url("/TrabajoFinal/image/logoHeader/download.jpg");
    background-size: 100vw 100vh;
  }
</style>

<div id="login-form">
  <h2 class="text-center">LOGIN</h2>
  <div>
    <?php
    if($_POST){
      //form validation
      if(empty($_POST['email'])||empty($_POST['password'])){
        $errors[] .="Debes de ingresar el email y la contrasena.";
      }

      //email InvalidArgumentException
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] .="Debes de ingresar un mail válido.";
      }

      //password is more than 6 characters
      if(strlen($password)<6){
        $errors[] .="La contrasena debe tener al menos 6 caracteres.";
      }
      //Check if email exists in db
      $query = $db->query("SELECT * FROM cumbrescampweb.users WHERE u_correo = '$email'");
      $user=  mysqli_fetch_assoc($query);
      $userCount = mysqli_num_rows($query);

      if($userCount<1){
        $errors[] .="El email y/o contrasena no coinciden.";
      }

      //inverse process of hashing, verifying it's correct the passw
      if(!password_verify($password,$user['u_contrasena'])){
        $errors[] .="La contrasena no coincide con la base de datos.";
      }

      //Final Decision
      if(!empty($errors)){
        echo display_errors($errors);
      }else{
        //login
        echo "The user has logged in!";
        $user_id =$user['id_usuario'];
        login($user_id,"index.php");
      }

    }

     ?>

  </div>

  <form action="login.php" method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email"
      class="form-control" value="<?=$email;?>">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password"
      class="form-control" value="<?=$password;?>">
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-success" name="botoPresionado" value="Login">
    </div>
    <div class="form-group text-center">
       <a href="signup.php">¿No tienes una cuenta?</a>
       <a href= "/TrabajoFinal/index.php" class="text-success" alt="home">Visit Site</a>
    </div>
  </form>

</div>
<?php include 'includes/footer.php';?>
