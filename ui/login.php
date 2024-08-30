<?php 

    session_start();

    require_once '../db.php';
    require_once 'functions.php';

    if (isset($_GET['registrated'])) {
      echo $_SESSION['error'];
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // collect value of input field
      $email = data_validation($_POST['email']);
      $pass = data_validation($_POST['password']);
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $pass;
  
  
      if (empty($email) or empty($pass)) {
            show_message('Todos los campos son obligatorios', 'danger', 'login');
      } else {
          $statement = $db->prepare("SELECT * FROM users WHERE email = ?");
          $statement->bind_param('s', $email);
          $statement->execute();
          $result = $statement->get_result();
          
          
          // $loginResults = $result->fetch_all(MYSQLI_ASSOC);
          
          if ($db->affected_rows > 0) {
            $row = $result->FETCH_ASSOC();
            
            // Obtaining the id
              $_SESSION['user_id'] = $row['user_id'];
  
            // Validando el password
              $storedPassword = $row['password'];
  
         
  
              if (password_verify($pass, $storedPassword)) {
                  $_SESSION['username'] = $row['username'];
                  header("Location: content.php");
                  exit();
  
              } else {
                show_message('Contraseña inválida', 'danger', 'login');
              }
          } else {
              show_message('Usuario no existe', 'danger', 'login');
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
           Inicia sesión 🙂
</h1>

  <?php 
      if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
      }

  ?>

<form class='login-form' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
  <div class="flex-row">
    <label class="lf--label" for="email">
      <svg x="0px" y="0px" width="12px" height="13px">
        <path fill="#B1B7C4" d="M8.9,7.2C9,6.9,9,6.7,9,6.5v-4C9,1.1,7.9,0,6.5,0h-1C4.1,0,3,1.1,3,2.5v4c0,0.2,0,0.4,0.1,0.7 C1.3,7.8,0,9.5,0,11.5V13h12v-1.5C12,9.5,10.7,7.8,8.9,7.2z M4,2.5C4,1.7,4.7,1,5.5,1h1C7.3,1,8,1.7,8,2.5v4c0,0.2,0,0.4-0.1,0.6 l0.1,0L7.9,7.3C7.6,7.8,7.1,8.2,6.5,8.2h-1c-0.6,0-1.1-0.4-1.4-0.9L4.1,7.1l0.1,0C4,6.9,4,6.7,4,6.5V2.5z M11,12H1v-0.5 c0-1.6,1-2.9,2.4-3.4c0.5,0.7,1.2,1.1,2.1,1.1h1c0.8,0,1.6-0.4,2.1-1.1C10,8.5,11,9.9,11,11.5V12z"/>
      </svg>
    </label>
    <input id="email" class='lf--input' placeholder='Correo Electrónico' type='email' name="email">
  </div>
  <div class="flex-row">
    <label class="lf--label" for="password">
      <svg x="0px" y="0px" width="15px" height="5px">
        <g>
          <path fill="#B1B7C4" d="M6,2L6,2c0-1.1-1-2-2.1-2H2.1C1,0,0,0.9,0,2.1v0.8C0,4.1,1,5,2.1,5h1.7C5,5,6,4.1,6,2.9V3h5v1h1V3h1v2h1V3h1 V2H6z M5.1,2.9c0,0.7-0.6,1.2-1.3,1.2H2.1c-0.7,0-1.3-0.6-1.3-1.2V2.1c0-0.7,0.6-1.2,1.3-1.2h1.7c0.7,0,1.3,0.6,1.3,1.2V2.9z"/>
        </g>
      </svg>
    </label>
    <input id="password" class='lf--input' placeholder='Constraseña' type='password' name="password">
  </div>
  <input class='lf--submit' type='submit' name="login" value='INICIAR SESIÓN'>
</form>
<p class="text-white text-center mt-3">
      ¿No tienes una cuenta?
    <a class="lf--forgot" href="sign_up.php">Regístrate</a>
</p>
</body>
</html>


