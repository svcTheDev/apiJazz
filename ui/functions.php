<?php 
      function data_validation($data)
      {

          $data = trim($data);
          $data = htmlspecialchars($data);
          $data = stripslashes($data);

          $data = filter_var($data, FILTER_SANITIZE_EMAIL);
          return $data;
      }

      
      function show_message ($message, $type, $file) {
        $_SESSION['error'] = "<p class='bg-$type text-white text-center'>$message</p>";
        header("Location: $file.php");
        die();
        }

     

?>