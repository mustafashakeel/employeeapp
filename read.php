<?php

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    require_once "config.php";
    // prepare a select statement
    $sql = "SELECT * FROM employees WHERE id = ?";

    if ($stmt  = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);


        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else {
                header("location: error.php");
                exit();
            }
            // close statement
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Record</title>
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
                    <h1 class="mt-5 mb-3">View Record</h1>
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <b><?php echo $row["name"]; ?></b>
                </div><br />
                <div class="form-group">
                    <label for="">Address</label>
                    <b><?php echo $row["address"]; ?></b>
                </div><br />
                <div class="form-group">
                    <label for="">Salary</label>
                    <b><?php echo $row["salary"]; ?></b>
                </div>
            </div>
        </div>
    </div>

</body>

</html>