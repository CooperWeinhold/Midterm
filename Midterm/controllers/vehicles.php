<?php

// vehicles.php - Public vehicle listing controller

require_once('../model/database.php');
require_once('../model/vehicles_db.php');
require_once('../model/makes_db.php');
require_once('../model/types_db.php');
require_once('../model/classes_db.php');


// Get filter and sort parameters from the URL
$sort_by = filter_input(INPUT_GET, 'sort_by', FILTER_SANITIZE_STRING);
$filter_type = filter_input(INPUT_GET, 'filter_type', FILTER_SANITIZE_STRING);
$filter_value = filter_input(INPUT_GET, 'filter_value', FILTER_SANITIZE_NUMBER_INT);

// Get vehicle list
$vehicles = get_vehicles($sort_by, $filter_type, $filter_value);

// Get dropdown data
$makes = get_all_makes();
$types = get_all_types();
$classes = get_all_classes();

// Load view
include('../view/vehicle_list.php');
?>
