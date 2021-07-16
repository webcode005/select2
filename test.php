<?php

	$conn = mysqli_connect("localhost", "root", "", "test");

	if (isset($_POST["addInvoice"]))
	{
		$customerName = $_POST["customerName"];

		$sql = "INSERT INTO invoices (customerName) VALUES ('$customerName')";
		mysqli_query($conn, $sql);
		$invoiceId = mysqli_insert_id($conn);

//		for ($a = 0; $a < count($_POST["itemName"]); $a++)
//		{
//			$sql = "INSERT INTO items (invoiceId, itemName, itemQuantity) VALUES ('$invoiceId', '" . $_POST["itemName"][$a] . "', '" . $_POST["itemQuantity"][$a] . "')";
//			mysqli_query($conn, $sql);
//		}
        
         // for highlight pointer

        for ($a = 0; $a < count($_FILES["icon"]); $a++)
        {

          //Upload icon
      
        $icon=rand(1111111111,9999999999).'_'.$_FILES["icon"]["name"][$a];
        move_uploaded_file($_FILES['icon']['tmp_name'][$a], 'icon/'.$icon); 


          $sqlp = "INSERT INTO items (invoiceId, icon, itemQuantity) VALUES ('$invoiceId', '" . $_FILES["icon"]["name"][$a] . "', '" . $_POST["itemQuantity"][$a] . "')";
          mysqli_query($conn, $sqlp);
            
            //echo "Error: " . $sqlp . "<br>" . $conn->error;
        }


		echo "<p>Invoice has been added.</p>";
	}

?>

<form method="POST" enctype="multipart/form-data">
	<input type="text" name="customerName" placeholder="Enter customer name" required>

	<table>
		<tr>
			<th>#</th>
			<th>Icon</th>
			<th>Item Quantity</th>
		</tr>

		<tbody id="tbody"></tbody>
	</table>

	<p>
		<button type="button" onclick="addItem();">Add Item</button>
	</p>

	<input type="submit" name="addInvoice" value="Add Invoice">
</form>

<style type="text/css">
	table {
		width: 100%;
		border-collapse: collapse;
	}
	table tr td,
	table tr th {
		border: 1px solid black;
		padding: 25px;
	}
</style>

<script>
	var items = 0;
	function addItem() {
		items++;

		var html = "<tr>";
			html += "<td>" + items + "</td>";
			html += "<td><input type='file' name='icon[]'></td>";
			html += "<td><input type='number' name='itemQuantity[]'></td>";
		html += "</tr>";

		var row = document.getElementById("tbody").insertRow();
		row.innerHTML = html;
	}
</script>