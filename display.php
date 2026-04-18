<?php
$con = mysqli_connect("localhost", "root", "", "to-do");
if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body{
            background-color: lightgray;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn:hover {
            background-color: #0056b3;
            color: white;
        }
        .table thead th {
            background-color: #f8f9fa;
        }
         .navbar-brand img {
            border-radius: 50%;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="sticky-top navbar navbar-light bg-dark">
            <a class="navbar-brand p-2" href="#">
                <img src="logo.jpg" width="50" height="50" alt="">
            </a>
            <h2 class="text-center p-2" style="color: white;">To-Do Task App</h2>
    </nav>

    <div class="row align-items-center justify-content-center">
        <div class="col-sm-10">
            <div class="card mt-5 mb-5">
                <div class="card-header text-center bg-info"><h4 style="color: Dark-blue;">Tasks List</h4></div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="thead-primary">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Mark as complete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $con->query("SELECT * FROM tasks ORDER BY id DESC");
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["id"] . "</td>";
                                        echo "<td>" . $row["title"] . "</td>";
                                        echo "<td>" . $row["description"] . "</td>";
                                        echo "<td>" . $row["priority"] . "</td>";
                                        echo "<td>" . $row["due_date"] . "</td>";
                                        $status = $row["status"] ?? 'pending';
                                        echo "<td style='background-color: " . ($status == 'completed' ? 'lightgreen' : 'lightcoral') . "'>" . $status . "</td>" ;
                                        echo "<td><a class='btn btn-success' href='complete_task.php?id=" . $row["id"] . "'>Complete</a>
                                            <a class='btn btn-danger' href='delete_task.php?id=" . $row["id"] . "'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                }
                                else {
                                    echo "<tr><td colspan='4'>No tasks found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer class="navbar-fixed-bottom bg-dark text-center text-white p-3 mt-5">
            <p>&copy; 2026 To-Do Task App. All rights reserved.</p>
        </footer>
</body>
</html>