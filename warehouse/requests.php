<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Coordinator</title>
    <link rel="stylesheet" href="styl2.css" />
    <style>
    /* styl2.css */

    /* Global styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f0; /* Light beige */
    }

    .container {
        width: 80%;
        margin: 0 auto;
    }

    /* Banner styles */
    #baner1 {
        background-color: #4d3c25; /* Dark brown */
        color: #fff;
        text-align: center;
        padding: 20px 0;
    }

    #baner2 {
        background-color: #7d6d4d; /* Brown */
        color: #fff;
        padding: 10px;
    }

    /* Main content styles */
    #main {
        margin-top: 20px;
        padding: 20px;
        background-color: #fff;
    }

    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 8px;
        border: 1px solid #d2b48c; /* Light brown */
        text-align: left;
    }

    table th {
        background-color: #e6ccb2; /* Beige */
    }

    table tr:nth-child(even) {
        background-color: #f2e8da; /* Light beige */
    }

    table tr:hover {
        background-color: #efe5d7; /* Lighter beige */
    }
    #banner {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    }

    #banner button {
        padding: 10px 20px;
        margin: 0 10px;
        font-size: 16px;
        cursor: pointer;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    #banner button:hover {
        background-color: #0056b3;
    }
    .filter-input {
    flex-basis: calc(25% - 10px);
    margin-right: 10px;
    margin-bottom: 10px;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 16px;
    line-height: 1.5;
    box-sizing: border-box;
    }

    #banner2 {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
    }

    #banner2 button {
    margin-right: 10px;
    margin-bottom: 10px;
    padding: 8px 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 16px;
    line-height: 1.5;
    box-sizing: border-box;
    }
</style>
</head>
<body>
    <div id="baner1">
        <h1>Coordinator panel</h1>
    </div>
    <div id="banner">
        <button onclick="location.href='addRequest.php'">Add Request</button>
        <button onclick="location.href='updateGoods.php'">Update Goods</button>
        <button onclick="location.href='index.php'">Items</button>
    </div>

    <div id="banner2">
        <button style="margin-right: 10px;" onclick="location.href='index.php'">Coordinator</button>
        <button onclick="location.href='home.php'">Employee</button>
        <form method="get" action="#" style="display: flex; flex-wrap: wrap;">
            <input type="text" name="filter_request_id" placeholder="Filter by RequestID" class="filter-input" value="<?php echo isset($_GET['filter_request_id']) ? htmlspecialchars($_GET['filter_request_id']) : ''; ?>" />
            <input type="text" name="filter_employee_name" placeholder="Filter by Employee Name" class="filter-input" value="<?php echo isset($_GET['filter_employee_name']) ? htmlspecialchars($_GET['filter_employee_name']) : ''; ?>" />
            <input type="text" name="filter_item_id" placeholder="Filter by Item ID" class="filter-input" value="<?php echo isset($_GET['filter_item_id']) ? htmlspecialchars($_GET['filter_item_id']) : ''; ?>" />
            <input type="text" name="filter_uom" placeholder="Filter by Unit Of Measurement" class="filter-input" value="<?php echo isset($_GET['filter_uom']) ? htmlspecialchars($_GET['filter_uom']) : ''; ?>" />
            <input type="text" name="filter_quantity" placeholder="Filter by Quantity" class="filter-input" value="<?php echo isset($_GET['filter_quantity']) ? htmlspecialchars($_GET['filter_quantity']) : ''; ?>" />
            <input type="text" name="filter_price" placeholder="Filter by Price Without VAT" class="filter-input" value="<?php echo isset($_GET['filter_price']) ? htmlspecialchars($_GET['filter_price']) : ''; ?>" />
            <input type="text" name="filter_comment" placeholder="Filter by Comment" class="filter-input" value="<?php echo isset($_GET['filter_comment']) ? htmlspecialchars($_GET['filter_comment']) : ''; ?>" />
            <input type="text" name="filter_status" placeholder="Filter by Status" class="filter-input" value="<?php echo isset($_GET['filter_status']) ? htmlspecialchars($_GET['filter_status']) :''; ?>" />
            <button type="submit" class="filter-input">Filter</button>
        </form>
    
        <?php
        if (isset($_GET["id"]) && $_GET["action"] == "remove") {
            $con = mysqli_connect('localhost', 'root', '', 'warehouse');
            $kw11 = "SET FOREIGN_KEY_CHECKS=0;";
            $kw12 = "DELETE FROM requests WHERE RequestID = " . $_GET["id"] . " LIMIT 1;";
            $res1 = mysqli_query($con, $kw11);
            $res2 = mysqli_query($con, $kw12);
            $affectedRows = mysqli_affected_rows($con);
            mysqli_close($con);
            if ($affectedRows > 0) {
                echo "<div style='background-color: #f44336; color: white; padding: 10px;'>Request was deleted successfully!</div>";
            }
        }
        ?>
    </div>
    <div id="main">
        <?php
        $con = mysqli_connect('localhost', 'root', '', 'warehouse');
        $kw1 = "SELECT * FROM requests WHERE 1";

        if (!empty($_GET['filter_request_id'])) {
            $kw1 .= " AND RequestID = " . $_GET['filter_request_id'];
        }

        if (!empty($_GET['filter_employee_name'])) {
            $employeeNameFilter = mysqli_real_escape_string($con, $_GET['filter_employee_name']);
            $kw1 .= " AND EmployeeName LIKE '%$employeeNameFilter%'";
        }

        if (!empty($_GET['filter_item_id'])) {
            $itemIDFilter = mysqli_real_escape_string($con, $_GET['filter_item_id']);
            $kw1 .= " AND ItemID = '$itemIDFilter'";
        }

        if (!empty($_GET['filter_uom'])) {
            $uomFilter = mysqli_real_escape_string($con, $_GET['filter_uom']);
            $kw1 .= " AND UnitOfMeasurement = '$uomFilter'";
        }

        if (!empty($_GET['filter_quantity'])) {
            $quantityFilter = mysqli_real_escape_string($con, $_GET['filter_quantity']);
            if (preg_match('/^[0-9<>=]+$/', $quantityFilter)) {
            if (strpos($quantityFilter, '<') === 0) {
                $kw1 .= " AND Quantity < " . substr($quantityFilter, 1);
            } elseif (strpos($quantityFilter, '>') === 0) {
                $kw1 .= " AND Quantity > " . substr($quantityFilter, 1);
            } else {
                $kw1 .= " AND Quantity = " . $quantityFilter;
            }};
        }
        
        
        if (!empty($_GET['filter_price'])) {
            $priceFilter = mysqli_real_escape_string($con, $_GET['filter_price']);
            if (preg_match('/^[0-9<>=]+$/', $quantityFilter)) {
            if (strpos($priceFilter, '<') === 0) {
                $kw1 .= " AND PriceWithoutVAT < " . substr($priceFilter, 1);
            } elseif (strpos($priceFilter, '>') === 0) {
                $kw1 .= " AND PriceWithoutVAT > " . substr($priceFilter, 1);
            } else {
                $kw1 .= " AND PriceWithoutVAT = " . $priceFilter;
            }
        }}

        if (!empty($_GET['filter_comment'])) {
            $commentFilter = mysqli_real_escape_string($con, $_GET['filter_comment']);
            $kw1 .= " AND Comment LIKE '%$commentFilter%'";
        }

        if (!empty($_GET['filter_status'])) {
            $statusFilter = mysqli_real_escape_string($con, $_GET['filter_status']);
            $kw1 .= " AND Status = '$statusFilter'";
        }
        $res1 = mysqli_query($con, $kw1);
        echo '<table id="myTable">
        <thead>
          <tr>
            <th onclick="sortTable(0)">Request ID</th>
            <th onclick="sortTable(1)">Employee Name</th>
            <th onclick="sortTable(2)">Item ID</th>
            <th onclick="sortTable(3)">Unit Of Measurement</th>
            <th onclick="sortTable(4)">Quantity</th>
            <th onclick="sortTable(5)">Price Without VAT</th>
            <th onclick="sortTable(6)">Comment</th>
            <th onclick="sortTable(7)">Status</th>
            <th>Actions</th>
          </tr>
        </thead>';
        while ($tab = mysqli_fetch_row($res1)) {
            echo "<tbody>
                <tr>
                  <td>$tab[0]</td>
                  <td>$tab[1]</td>
                  <td>$tab[2]</td>
                  <td>$tab[3]</td>
                  <td>$tab[4]</td>
                  <td>$tab[5]</td>
                  <td>$tab[6]</td>
                  <td>$tab[7]</td>";
                if ($tab[7] === 'New') {
                    // Display the "Change Status" link only if the status is 'New'
                    echo "<td><a href='updateRequest.php?id=$tab[0]&action=change_status'>Change Status</a></td>";
                } else {
                    // Display a message indicating that the status cannot be changed
                    echo "<td>Already closed</td>";
                }
                  "</tr>
              ";
        }
        echo "</tbody>
        </table>";
        mysqli_close($con);
        ?>
    </div>

    <script>
        function sortTable(columnIndex) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("myTable");
            switching = true;
            
            var header = table.getElementsByTagName("th")[columnIndex];
            var direction = header.getAttribute("data-direction") || "asc";

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                    if ((direction === "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) ||
                        (direction === "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
            if (direction === "asc") {
                header.setAttribute("data-direction", "desc");
            } else {
                header.setAttribute("data-direction", "asc");
            }
        }
    </script>

</body>
</html>
