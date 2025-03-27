<?php

// Form to add a new vehicle

require_once('../model/database.php');
require_once('../model/vehicles_db.php');
require_once('../model/makes_db.php');
require_once('../model/types_db.php');
require_once('../model/classes_db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
    $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
    $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
    $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);

    if ($year && $model && $price && $make_id && $type_id && $class_id) {
        add_vehicle($year, $model, $price, $type_id, $class_id, $make_id);
        header("Location: index.php");
        exit();
    } else {
        echo "<p style='color:red;'>Please fill out the form correctly.</p>";
    }
}

$makes = get_all_makes();
$types = get_all_types();
$classes = get_all_classes();

include('../view/admin_header.php');
?>

<h1>Add New Vehicle</h1>

<form action="add_vehicle.php" method="post">
    <label>Year:</label>
    <input type="number" name="year" required><br>

    <label>Model:</label>
    <input type="text" name="model" required><br>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" required><br>

    <label>Make:</label>
    <select name="make_id" required>
        <?php foreach ($makes as $make) : ?>
            <option value="<?= $make['make_id']; ?>"><?= $make['make']; ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Type:</label>
    <select name="type_id" required>
        <?php foreach ($types as $type) : ?>
            <option value="<?= $type['type_id']; ?>"><?= $type['type']; ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Class:</label>
    <select name="class_id" required>
        <?php foreach ($classes as $class) : ?>
            <option value="<?= $class['class_id']; ?>"><?= $class['class']; ?></option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit">Add Vehicle</button>
</form>

<p><a href="index.php">Back to Admin Home</a></p>

<?php include('../view/footer.php'); ?>
