<?php 

    include_once 'functions.php';

    showBudget($db);
    showTotal($db);


    // When clicking save
    if (isset($_POST["save_submit"]) && isset($_POST['amount']) && isset($_POST['due_date']) && isset($_POST['amount_name'])) {

        if (!empty($_POST['amount']) and !empty($_POST['due_date'])) {

            $amount = data_validation($_POST['amount']);
            $amount_name = $_POST['amount_name'];
            $amount_name = trim($amount_name);
            $amount_name = stripslashes($amount_name);
            $due_date = data_validation($_POST['due_date']);
            $amount_status = $_POST['amount_status'];

            // echo $amount;
            // echo $due_date;

            if (!preg_match("/^[a-zA-Z' :\-\d.]*$/", $amount) or !preg_match("/^[a-zA-Z' :\-\d]*$/", $due_date)) {
                show_message("Campo inválido : Solo letras y espacios en blanco permitidos", 'danger', 'content');
            } else {
                // Add amount
                $statement = $db->prepare("INSERT INTO budget (amount, amount_name, due_date, amount_status, user_id) 
                VALUES (?,?,?,?,?)");
                // $amount_status = 2;
                $user_id = $_SESSION['user_id'];
                $statement->bind_param('isssi', $amount, $amount_name, $due_date, $amount_status, $user_id);
                $statement->execute();  
    
                showBudget($db);

                showTotal($db);

                
                // $stmt2 = $db->prepare("INSERT INTO totals (total_balance, user_id)
                // VALUES (?,?)");
                // $stmt2->bind_param('ii', $amount, $user_id);
                // $stmt2->execute();
    
                header("Location: content.php");
                die();
            }

        } else {
            show_message('los dos campos son obligatorios', 'danger', 'content');
        }
    }

    // Show amount budget
    function showBudget($db) {
        $statement2 = $db->prepare('SELECT * FROM budget
        JOIN users ON budget.user_id = users.user_id
        WHERE users.user_id = ?');
        $user_id = $_SESSION['user_id'];
        $statement2->bind_param('i', $user_id);
        $statement2->execute();
        $result = $statement2->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $_SESSION['rows'] = $rows;
    }


    // Delete amount
    if (isset($_GET["amountId"])) {
        $statement = $db->prepare("DELETE FROM budget WHERE amount_id=?");
        $statement->bind_param("s", $_GET['amountId']);
        $statement->execute();
        showBudget($db);

        showTotal($db);

    }
    

    // Update amount
    if (isset($_GET["amountStatus"]) and isset($_GET["keyStatus"])) {
        
        if (intval($_GET["amountStatus"]) === 1) {
            $amount_status = 2;
        } else {
            $amount_status = 1;
        }

        $statement = $db->prepare("UPDATE budget SET amount_status=? WHERE amount_id=?");
        $statement->bind_param("is", $amount_status, $_GET['keyStatus']);
        $statement->execute();

        showBudget($db);
        showTotal($db);

}

    // calculate total
    function showTotal($db) {
        $user_id = $_SESSION['user_id'];
        $amount_status = 1;
        $balanceDB = $db->prepare("SELECT SUM(CASE
                                                WHEN amount_status = 2 THEN amount
                                                WHEN amount_status = 1 THEN -amount
                                                END) AS total
                                        FROM budget
                                        WHERE user_id = ?");

        // amount) AS total FROM budget WHERE user_id = ?");
        $balanceDB->bind_param('i', $user_id);
        $balanceDB->execute();

        $result_total = $balanceDB->get_result();
        $balanceRow = $result_total->fetch_assoc();
        $total = $balanceRow['total'];
        
        $_SESSION['total'] = $total;

        showBudget($db);
    }
       
?>  