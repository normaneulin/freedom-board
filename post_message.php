<?php
$filename = 'messages.csv';

// Only process if the request is a POST

// TODO: TASK 2 - Check that message and name are not empty, otherwise
//        redirect back to index.php. Use the PHP's empty() function to check 
//        if the variable is set. 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty(trim($_POST['name'])) || empty(trim($_POST['message']))){
        header("Location: index.php");
        exit();
    }
	// TODO: TASK 3 - Get data from $_POST and sanitize it
    // Hint: use htmlspecialchars()
    $name = htmlspecialchars($_POST['name']); 
    $message = htmlspecialchars($_POST['message']);
    $timestamp = date('Y-m-d H:i:s');

    // TODO: TASK 4 - Open the file in Append mode ('a')
	// Hint: 
    $handle = fopen($filename, 'a');

    // TODO: TASK 5 - Use fputcsv() to save the [$name, $message, $timestamp] array
    fputcsv($handle, [$name, $message, $timestamp]);
    // TODO: TASK 6 - Close the file handle
    fclose($handle);
    // Redirect back to main page
    header("Location: index.php");
    exit(); // Always exit after a redirect
} else {
    // TODO: Task 7 - If someone tries to access this file directly via browser (GET), send them back
	//        to index.php
   header("Location: index.php");
   exit();
}
?>
