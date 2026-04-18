<?php
$con = mysqli_connect("localhost", "root", "", "to-do");
if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $priority = $_POST['priority'] ?? '';
    $due_date = $_POST['due_date'] ?? '';

    $stmt = $con->prepare("INSERT INTO tasks (title, description, priority, due_date, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("ssss", $title, $description, $priority, $due_date);

    if ($stmt->execute()) {
        echo "<script>alert ('New task added successfully');
        window.location.href='display.php';
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>to-do task app</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body{
            background-color: lightgray
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn:hover {
            background-color: #0056b3;
            color: white;
        }
         .navbar-brand img {
            border-radius: 50%;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        #grad1 {
            background-color: red; /* For browsers that do not support gradients */
            background-image: linear-gradient(to right, red , yellow);
        }
        /* #grad {
            background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(255,0,0,1));
        } */
    </style>

</head>
<body >
    <!-- Just an image -->
    <nav class="sticky-top navbar navbar-light bg-dark">
        <a class="navbar-brand p-2" href="#">
            <img src="logo.jpg" width="50" height="50" alt="">
        </a>
        <h2 class="text-center" style="color: white;">To-Do Task App</h2>
    </nav>

    <div class="row align-items-center justify-content-center">
        <div class="col-sm-6">
            <div class="card mt-5 mb-5" >
                <div class="card-header text-center bg-warning" id="grad1"><h4 style="color: Dark-blue;">Add Tasks</h4></div>
                <div class="card-body">
                    <form method="POST" onsubmit="return validate_form()">
                    <!-- <h2 class="text-center" style="background-color: #f8f9fa;">To-Do Task App</h2> -->

                        <label class="form-label"><strong>Title</strong></label>
                        <input type="text" class="form-control mb-3" placeholder="Enter task title" name="title" id="title" required>

                        <label class="form-label"><strong>Description</strong></label>
                        <textarea type="text" class="form-control mb-3" placeholder="Enter task description" name="description" id="description" required></textarea>

                        <label class="form-label"><strong>Priority</strong></label>
                        <select class="form-control mb-3" name="priority" id="priority" required>
                            <option value="">Select Priority</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>

                        <label class="form-label"><strong>Due Date</strong></label>
                        <input type="date" class="form-control mb-3" name="due_date" id="due_date" required>

                        <button class="btn btn-success" type="submit">Add Task</button>
                        <a href="display.php" class="btn btn-primary">view Tasks</a>
                    </form>
                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
            </div>
        </div>
    </div>
    <footer class="navbar-fixed-bottom bg-dark text-center text-white p-3 mt-5">
        <p>&copy; 2026 To-Do Task App. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        function validate_form(){
        
            let due_date = document.getElementById("due_date").value;

            let today = new Date();
            today.setHours(0, 0, 0, 0);
            let dueDate = new Date(due_date);

            if (dueDate < today) {
                alert("Due date cannot be in the past");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>