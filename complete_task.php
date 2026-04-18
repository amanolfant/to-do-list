<?php
$con = mysqli_connect("localhost", "root", "", "to-do");
if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}
$id = $_GET['id'] ?? null;


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $con->prepare("UPDATE tasks SET status = 'completed' WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: display.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>