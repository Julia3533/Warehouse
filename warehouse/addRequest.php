<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Request</title>
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
        input[type="number"],
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
        .close-request {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-block;
            margin-top: 10px;
            text-align: center;
        }

        .close-request:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div id="form">
    <form action="addRequest.php" method="post">
        <label>
            Employee Name:
            <input type="text" name="EmployeeName" />
        </label>
        <?php
        // Establish connection to the database
        $con = mysqli_connect('localhost', 'root', '', 'warehouse');

        // Query to fetch all item names from the items table
        $query = "SELECT ItemID, ItemName FROM items";
        $result = mysqli_query($con, $query);

        // Check if there are any items available
        if (mysqli_num_rows($result) > 0) {
            echo '<label for="ItemName">Item Name:';
            echo '<select name="ItemID" id="ItemName">';
            // Loop through each row and fetch item names
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row["ItemID"] . '">' . $row["ItemName"] . '</option>';
            }
            echo '</select>';
        } else {
            echo '<p>No items available.</p>';
        }
        echo "</label>";
        // Close the database connection
        mysqli_close($con);
        ?>
        <label>
            Unit Of Measurement:
            <select name="UnitOfMeasurement" id="UnitOfMeasurement">
                <option value="SI">SI</option>
                <option value="Imperial">Imperial</option>
            </select>
        </label>
        <label>
            Quantity:
            <input type="number" name="Quantity" />
        </label>
        <label>
            Price Without VAT:
            <input type="number" step="0.01" name="PriceWithoutVAT" />
        </label>
        <label>
            Comment:
            <input type="text" name="Comment" />
        </label>
        <button>Add Request</button>
        <?php
        if (isset($_GET['source']) && $_GET['source'] === 'employee') {
            echo '<a href="home.php"><div class="close-request">Close Request</div></a>';
        }
        ?>
    </form>
    <?php
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Establish connection to the database
        $con = mysqli_connect('localhost', 'root', '', 'warehouse');

        // Check if all required fields are filled
        if (!empty($_POST['EmployeeName']) && !empty($_POST['ItemID']) && !empty($_POST['UnitOfMeasurement']) && !empty($_POST['Quantity']) && !empty($_POST['PriceWithoutVAT']) && !empty($_POST['Comment'])) {
            // Get data from the form
            $EmployeeName = $_POST['EmployeeName'];
            $ItemID = $_POST['ItemID'];
            $UnitOfMeasurement = $_POST['UnitOfMeasurement'];
            $Quantity = $_POST['Quantity'];
            $PriceWithoutVAT = $_POST['PriceWithoutVAT'];
            $Comment = $_POST['Comment'];

            // Insert data into the requests table
            $query = "INSERT INTO `requests` (`EmployeeName`, `ItemID`, `UnitOfMeasurement`, `Quantity`, `PriceWithoutVAT`, `Comment`) VALUES ('$EmployeeName', '$ItemID', '$UnitOfMeasurement', '$Quantity', '$PriceWithoutVAT', '$Comment')";
            $result = mysqli_query($con, $query);

            // Check if the query was successful
            if ($result) {
                echo "<p>Successfully added request!</p>
                <a href='home.php' style='text-decoration: none;'>
                <div class='return' style='padding: 10px; background-color: #f0f0f0; border: 1px solid #ccc; cursor: pointer; display: inline-block;'>Go Back</div>
                </a>
                ";
            } else {
                echo "<p>Error: " . mysqli_error($con) . "</p>";
            }
        } else {
            echo "<p>Please fill all the fields.</p>";
        }

        // Close the database connection
        mysqli_close($con);
    }
    ?>
</div>
</body>
</html>
