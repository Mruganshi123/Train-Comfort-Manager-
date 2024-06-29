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


        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
              <center>
                <div class="card-header">
                    <h3><b>Inventory table</b></h3>
                    
                </div>
            </center>
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>Available Sets</th>
                        <th>Total Pillow</th>
                        <th>Total Sheet</th>
                        <th>Total Blanket</th>
                        <th>Total Handkerchief</th>
                        <th>Last Modified</th>
                      </tr>
                    </thead>

                    <tbody>
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
                    ?>
                        <tr>
                        <td><?php echo $available_sets; ?></td>
                          <td><?php echo $row_inventory['total_pillow']; ?></td>
                          <td><?php echo $row_inventory['total_sheet']; ?></td>
                          <td><?php echo $row_inventory['total_blanket']; ?></td>
                          <td><?php echo $row_inventory['total_hankerchief']; ?></td>
                          <td><?php echo $row_inventory['last_modified']; ?></td>
                         
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