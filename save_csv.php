<?php
// Get CSV content and file name from the AJAX request
$csvContent = $_POST['csvContent'];
$fileName = $_POST['fileName'];

// Save CSV content to the "temp" folder
$filePath = dirname(__FILE__) . '/temp/' . $fileName . '.csv';
$file = fopen($filePath, 'w');
fwrite($file, $csvContent);
fclose($file);

// Send response back to the client
http_response_code(200);
?>