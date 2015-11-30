<?php

// include database connection
include 'conexion.php';

// get record ID
// isset() is a PHP function used to verify if a value is there or not
$dni = isset($_GET['dni']) ? $_GET['dni'] : die('ERROR: Record ID not found.');

// delete query
$query = "DELETE FROM profesores WHERE dni = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('s', $dni);

if ($stmt->execute()) {
    // redirect to read records page and 
    // tell the user record was deleted
    header('Location: leer.php?action=deleted');
} else {
    die('Unable to delete record.');
}
?>
