<?php

// Admin dashboard for Zippy Used Autos

require_once('../model/database.php');
require_once('../model/vehicles_db.php');
require_once('../model/makes_db.php');
require_once('../model/types_db.php');
require_once('../model/classes_db.php');

$vehicles = get_vehicles();

include('../view/admin_header.php');
?>

<h1>Admin - Zippy Used Autos</h1>

<nav>
    <a href="index.php">Vehicle List</a> |
    <a href="add_vehicle.php">Add Vehicle</a> |
    <a href="edit_makes.php">Edit Makes</a> |
    <a href="edit_types.php">Edit Types</a> |
    <a href="edit_classes.php">Edit Classes</a>
</nav>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Year</th>
            <th>Make</th>
            <th>Model</th>
            <th>Type</th>
            <th>Class</th>
            <th>Price ($)</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vehicles as $v) : ?>
            <tr>
                <td><?= $v['year']; ?></td>
                <td><?= $v['make']; ?></td>
                <td><?= $v['model']; ?></td>
                <td><?= $v['type']; ?></td>
                <td><?= $v['class']; ?></td>
                <td><?= number_format($v['price'], 2); ?></td>
                <td>
                    <form action="delete_vehicle.php" method="post">
                        <input type="hidden" name="vehicle_id" value="<?= $v['vehicle_id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include('../view/footer.php'); ?>
