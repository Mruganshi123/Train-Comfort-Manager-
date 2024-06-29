<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | DataTables</title>

    <?php
    include("../components/header.php");
    ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php
        include("../components/sidebar.php");
        ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1> update inventory</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <form id="dateselection" method="POST">
                                        <!-- Form for selecting date -->
                                        <div class="form-group">
                                            <label for="dom">Select date:</label>
                                            <input type="date" id="dom" name="selectedDate">
                                        </div>
                                        <button type="button" class="btn btn-success" id="updatebtn">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Modal for updating inventory -->
            <div class="modal fade" id="HWModal" tabindex="-1" role="dialog" aria-labelledby="update_inventory_ModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="HWModalLabel">Update Inventory</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form id="update_inventoryModalForm">
                       
                        <div class="form-group">
                            <label for="selectedDateModal">Selected Date:</label>
                            <input type="text" class="form-control" id="selectedDateModal" readonly>
                        </div>
                        <div class="form-group">
                            <label for="blanket_no">Number of Blankets:</label>
                            <input type="number" class="form-control" id="blanket_no" placeholder="Enter Number of Blankets">
                        </div>
                        <div class="form-group">
                            <label for="sheet_no">Number of Sheets:</label>
                            <input type="number" class="form-control" id="sheet_no" placeholder="Enter Number of Sheets">
                        </div>
                        <div class="form-group">
                            <label for="pillow_no">Number of Pillows:</label>
                            <input type="number" class="form-control" id="pillow_no" placeholder="Enter Number of Pillows">
                        </div>
                        <div class="form-group">
                            <label for="hanckerchief_no">Number of Handkerchiefs:</label>
                            <input type="number" class="form-control" id="hanckerchief_no" placeholder="Enter Number of Handkerchiefs">
                        </div>
                    </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="submitInventory" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <?php
    include("../components/footer.php");
    ?>


</body>

<script>
    $(document).ready(function() {

// Function to handle opening modal with selected date
function openModal(selectedDate) {
    // Set the selected date in the modal
    $('#selectedDateModal').val(selectedDate);
    // Show the modal
    $('#HWModal').modal('show');
}

// Handle click event for Update button
$('#updatebtn').click(function() {
    // Get the selected date from the input field
    let selectedDate = $('#dom').val();
    
    // Check if a date is selected
    if (selectedDate) {
        // Call function to open modal with selected date
        openModal(selectedDate);
    } else {
        // Handle case where no date is selected (optional)
        alert('Please select a date.');
    }
});

// Function to add inventory (similar to your previous code)
function addInventory() {
 
    let blankets = $('#blankets').val();
    let sheets = $('#sheets').val();
    let pillows = $('#pillows').val();
    let handkerchief = $('#handkerchief').val();
    let selectedDate = $('#selectedDateModal').val();

    $.ajax({
        url: 'add_inventory.php', // Replace with your PHP file handling the inventory update
        type: 'POST',
        data: {
           
            blankets: blankets,
            sheets: sheets,
            pillows: pillows,
            handkerchief: handkerchief,
            selectedDate: selectedDate
        },
        dataType: 'json',
        success: function(response) {
            if (response.statusCode === 200) {
                toastr.success('Success', response.message);
                $('#HWModal').modal('hide');
            } else {
                toastr.error('Error', response.message);
            }
        },
        error: function(xhr, status, error) {
            toastr.error('Error', error);
        }
    });
}

// Handle click event for Submit button in modal
$('#submitInventory').click(function() {
    addInventory(); // Call the addInventory function on button click
});
$('#updatebtn').click(function() {
                $('#HWModal').modal('show');
            });
});



</script>

</html>