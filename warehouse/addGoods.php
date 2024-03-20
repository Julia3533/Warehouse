<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Goods</title>
    <style>
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

    </style>
</head>
<body>
<div id="form">
		<form action="addGoods.php" method="post">
			<label>
                ItemGroup:
                <select name="ItemGroup" id="ItemGroup"> 
                    <option value="Loose">Loose</option> 
                    <option value="Light">Light</option> 
                    <option value="Heavy">Heavy</option> 
                    <option value="Tools">Tools</option> 
                    <option value="Materials">Materials</option>
                </select>
			</label>
			<label>
                UnitOfMeasurement:
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
                PriceWithoutVAT:
				<input type="number" step="0.01"name="PriceWithoutVAT" />
			</label>
            <label>
                Status:
				<input type="text" name="Status" />
			</label>
            <label>
                StorageLocation:
				<input type="text" name="StorageLocation" />
			</label>
            <label>
                ContactPerson:
				<input type="text" name="ContactPerson" />
			</label>
            <label>
				Photo:
				<input type="text" name="Photo" />
			</label>
			<button>Add Item</button>
		</form>
		<?php
        $con = mysqli_connect('localhost', 'root', '', 'warehouse');
        $columns = array ("ItemGroup","UnitOfMeasurement","Quantity","PriceWithoutVAT","Status","StorageLocation","ContactPerson","Photo");
		if (!empty($_POST[$columns[0]]) && !empty($_POST[$columns[1]]) && !empty($_POST[$columns[2]]) && !empty($_POST[$columns[3]]) && !empty($_POST[$columns[4]]) && !empty($_POST[$columns[5]]) && !empty($_POST[$columns[6]]) && !empty($_POST[$columns[7]])) {
			$ItemGroup = $_POST[$columns[0]];
            $UnitOfMeasurement = $_POST[$columns[1]];
            $Quantity = $_POST[$columns[2]];
            $PriceWithoutVAT = $_POST[$columns[3]];
            $Status = $_POST[$columns[4]];
            $StorageLocation = $_POST[$columns[5]];
            $ContactPerson = $_POST[$columns[6]];
            $Photo = $_POST[$columns[7]];
			$kw2 = "INSERT INTO `items` (`ItemGroup`, `UnitOfMeasurement`, `Quantity`, `PriceWithoutVAT`, `Status`, `StorageLocation`, `ContactPerson`, `Photo`) VALUES ('$ItemGroup', '$UnitOfMeasurement', '$Quantity', '$PriceWithoutVAT', '$Status', '$StorageLocation', '$ContactPerson', '$Photo');";
			mysqli_query($con, $kw2);
            print"<p>Sucessfully added item!</p>";
		}
        
		mysqli_close($con);
		?>
	</div>
</body>
</html>