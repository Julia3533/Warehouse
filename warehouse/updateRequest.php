<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Request Status</title>
    <style>
        /* CSS styles for form */
        #form {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-top: 5px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #AB12C5;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div id="form">
    <form action="#" method="post">
        <?php
        // Establish connection to the database
        $con = mysqli_connect('localhost', 'root', '', 'warehouse');

        // Get the request ID from the query parameter
        $requestID = isset($_GET['id']) ? $_GET['id'] : '';

        // Query to fetch the request details along with item name using a join
        $query = "SELECT r.*, i.ItemName FROM requests r INNER JOIN items i ON r.ItemID = i.ItemID WHERE r.RequestID = $requestID AND r.Status = 'New'";
        $result = mysqli_query($con, $query);

        // Check if the request exists and has a status of 'New'
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo '<label>Request ID:<br><strong>' . $row["RequestID"] . '</strong></label>';
            echo '<label>Employee Name:<br><strong>' . $row["EmployeeName"] . '</strong></label>';
            echo '<label>Item Name:<br><strong>' . $row["ItemName"] . '</strong></label>';
            echo '<label>Unit Of Measurement:<br><strong>' . $row["UnitOfMeasurement"] . '</strong></label>';
            echo '<label>Quantity:<br><strong>' . $row["Quantity"] . '</strong></label>';
            echo '<label>Price Without VAT:<br><strong>' . $row["PriceWithoutVAT"] . '</strong></label>';
            echo '<label>Comment:<br><strong>' . $row["Comment"] . '</strong></label>';
            echo '<label>Status:<br>';
            echo '<select name="Status" id="Status">';
            echo '<option value="Approved">Approved</option>';
            echo '<option value="Rejected">Rejected</option>';
            echo '</select></label>';
            echo '<label>Decision Comment:<br><input type="text" name="DecisionComment"></label>';
            echo '<input type="hidden" name="RequestID" value="' . $requestID . '">';
            echo '<button type="submit">Submit</button>';
        } else {
            echo "<p>No request found with ID: $requestID or request status is not 'New'.</p>";
        }

        // Close the database connection
        mysqli_close($con);
        ?>
    </form>
    // Check if the form has been submitted and required fields are set
    <?php
    // Check if the form has been submitted and required fields are set
    if (isset($_POST['Status']) && isset($_POST['DecisionComment'])) {
        // Establish connection to the database
        $con = mysqli_connect('localhost', 'root', '', 'warehouse');
    
        // Get data from the form
        $status = $_POST['Status'];
        $decisionComment = $_POST['DecisionComment'];
        $requestID = $_POST['RequestID'];
    
        // Check if there is enough quantity in the items table
        $checkQuantityQuery = "SELECT r.Quantity, i.Quantity AS AvailableQuantity
                               FROM requests r
                               JOIN items i ON r.ItemID = i.ItemID
                               WHERE r.RequestID = $requestID";
        $quantityResult = mysqli_query($con, $checkQuantityQuery);
        $updated=False;
        if ($status=='Rejected'){
            // Update the request status and add the decision comment
            $updateStatusQuery = "UPDATE requests SET Status = '$status', Comment = '$decisionComment' WHERE RequestID = $requestID";
            $updateStatusResult = mysqli_query($con, $updateStatusQuery);
            echo "<p>Successfully updated request status!</p>
            <a href='index.php' style='text-decoration: none;'>
            <div class='return' style='padding: 10px; background-color: #f0f0f0; border: 1px solid #ccc; cursor: pointer; display: inline-block;'>Go Back</div>
            </a>";
            $updated=True;
        }
        
        if ($quantityResult && !$updated) {
            $row = mysqli_fetch_assoc($quantityResult);
            $requestedQuantity = $row['Quantity'];
            $availableQuantity = $row['AvailableQuantity'];
    
            if ($requestedQuantity <= $availableQuantity && $status='Approved') {
                // Reduce the quantity in the items table
                $reduceQuantityQuery = "UPDATE items SET Quantity = Quantity - $requestedQuantity WHERE ItemID = (SELECT ItemID FROM requests WHERE RequestID = $requestID)";
                $reduceQuantityResult = mysqli_query($con, $reduceQuantityQuery);
    
                if ($reduceQuantityResult) {
                    // Update the request status and add the decision comment
                    $updateStatusQuery = "UPDATE requests SET Status = '$status', Comment = '$decisionComment' WHERE RequestID = $requestID";
                    $updateStatusResult = mysqli_query($con, $updateStatusQuery);
    
                    // Check if the query was successful
                    if ($updateStatusResult) {
                        echo "<p>Successfully updated request status!</p>
                        <a href='index.php' style='text-decoration: none;'>
                        <div class='return' style='padding: 10px; background-color: #f0f0f0; border: 1px solid #ccc; cursor: pointer; display: inline-block;'>Go Back</div>
                        </a>";
                        
                    } else {
                        echo "<p>Error updating request status: " . mysqli_error($con) . "</p>";
                    }
                } else {
                    echo "<p>Error reducing quantity: " . mysqli_error($con) . "</p>";
                }
            } else {
                echo "<p>Not enough quantity available!</p>";
            }
        } else {
            echo "<p>Error checking quantity: " . mysqli_error($con) . "</p>";
        }
    
        // Close the database connection
        mysqli_close($con);
    }
    ?>
    
</div>
</body>
</html>
