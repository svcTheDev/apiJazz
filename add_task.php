<?php 
    require_once 'db.php';

    // try {
    //     $sql = "SELECT * FROM users WHERE email = '${email}'";
    //     mysqli_query($db, $sql);
    //     mysqli_fetch_all();
    //     var_dump();

    // } catch (\Throwable $th) {
    //     throw $th;
    // }
?>

<?php 
        if (isset($_SESSION['console'])) {
            echo $_SESSION['console'];
            unset($_SESSION['console']);
        }


    ?>

    

    <h1 class="text-white text-center mt-3">
                ¡Hola! <?php 
                echo $_SESSION['user'];

                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
    </h1>


    <form class='login-form' action="content.php" method="POST">
    <div class="flex-row">
        <label class="lf--label" for="init">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z"/>
        </svg>

        </label>
        <input id="init" class='lf--input' placeholder='Initial budget' type='number' name="init">
    </div>
        <input class='lf--submit' name="save_submit" type='submit' value='Agregar'>

        <?php 
        if ($_SESSION['rows']) {
            
        ?>
                <p> Budget actual: <?php echo $_SESSION['rows'][0]['Init'] ?>  
                    <a class='delete btn btn-dark' href='content.php'>Borrar</a>
                </p>
        <?php 

            } else {   
        ?>
                <p>Presupuesto actual: 0</p>
        <?php 
        
            }
        ?>        
        
        
    </form>

    

    <p class="text-white text-center mt-3">
        ¿Te vas de este mundo?
        <a class="lf--forgot" href="close_session.php">Cerrar sesión</a>
    </p>