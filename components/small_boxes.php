


<?php
include "C:/xampp/htdocs/ws/Train-Comfort-Manager/database/conn.php";
?>
<?php
// Check connection
if ($conn) {
    // Query to get the total number of passengers
    $query = "SELECT COUNT(*) AS total_passengers FROM users"; // Update table name to your actual table
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $total_passengers = $row['total_passengers'];
    } else {
        $total_passengers = 0;
    }
} else {
    $total_passengers = 0;
}

?>

<?php
// Check connection
if ($conn) {
    
    $query = "SELECT COUNT(*) AS reserver_bedroll From reservations WHERE bed_roll_reserved = 1;"; // Update table name to your actual table
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $reserver_bedroll = $row['reserver_bedroll'];
    } else {
        $reserver_bedroll = 0;
    }
} else {
    $reserver_bedroll = 0;
}

?>

<?php
                      $qry_inventory = "
    SELECT 
      total_pillow,
      total_sheet,
      total_blanket,
      total_hankerchief,
      last_modified
    FROM 
      inventory;
    ";

                      $res_inventory = mysqli_query($conn, $qry_inventory);
                      if (!$res_inventory) {
                        echo "Error occurred: " . mysqli_error($conn);
                      } else {
                        while ($row_inventory = mysqli_fetch_assoc($res_inventory)) {
                            // Calculate the number of available sets
                            $available_sets = min($row_inventory['total_pillow'], $row_inventory['total_sheet'], $row_inventory['total_blanket'], $row_inventory['total_hankerchief']);
                            // Round to the nearest whole number
                            $available_sets = floor($available_sets);
                        }
                      }
                    ?>
                    







<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <h3><?php echo $total_passengers; ?></h3>

                <p>Total passanger</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="../train-staff/total_allocation.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $reserver_bedroll ;?> </h3>

                <p>Total Reservevd Bed roll</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="../train-staff/already_allocated.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $available_sets; ?></h3>


                <p>Available Bed sets</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="../train-staff/view_inventroy.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>