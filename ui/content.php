<?php 
    session_start();
    
    require_once '../db.php';
    require_once 'functions.php';
    require_once 'crud.php';

    if (!isset($_SESSION['email'])) {
        echo "<script>
        alert('No has iniciado sessión')
        window.location.href = 'login.php';
     </script>";
    }

    if (isset($_SESSION['total'])) {
        $total = $_SESSION['total'];
    } else {
        $total = 0; // Si no hay un total en la sesión, mostrar 0
    }

?>  

<!DOCTYPE html>
<html>
<head>
    <title>Content</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
</head>
<body>

<?php 

// Tu console.log
if (isset($_SESSION['console'])) {
    echo $_SESSION['console'];
    unset($_SESSION['console']);
}
    ?>


<!-- Mensaje de bienvenida -->
<h1 class="text-center pt-3"> ¡Que gusto verte de vuelta!</h1>
    <h1 class="text-center mt-3"><?php echo $_SESSION['username'] . '👌'; ?></h1>

    <section class="container todolist">
      <h1 class="text-center m-3">Tu presupuesto $<?php echo number_format($total, 2);?><?
      if (isset($_SESSION['total'])) {
            echo "$" . number_format($_SESSION['total'], 2);
        } else {
            echo "no sirve";
        }?>
        </h1>
      <?php

    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
    ?>
      <form class='content-form' action="content.php" method="POST" class="text-center">
        <input type="number" name="amount" id="amount" placeholder="Escribe una cantidad" class="p-2">
        <input type="text" name="amount_name" id="amount_name" placeholder="Nombre de la cantidad" class="p-2">
        <input type="date" name="due_date" id="due_date" placeholder="Selecciona una fecha" class="p-2">
        <!-- <label for="tipo">Tipo:</label> -->
        <select name="amount_status" id="amount_status" class="p-2">
            <option value="2">Ingreso</option>
            <option value="1">Gasto</option>
        </select>

        <input type="submit" name="save_submit" value="GUARDAR" class="tl--save p-2">
      </form>

      <div class="table-wrapper mt-4">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Cantidad</th>
              <th>Nombre de la cantidad</th>
              <th>Fecha</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            <?php
                    // echo '<pre>'; 
                    // var_dump($_SESSION['rows']);
                    // echo '</pre>';

                    if ($_SESSION['rows']) {
                        foreach ($_SESSION['rows'] as $row) {
         
            ?>

            <?php
                // color de toda la fila
                    if (intval($row['amount_status'] === 1)) {
                        $background_status = 'bg-danger';
                    } else {
                        $background_status = 'bg-success';
                    }
            ?>
            <tr>
                <!-- Casilla de la cantidad -->
                <td class="<?php echo $background_status ?> text-center">
                    <?php echo $row['amount'];?>
                </td>        
                <!-- Casilla de nombre de la cantidad -->
                <td class="<?php echo $background_status ?> text-center">
                    <?php echo $row['amount_name'];?>
                </td>        
                <!-- Casilla de fecha -->
                <td class="<?php echo $background_status ?>">
                    <?php echo $row['due_date'];?>
                </td>        
                <td class="transparent">

                    <!-- delete button -->
                    <a class='delete btn btn-dark' href='?amountId=<?php echo $row['amount_id'] ?>'>Borrar</a>
                    
                    <!-- Status button -->
                    <a class='btn text-white <?php echo $background_status ?>' href='?keyStatus=<?php echo $row['amount_id'] ?>&amountStatus=<?php echo $row['amount_status'] ?>'>

                    <?php
                        if (intval($row['amount_status'] === 1)) {
                    ?>
                          Gasto
                    <?php
                        } else {
                    ?>
                          Ingreso
                    <?php
                        }
                    ?>

                    </a>
                </td>
            </tr>
            <?php
    }
    } else {
            ?>
            <tr>
            <td>No hay cantidades</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            </tr>
            <?php
    }

            ?>
          </tbody>
        </table>

            <p class="text-white text-center mt-3">
            ¿Te vas de este mundo?
                <a class="lf--forgot" href="close_session.php">Cerrar sesión</a>
            </p>
    </section>
</body>
</html>