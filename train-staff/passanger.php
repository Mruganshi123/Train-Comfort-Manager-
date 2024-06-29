

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
                      <?php
                      $dates = [];
                      // Collect unique dates for each user
                      foreach ($data as $user) {
                        $dates = array_merge($dates, array_keys($user));
                      }
                      $dates = array_unique($dates);
                      $dates = array_values(array_diff($dates, ['User ID']));

                      // Display date headers with height and weight
                      foreach ($dates as $date) {
                        echo "<th colspan='2'>$date</th>";
                      }
                      ?>
                    </tr>
                    <tr>
                      <!-- Sub-headers for height and weight -->
                      <?php
                      foreach ($dates as $date) {
                        echo "</th><th>Height</th><th>Weight</th>";
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Display data rows -->
                    <?php
                    if (!empty($data)) {
                      foreach ($data as $user_id => $user_data) {
                        echo "<tr>";
                        echo "<td>$user_id</td>";
                        foreach ($dates as $date) {
                          if (isset($user_data[$date])) {
                            echo "<td>" . ($user_data[$date]['height'] !== null ? $user_data[$date]['height'] : '-') . "</td>";
                            echo "<td>" . ($user_data[$date]['weight'] !== null ? $user_data[$date]['weight'] : '-') . "</td>";
                          } else {
                            echo "<td>-</td><td>-</td>";
                          }
                        }
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='" . (count($dates) * 2 + 1) . "'>No data found</td></tr>";
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
  <?php
  include("../components/footer.php");
  ?>

  <!-- ... (footer and other HTML structure) ... -->
</body>

</html>