<?php include("add_task.php")

?>
<!doctype html>
<html lang="en">

<head>
  <title>To do list app</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main class="container">
    <br>
    <div class="card">
        <div class="card-header">
            TODO LIST
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                  <label for="task" class="form-label">Task:</label>
                  <input type="text"
                    class="form-control" name="task" id="task" aria-describedby="helpId" placeholder="Write your task">
                    <br>
                    <input name="add_task" id="add_task" class="btn btn-primary" type="button" value="Add Task">
                </div>
            </form>
        </div>

        <ul class="list-group">
          
          <li class="list-group-item">
              <input class="form-check-input float-start" type="checkbox" value="" id="" checked>
              &nbsp; <span class="float-start">&nbsp; task 1 </span>
                <h6 class="float-start">
                  &nbsp;<span class="badge bg-danger"> x </span>
                </h6>
            </li>

            <li class="list-group-item">
              <input class="form-check-input float-start" type="checkbox" value="" id="" checked>
              &nbsp; <span class="float-start">&nbsp; task 2 </span>
                <h6 class="float-start">
                  &nbsp;<span class="badge bg-danger"> x </span>
                </h6>
            </li>
            <li class="list-group-item">
              <input class="form-check-input float-start" type="checkbox" value="" id="" checked>
              &nbsp; <span class="float-start">&nbsp; task 3 </span>
                <h6 class="float-start">
                  &nbsp;<span class="badge bg-danger"> x </span>
                </h6>
            </li>
          </ul>
    </div>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>