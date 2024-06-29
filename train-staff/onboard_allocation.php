<?php
include '../database/conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Passenger Bed Roll Reservation Table</title>
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
      
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
              <center>
                <div class="card-header">
                    <h3><b>OnBoard Allocation</b></h3>
                    
                </div>
            </center>

                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th rowspan="2">Reservation_id</th>
                        <th rowspan="2">Name</th>
                        <th rowspan="2">Phone Number</th>
                        <th rowspan="2">Train Number</th>
                        <th rowspan="2">Bed Roll</th>
                        <th rowspan="2">Allocated</th>
                        <th rowspan="2">Reserve Date</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $qry = "
                      SELECT 
                        reservations.reserv_id AS reservation_id,
                        reservations.bed_roll_reserved AS bed_reserved,
                        users.name AS user_name,
                        users.phone_number AS user_phone_number,
                        reservations.reservation_date AS reserve_date,
                        trains.train_number AS train_number,
                        preferences.bed_roll_allocated AS bed_allocated
                      FROM 
                        reservations
                      JOIN 
                        users ON reservations.user_id = users.user_id
                      JOIN 
                        trips ON reservations.trip_id = trips.trip_id
                      JOIN 
                        trains ON trips.train_id = trains.train_id
                      JOIN
                        preferences ON preferences.user_id = users.user_id
                       WHERE 
                        reservations.bed_roll_reserved = 0 ;
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
                            <td>
                                <?php 
                                if($row['bed_reserved'] == 0) {
                                    echo '<span class="badge badge-warning">Not Reserved</span>';
                                }
                                else{
                                    echo '<span class="badge badge-success">Reserved</span>';        
                                }
                                
                                ?></td>
                            <td>
                                <?php 
                                if($row['bed_allocated'] == 0) {
                                    echo '<span class="badge badge-warning">Pending</span>';
                                }
                                else{
                                    echo '<span class="badge badge-success">Allocated</span>';        
                                }
                                
                                ?></td>
                            <td><?php echo $row['reserve_date']; ?></td>
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
