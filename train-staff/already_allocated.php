<?php
include '../database/conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Bed Roll Reservation Table</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        th {
            text-align: center;
        }
    </style>
    <?php include("../components/header.php"); ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include("../components/sidebar.php"); ?>

        <div class="content-wrapper">
        <center>
                <div class="card-header">
                    <h3><b>Reserved Bed Rolls</b></h3>    
                </div>
            </center>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Reservation_id</th>
                                                <th rowspan="2">Name</th>
                                                <th rowspan="2">Phone Number</th>
                                                <th rowspan="2">Train Number</th>
                                                <!-- <th rowspan="2">Bed Roll</th> -->
                                                <th rowspan="2">Reserve Date</th>
                                                <th rowspan="2">Allocated</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $qry = "
                                                SELECT 
                                                    reservations.reserv_id AS reservation_id,
                                                    reservations.bed_roll_reserved AS bed_reserved,
                                                    reservations.bed_roll_allocated AS bed_allocated,
                                                    users.name AS user_name,
                                                    users.phone_number AS user_phone_number,
                                                    reservations.reservation_date AS reserve_date,
                                                    trains.train_number AS train_number
                                                FROM 
                                                    reservations
                                                JOIN 
                                                    users ON reservations.user_id = users.user_id
                                                JOIN 
                                                    trips ON reservations.trip_id = trips.trip_id
                                                JOIN 
                                                    trains ON trips.train_id = trains.train_id
                                                WHERE 
                                                    reservations.bed_roll_reserved = 1;
                                            ";

                                            $res = mysqli_query($conn, $qry);
                                            if (!$res) {
                                                echo "Error occurred: " . mysqli_error($conn);
                                            } else {
                                                while ($row = mysqli_fetch_assoc($res)) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['reservation_id']; ?></td>
                                                        <td><?php echo $row['user_name']; ?></td>
                                                        <td><?php echo $row['user_phone_number']; ?></td>
                                                        <td><?php echo $row['train_number']; ?></td>                       
                                                        <td><?php echo $row['reserve_date']; ?></td>
                                                        <td>
                                                            <?php 
                                                                if($row['bed_allocated'] == 1){
                                                                    echo '<span class="badge badge-success"> Allocated</span>';
                                                                    
                                                                } 
                                                                
                                                                else{
                                                                    
                                                                    echo '<span class="badge badge-warning">Pending</span>';
                                                                }
                                                                ?>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("../components/footer.php"); ?>
    </div>
</body>

</html>
