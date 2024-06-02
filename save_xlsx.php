<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Get CSV content and file name from the AJAX request
$csvContent = $_POST['csvContent'];
$fileName = $_POST['fileName'];

// Create a new spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Split CSV content into rows
$rows = explode("\n", $csvContent);
foreach ($rows as $rowIndex => $row) {
    $columns = explode(",", $row);
    foreach ($columns as $colIndex => $column) {
        $sheet->setCellValueByColumnAndRow($colIndex + 1, $rowIndex + 1, $column);
    }
}

// Save XLSX file to the "temp" folder
$filePath = dirname(__FILE__) . '/temp/' . $fileName . '.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($filePath);

// Send response back to the client
http_response_code(200);
?>