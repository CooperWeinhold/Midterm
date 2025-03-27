<?php

// Handles vehicle deletion

require_once('../model/database.php');
require_once('../model/vehicles_db.php');

$vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);

if ($vehicle_id) {
    delete_vehicle($vehicle_id);
    header("Location: index.php"); // Redirect back to admin page
    exit();
} else {
    echo "Error: Invalid vehicle ID.";
}
?>
