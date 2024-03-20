<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Goods</title>
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
<?php   
        $print = False;
        $con = mysqli_connect('localhost', 'root', '', 'warehouse');
        $columns = array ("ItemGroup","UnitOfMeasurement","Quantity","PriceWithoutVAT","Status","StorageLocation","ContactPerson","Photo", "itemName");
        if(isset($_GET["id"])){
		if (!empty($_POST[$columns[0]]) || !empty($_POST[$columns[1]]) || !empty($_POST[$columns[2]]) || !empty($_POST[$columns[3]]) || !empty($_POST[$columns[4]]) || !empty($_POST[$columns[5]]) || !empty($_POST[$columns[6]]) || !empty($_POST[$columns[7]]) || !empty($_POST[$columns[8]])) {
            $ItemGroup          = !empty($_POST[$columns[0]]) ? $_POST[$columns[0]] : null;
            $UnitOfMeasurement  = !empty($_POST[$columns[1]]) ? $_POST[$columns[1]] : null;
            $Quantity           = !empty($_POST[$columns[2]]) ? $_POST[$columns[2]] : null;
            $PriceWithoutVAT    = !empty($_POST[$columns[3]]) ? $_POST[$columns[3]] : null;
            $Status             = !empty($_POST[$columns[4]]) ? $_POST[$columns[4]] : null;
            $StorageLocation    = !empty($_POST[$columns[5]]) ? $_POST[$columns[5]] : null;
            $ContactPerson      = !empty($_POST[$columns[6]]) ? $_POST[$columns[6]] : null;
            $Photo              = !empty($_POST[$columns[7]]) ? $_POST[$columns[7]] : null;
            $itemName           = !empty($_POST[$columns[8]]) ? $_POST[$columns[8]] : null;
            
            $kw2 = "UPDATE `items` SET ";
            $updateValues = array();
            //print $itemName;
            if (!empty($ItemGroup)) {
                $updateValues[] = "`ItemGroup` = '$ItemGroup'";
            }
            if (!empty($UnitOfMeasurement)) {
                $updateValues[] = "`UnitOfMeasurement` = '$UnitOfMeasurement'";
            }
            if (!empty($Quantity)) {
                $updateValues[] = "`Quantity` = '$Quantity'";
            }
            if (!empty($PriceWithoutVAT)) {
                $updateValues[] = "`PriceWithoutVAT` = '$PriceWithoutVAT'";
            }
            if (!empty($Status)) {
                $updateValues[] = "`Status` = '$Status'";
            }
            if (!empty($StorageLocation)) {
                $updateValues[] = "`StorageLocation` = '$StorageLocation'";
            }
            if (!empty($ContactPerson)) {
                $updateValues[] = "`ContactPerson` = '$ContactPerson'";
            }
            if (!empty($Photo)) {
                $updateValues[] = "`Photo` = '$Photo'";
            }
            if (!empty($itemName)) {
                $updateValues[] = "`ItemName` = '$itemName'";
            }
            $kw2 .= implode(', ', $updateValues);
            $kw2 .= " WHERE ItemID=".$_GET["id"];
            //print $kw2;
            mysqli_query($con, $kw2); 
            $print = True;
		}
        
		mysqli_close($con);}

        if(isset($_GET["id"])){
        $con = mysqli_connect('localhost', 'root', '', 'warehouse');
        $kw1 = "SELECT * FROM items Where ItemID =".$_GET["id"];
        $res = mysqli_query($con, $kw1);
        $result = mysqli_fetch_row($res);
        $itemGroup = $result[2];
        $unitOfMeasurement = $result[3];
        echo'
        <div id="form">
		<form action="updateGoods.php?id='.$result[0].'" method="post" id="myForm">
            <label>
                Name:
                <input type="Text" name="itemName" value="'.$result[1].'"/>
            </label>
			<label>
                ItemGroup:
                <select name="ItemGroup" id="ItemGroup"> 
                    <option value="Loose"' . ($itemGroup == "Loose" ? ' selected' : '') . '>Loose</option> 
                    <option value="Light"' . ($itemGroup == "Light" ? ' selected' : '') . '>Light</option> 
                    <option value="Heavy"' . ($itemGroup == "Heavy" ? ' selected' : '') . '>Heavy</option> 
                    <option value="Tools"' . ($itemGroup == "Tools" ? ' selected' : '') . '>Tools</option> 
                    <option value="Materials"' . ($itemGroup == "Materials" ? ' selected' : '') . '>Materials</option>
                </select>
			</label>
			<label>
                UnitOfMeasurement:
				<select name="UnitOfMeasurement" id="UnitOfMeasurement"> 
                    <option value="SI"' . ($unitOfMeasurement == "SI" ? ' selected' : '') . '>SI</option> 
                    <option value="Imperial"' . ($unitOfMeasurement == "Imperial" ? ' selected' : '') . '>Imperial</option> 
                </select>
			</label>
            <label>
                Quantity:
				<input type="number" name="Quantity" value="'.$result[4].'"/>
			</label>
            <label>
                PriceWithoutVAT:
				<input type="number" step="0.01" name="PriceWithoutVAT" value="'.$result[5].'"/>
			</label>
            <label>
                Status:
				<input type="text" name="Status" value="'.$result[6].'"/>
			</label>
            <label>
                StorageLocation:
				<input type="text" name="StorageLocation" value="'.$result[7].'"/>
			</label>
            <label>
                ContactPerson:
				<input type="text" name="ContactPerson" value="'.$result[8].'"/>
			</label>
            <label>
				Photo:
				<input type="text" name="Photo" value="'.$result[9].'" />
			</label>
			<button>Update Item</button>
		</form>
        ';
        mysqli_close($con);}
        if($print){
            print "<p style='margin-bottom: 10px;'>Successfully updated item!</p>
            <a href='index.php' style='text-decoration: none;'>
                <div class='return' style='padding: 10px; background-color: #f0f0f0; border: 1px solid #ccc; cursor: pointer; display: inline-block;'>Go Back</div>
            </a>"; 
        }
        ?>
	</div>
</body>
</html>