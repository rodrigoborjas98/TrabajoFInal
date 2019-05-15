<?php
 require $_SERVER['DOCUMENT_ROOT'].'/TrabajoFinal/core/init.php';
include 'includes/head.php';

$email= ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email= trim($email);

$password= ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password= trim($password);

$fullname= ((isset($_POST['fullname']))?sanitize($_POST['fullname']):'');
$fullname= trim($fullname);

$birthday= ((isset($_POST['birthday']))?sanitize($_POST['birthday']):'');
$birthday= trim($birthday);

$cardnumber= ((isset($_POST['cardnumber']))?sanitize($_POST['cardnumber']):'');
$cardnumber= trim($cardnumber);

$postalcode= ((isset($_POST['postalcode']))?sanitize($_POST['postalcode']):'');
$postalcode= trim($postalcode);


$errors= array();

?>
<style >
  body{
    background-color: grey;
    /* background-image: url("/TrabajoFinal/image/logoHeader/download.jpg"); */
    background-size: 100vw 100vh;
  }
</style>

<div id="login-form">
  <h2 class="text-center">SIGN-UP</h2>
  <div>

    <?php
    if($_POST){
      //form validation
      if(empty($_POST['email'])){
        $errors[] .="Debes de ingresar el email.";
      }
      if(empty($_POST['password'])){
        $errors[] .="Debes de ingresar una contrasena.";
      }
      if(empty($_POST['fullname'])){
        $errors[] .="Debes de ingresar el Nombre Completo.";
      }
      if(empty($_POST['birthday'])){
        $errors[] .="Debes de ingresar la fecha de nacimiento.";
      }
      if(empty($_POST['cardnumber'])){
        $errors[] .="Debes de ingresar el número de tarjeta.";
      }
      if(empty($_POST['postalcode'])){
        $errors[] .="Debes de ingresar el código postal.";
      }

      //password is more than 6 characters
      if(strlen($password)<6){
        $errors[] .="La contrasena debe tener al menos 6 caracteres.";
      }
      //Check if email exists in db
      $query = $db->query("SELECT * FROM cumbrescampweb.users WHERE u_correo = '$email'");
      $user=  mysqli_fetch_assoc($query);
      $userCount = mysqli_num_rows($query);

      if($userCount>0){
        $errors[] .="Ya hay una cuenta asociada con este email. Por favor, cambiela.";
      }

      //Final Decision
      if(!empty($errors)){
        echo display_errors($errors);
      }else{
        //login
        $password= password_hash($password, PASSWORD_DEFAULT);
        $date= date("Y-m-d H:i:s");
        $query = "INSERT INTO cumbrescampweb.users
        (u_correo, u_contrasena, u_nombreCompleto,
          u_fechaNacimiento, u_numeroTarjetaBancaria, u_cp, u_joinDate
          )
           VALUES (
              '$email','$password',
              '$fullname','$birthday',
              '$cardnumber','$postalcode','$date')
        ";
        $db->query($query);
        signup_successfully();
      }

    }

     ?>

  </div>

  <form action="signup.php" method="post">
    <!-- email field -->
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email"
      class="form-control" value="<?=$email;?>">
    </div>
    <!-- password field -->
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password"
      class="form-control" value="<?=$password;?>">
    </div>
    <!-- Full Name field -->
    <div class="form-group">
      <label for="fullname">Nombre Completo:</label>
      <input type="fullname" name="fullname" id="fullname"
      class="form-control" value="<?=$fullname;?>">
    </div>
    <!-- Date of birth field -->
    <div class="form-group">
      <label for="birthday">Fecha de Nacimiento:</label>
      <input type="date" name="birthday" id="birthday"
      class="form-control" value="<?=$birthday;?>">
    </div>
    <!-- Card number field -->
    <div class="form-group">
      <label for="birthday">Número de Tarjeta:</label>
      <input type="number" name="cardnumber" id="cardnumber"
      class="form-control" value="<?=$cardnumber;?>">
    </div>
    <!-- postal code field -->
    <div class="form-group">
      <label for="pc">Código Postal:</label>
      <input type="number" name="postalcode" id="postalcode"
      class="form-control" value="<?=$postalcode;?>">
    </div>

    <!-- Submit button -->
    <div class="form-group text-center">
       <input type="submit" class="btn btn-success" name="botoPresionado" value="Login">
    </div>
    <div class="form-group text-center">
       <a href="login.php">¿Ya tienes una cuenta?</a>
       <a href= "/TrabajoFinal/index.php" class="text-success" alt="home">Visit Site</a>

    </div>
  </form>
</div>
<?php include 'includes/footer.php';?>
