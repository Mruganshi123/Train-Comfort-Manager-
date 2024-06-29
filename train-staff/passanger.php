<?php

// include 'database/conn.php';

include '../database/conn.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>passanger bed roll reservation table</title>
  <style>
    th {
      text-align: center;
      /* Center-align all table headers */
    }
  </style>
  <?php
  include("../components/header.php");
  ?>
  <!-- Other script tags and your custom JavaScript code -->

</head>
<!-- ... (head section and other HTML structure) ... -->

<body class="hold-transition sidebar-mini">
  <!-- ... (wrapper and other HTML structure) ... -->
  <div class="wrapper">
    <?php
    include("../components/sidebar.php");
    ?>

    <div class="content-wrapper">

      <!-- Table to display measurement data -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <!-- Table headers -->
                      <th rowspan="2">User ID</th>
                      <th rowspan="2">Name</th>
                      <th rowspan="2">Phone Number</th>
                      <th rowspan="2">Email Id</th>
                      <th rowspan="2">Address</th>                     
                    </tr>  
                  </thead>

                  <tbody>
                    <!-- Display data rows -->
                    <?php
                        $res = mysqli_query($conn,"SELECT * FROM users WHERE role = 'passenger'");
                        // $res = $this->db->query("SELECT * FROM users WHERE role = 'passenger'");
                        while($row = mysqli_fetch_assoc($res)) :
                    ?>

                    <tr>

                      <td><?php echo $row['user_id']?></td>
                      <td><?php echo $row['name']?></td>
                      <td><?php echo $row['phone_number']?></td>
                      <td><?php echo $row['email_id']?></td>
                      <td><?php echo $row['address']?></td>
                      

                    </tr>

                    
        
                    
                  </tbody>
                  <?php endwhile; ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include("../components/footer.php");
  ?>

  <!-- ... (footer and other HTML structure) ... -->
</body>

</html>