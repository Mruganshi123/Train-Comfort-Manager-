<?php

// Include database connection file
include("C:/xampp/htdocs/ws/Train-Comfort-Manager/database/conn.php");

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Initialize response array
    $response = array();

    // Retrieve POST data
    $pillow_no = $_POST['pillow_no'];
    $sheet_no = $_POST['sheet_no'];
    $blanket_no = $_POST['blanket_no'];
    $hanckerchief_no = $_POST['hanckerchief_no'];
    $selectedDate = $_POST['selectedDate'];

    // Example: Perform database update or processing logic
    // Replace this with your actual database update code
    // Assuming you have a database connection already established from conn.php

    // Prepare SQL statement to update inventory
    $sql = "UPDATE inventory SET pillow_no=?, sheet_no=?, blanket_no=?, hanckerchief_no=? WHERE selectedDate=?";
    
    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiii", $pillow_no, $sheet_no, $blanket_no, $hanckerchief_no, $selectedDate);

    // Execute the statement
    if ($stmt->execute()) {
        $response['statusCode'] = 200;
        $response['message'] = "Inventory updated successfully.";
    } else {
        $response['statusCode'] = 400;
        $response['message'] = "Error updating inventory: " . $conn->error;
    }

    // Close statement
    $stmt->close();
} else {
    // Return error if request method is not POST
    $response['statusCode'] = 400;
    $response['message'] = "Invalid request method.";
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close database connection
$conn->close();

?>
