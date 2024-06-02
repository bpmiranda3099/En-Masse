function showLightbox() {
	document.getElementById("lightbox").style.display = "block";

}

function hideLightbox() {
	document.getElementById("lightbox").style.display = "none";

	// Remove the event listener when hiding the lightbox
	window.removeEventListener("click", windowClickHandler);
}

document.getElementById("tableSelect").addEventListener("change", function() {
	if (this.value !== "Select Table") {
		fetchTableData(this.value); // Call function to fetch table data
	} else {
		hideLightbox();
	}
});

function fetchTableData(tableName) {
	fetch('http://127.0.0.1:5000/fetch_table_data', { // Change the URL to match your Flask server's URL
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({
			table_name: tableName
		})
	})
	.then(response => {
		if (!response.ok) {
			throw new Error('Network response was not ok');
		}
		return response.json();
	})
	.then(data => {
		if (data.table_data) {
			updateTable(data.table_data);
			showLightbox(); // Call showLightbox() here
		} else {
			console.error('Failed to fetch table data');
		}
	})
	.catch(error => {
		console.error('Error fetching table data:', error);
	});
}

function updateTable(tableData) {
	const tableBody = document.getElementById("tableBody");
	tableBody.innerHTML = ""; // Clear existing table data

	tableData.forEach(rowData => {
		const row = document.createElement("tr");
		const nameCell = document.createElement("td");
		const emailCell = document.createElement("td");

		const nameInput = document.createElement("input");
		nameInput.type = "text";
		nameInput.value = rowData.name; // Assuming 'name' is the key for the name data

		const emailInput = document.createElement("input");
		emailInput.type = "text";
		emailInput.value = rowData.email; // Assuming 'email' is the key for the email data

		nameCell.appendChild(nameInput);
		emailCell.appendChild(emailInput);

		row.appendChild(nameCell);
		row.appendChild(emailCell);

		tableBody.appendChild(row);
	});
}

document.getElementById("close-lightbox").addEventListener("click", function() {
	hideLightbox();
});

function validateSelection() {
var selectBox = document.getElementById("tableSelect");
var selectedValue = selectBox.options[selectBox.selectedIndex].value;
if (selectedValue === "Select Table") {
	alert("Please select data.");
	return false;
}
return true;
}

document.getElementById("export-lightbox").addEventListener("click", function() {
	var selectBox = document.getElementById("tableSelect");
	var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	if (selectedValue === "Select Table") {
		alert("Please select data.");
	} else {
		window.location.href = `http://127.0.0.1:5000/export_table?table_name=${selectedValue}`;
	}
});

		