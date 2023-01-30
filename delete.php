<!-- select * from employees where id = 1;
delete from employees where id = ?;
update employees set name = ?, address = ?, salary = ? where id = ?; -->

<?php

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    require_once "config.php";
    // Prepare a delete query
    $sql = "DELETE FROM employees WHERE id=?";

    if ($stmt =  mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement

        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_POST["id"]);

        // Execute it 
        if (mysqli_stmt_execute($stmt)) {
            header("location:index.php");
            exit();
        }
    } else {
        echo " something went wrong ";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Delete Record</h2>

                    <form action="<?php echo htmlspecialchars(basename($_SERVER['PHP_SELF'])); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Are you Sure you want to Delete this employee Record?
                            </p>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="index.php" class="btn btn-secondary">No </a>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>