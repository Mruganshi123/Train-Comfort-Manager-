<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <?php
  include("../components/header.php");
  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Home</a>
        </li>

      </ul>




    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    include("../components/sidebar.php");
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <?php
          include("../components/small_boxes.php");
          ?>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"> New Bed-roll Requests</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Reservation_id</th>
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
                              if ($row['bed_reserved'] == 0) {
                                echo '<span class="badge badge-warning">Not Reserved</span>';
                              } else {
                                echo '<span class="badge badge-success">Reserved</span>';
                              }

                              ?></td>
                            <td>
                              <?php
                              if ($row['bed_allocated'] == 0) {
                                echo '<span class="badge badge-warning">Pending</span>';
                              } else {
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

              <!-- /.card-body -->

              <!-- /.card -->

              <!-- DIRECT CHAT -->

              <!--/.direct-chat -->

              <!-- TO DO List -->

              <!-- /.card -->
            </section>
            <!-- /.Left col -->

            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <section class="col-lg-5 connectedSortable">

              <?php
              include "C:/xampp/htdocs/ws/Train-Comfort-Manager/database/conn.php";

              // Fetch inventory data
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
                $low_stock = false;
                $low_items = [];

                while ($row_inventory = mysqli_fetch_assoc($res_inventory)) {
                  // Calculate the threshold for low stock (30% of the total sets)
                  $threshold_pillow = $row_inventory['total_pillow'] * 0.3;
                  $threshold_sheet = $row_inventory['total_sheet'] * 0.3;
                  $threshold_blanket = $row_inventory['total_blanket'] * 0.3;
                  $threshold_hankerchief = $row_inventory['total_hankerchief'] * 0.3;

                  // Check if any item is below the threshold
                  if ($row_inventory['total_pillow'] < $threshold_pillow) {
                    $low_stock = true;
                    $low_items[] = 'Pillows';
                  }
                  if ($row_inventory['total_sheet'] < $threshold_sheet) {
                    $low_stock = true;
                    $low_items[] = 'Sheets';
                  }
                  if ($row_inventory['total_blanket'] < $threshold_blanket) {
                    $low_stock = true;
                    $low_items[] = 'Blankets';
                  }
                  if ($row_inventory['total_hankerchief'] < $threshold_hankerchief) {
                    $low_stock = true;
                    $low_items[] = 'Handkerchiefs';
                  }
                }

                if ($low_stock) {
                  echo '<div class="alert alert-warning" role="alert">';
                  echo 'Low inventory stock for: ' . implode(', ', $low_items);
                  echo '</div>';
                } else {
                  echo '<div class="alert alert-success" role="alert">';
                  echo 'Inventory levels are sufficient.';
                  echo '</div>';
                }
              }

              $conn->close();
              ?>
              <!-- ananlysis -->

              <div class="col-lg-12">
  <div class="card">
    <div class="card-header border-0">
      
    </div>
    <div class="card-body">
      <div class="d-flex">
        <p class="d-flex flex-column">
          <span class="text-bold text-lg">Inventory Overview</span>
          <span>Bed Sets Over Time</span>
        </p>
        
      </div>
      <!-- /.d-flex -->

      <div class="position-relative mb-4">
        <canvas id="inventory-chart" height="200"></canvas>
      </div>

      
    </div>
  </div>
  <!-- /.card -->
</div>

<?php
include "C:/xampp/htdocs/ws/Train-Comfort-Manager/database/conn.php";

// Fetch inventory data
$qry_inventory = "
    SELECT 
        total_pillow,
        total_sheet,
        total_blanket,
        total_hankerchief,
        last_modified
    FROM 
        inventory
    ORDER BY last_modified DESC
    LIMIT 4;
";

$res_inventory = mysqli_query($conn, $qry_inventory);

$bed_set_data = [];

if (!$res_inventory) {
    echo "Error occurred: " . mysqli_error($conn);
} else {
    while ($row_inventory = mysqli_fetch_assoc($res_inventory)) {
        // Calculate available sets
        $available_sets = min($row_inventory['total_pillow'], 
                              $row_inventory['total_sheet'], 
                              $row_inventory['total_blanket'], 
                              $row_inventory['total_hankerchief']);
        // Round to nearest whole number
        $available_sets = floor($available_sets);

        // Push calculated data to array
        $bed_set_data[] = $available_sets;
    }
}

mysqli_close($conn);
?>



              <!-- /.card -->
          </div>

          <?php
          include "C:/xampp/htdocs/ws/Train-Comfort-Manager/database/conn.php";

          // Fetch inventory data
          $qry_inventory = "
SELECT 
  total_pillow,
  total_sheet,
  total_blanket,
  total_hankerchief,
  last_modified
FROM 
  inventory
ORDER BY last_modified DESC
LIMIT 4;
";

          $res_inventory = mysqli_query($conn, $qry_inventory);

          $pillow_data = [];
          $sheet_data = [];
          $blanket_data = [];
          $handkerchief_data = [];
          $dates = [];

          if (!$res_inventory) {
            echo "Error occurred: " . mysqli_error($conn);
          } else {
            while ($row_inventory = mysqli_fetch_assoc($res_inventory)) {
              $pillow_data[] = $row_inventory['total_pillow'];
              $sheet_data[] = $row_inventory['total_sheet'];
              $blanket_data[] = $row_inventory['total_blanket'];
              $handkerchief_data[] = $row_inventory['total_hankerchief'];
              $dates[] = date('d-m-Y', strtotime($row_inventory['last_modified']));
            }
          }

          $conn->close();
          ?>



      </section>
    </div>
    <!-- right col -->
  </div>
  <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?php
  include("../components/footer.php");
  ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Data from PHP
  const bedSetData = <?php echo json_encode($bed_set_data); ?>;
  const dates = <?php echo json_encode($dates); ?>;

  const inventoryData = {
    labels: dates,
    datasets: [
      {
        label: 'Bed Sets',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: bedSetData
      }
    ]
  };

  const inventoryChart = new Chart(document.getElementById('inventory-chart'), {
    type: 'bar',
    data: inventoryData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1 // Ensure y-axis starts at 0 and steps in integers
          }
        }]
      }
    }
  });
</script>

</html>