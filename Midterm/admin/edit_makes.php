<?php

// Add and delete makes

require_once('../model/database.php');
require_once('../model/makes_db.php');

$error = '';

// Handle Add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['make_name'])) {
    $make = filter_input(INPUT_POST, 'make_name', FILTER_SANITIZE_STRING);
    if ($make) {
        add_make($make);
        header("Location: edit_makes.php");
        exit();
    } else {
        $error = "Invalid make name.";
    }
}

// Handle Delete
if (isset($_POST['delete_make_id'])) {
    $make_id = filter_input(INPUT_POST, 'delete_make_id', FILTER_VALIDATE_INT);
    if ($make_id) {
        delete_make($make_id);
        header("Location: edit_makes.php");
        exit();
    }
}

$makes = get_all_makes();

include('../view/admin_header.php');
?>

<h1>Edit Makes</h1>

<!-- Show errors if any -->
<?php if ($error) : ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>

<!-- Add Make Form -->
<form action="edit_makes.php" method="post">
    <label for="make_name">Add Make:</label>
    <input type="text" name="make_name" required>
    <button type="submit">Add</button>
</form>

<!-- Existing Makes -->
<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Make</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($makes as $make) : ?>
            <tr>
                <td><?= $make['make']; ?></td>
                <td>
                    <form method="post" action="edit_makes.php">
                        <input type="hidden" name="delete_make_id" value="<?= $make['make_id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p><a href="index.php">Back to Admin Home</a></p>

<?php include('../view/footer.php'); ?>
