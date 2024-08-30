<?php 

    session_start();

    require_once '../db.php';
    require_once 'functions.php';



    if (isset($_POST['register'])) {
      $username = data_validation($_POST['username']);
      $new_email = data_validation($_POST['new_email']);
      $new_password = data_validation($_POST['new_password']);
      $repeated_password = data_validation($_POST['repeated_password']);
      
      
      if (empty($new_email) or empty($new_password) or empty($repeated_password) or empty($username)) {
        show_message("Todos los campos son obligatorios", 'danger', 'sign_up');
      }
      
      if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        show_message('Email inválido', 'danger', 'sign_up');
      } 
      
      if ($new_password !== $repeated_password) {
        show_message('Las contraseñas no son iguales', 'danger', 'sign_up');
      } else {
        // Verificando si el usuario existe
        
        $statement = $db->prepare("SELECT email FROM users WHERE email=?");
        $statement->bind_param("s", $new_email);
        $statement->execute();
        
        $result = $statement->get_result();
        
        if ($db->affected_rows > 0) {
          show_message('Correo ya existe', 'danger', 'sign_up');
      
        } else {
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $statement = $db->prepare("INSERT INTO users (username, email, password)  VALUES (?,?,?)");
            $statement->bind_param('sss', $username, $new_email, $new_password);
            $statement->execute();
  
            header("Location: login.php?registration");
            die();
          }
      }
  }
    
?>

<!DOCTYPE html>
<html>
<head>
  
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
</head>
<body>

<h1 class="text-white text-center mt-3">
           Regístrate 😎
</h1>

<?php 
 if (isset($_SESSION['error'])) {
  echo $_SESSION['error'];
  unset($_SESSION['error']);
 }

?>

<form class='login-form' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
  <div class="flex-row">
    <label class="lf--label" for="username">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
        </svg>
    </label>
    <input id="username" class='lf--input' placeholder='Nombre de usuario
    
    ' type='text' name="username">
  </div>
  <div class="flex-row">
    <label class="lf--label" for="email">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
        </svg>
    </label>
    <input id="email" class='lf--input' placeholder='Correo Electrónico' type='email' name="new_email">
  </div>
  <div class="flex-row">
    <label class="lf--label" for="password">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
        </svg>
    </label>
    <input id="password" class='lf--input' placeholder='Constraseña' type='password' name="new_password">
  </div>
  <div class="flex-row">
    <label class="lf--label" for="repeat-password">
    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
        </svg>
    </label>
    <input id="password" class='lf--input' placeholder='Repetir contraseña' type='password' name="repeated_password">
  </div>
  <input class='lf--submit' type='submit' name="register" value='CREAR USUARIO'>
</form>
<p class="text-white text-center mt-3">
      ¿Ya tienes una cuenta?
    <a class="lf--forgot" href="login.php">Inicia sesión</a>
</p>
</body>
</html>