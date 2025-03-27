<?php

// vehicles_db.php - Queries for the vehicles table

require_once('database.php');

// Get all vehicles with optional sorting and filtering
function get_vehicles($sort_by = 'price', $filter_type = '', $filter_value = '') {
    global $db;

    $allowed_sort = ['price', 'year'];
    $sort_by = in_array($sort_by, $allowed_sort) ? $sort_by : 'price';

    $query = "SELECT v.*, m.make, t.type, c.class
              FROM vehicles v
              JOIN makes m ON v.make_id = m.make_id
              JOIN types t ON v.type_id = t.type_id
              JOIN classes c ON v.class_id = c.class_id";

    if ($filter_type && $filter_value) {
        $query .= " WHERE v.{$filter_type} = :filter_value";
    }

    $query .= " ORDER BY v.{$sort_by} DESC";

    $statement = $db->prepare($query);
    if ($filter_type && $filter_value) {
        $statement->bindValue(':filter_value', $filter_value);
    }
    $statement->execute();
    $vehicles = $statement->fetchAll();
    $statement->closeCursor();

    return $vehicles;
}

function delete_vehicle($vehicle_id) {
    global $db;
    $query = 'DELETE FROM vehicles WHERE vehicle_id = :vehicle_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':vehicle_id', $vehicle_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_vehicle($year, $model, $price, $type_id, $class_id, $make_id) {
    global $db;
    $query = 'INSERT INTO vehicles (year, model, price, type_id, class_id, make_id)
              VALUES (:year, :model, :price, :type_id, :class_id, :make_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':model', $model);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':type_id', $type_id);
    $statement->bindValue(':class_id', $class_id);
    $statement->bindValue(':make_id', $make_id);
    $statement->execute();
    $statement->closeCursor();
}


?>
