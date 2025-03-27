<?php

// Add and delete types

require_once('../model/database.php');
require_once('../model/types_db.php');

$error = '';

// Handle Add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['type_name'])) {
    $type = filter_input(INPUT_POST, 'type_name', FILTER_SANITIZE_STRING);
    if ($type) {
        add_type($type);
        header("Location: edit_types.php");
        exit();
    } else {
        $error = "Invalid type name.";
    }
}

// Handle Delete
if (isset($_POST['delete_type_id'])) {
    $type_id = filter_input(INPUT_POST, 'delete_type_id', FILTER_VALIDATE_INT);
    if ($type_id) {
        delete_type($type_id);
        header("Location: edit_types.php");
        exit();
    }
}

$types = get_all_types();

include('../view/admin_header.php');
?>

<h1>Edit Types</h1>

<?php if ($error) : ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>

<form action="edit_types.php" method="post">
    <label for="type_name">Add Type:</label>
    <input type="text" name="type_name" required>
    <button type="submit">Add</button>
</form>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($types as $type) : ?>
            <tr>
                <td><?= $type['type']; ?></td>
                <td>
                    <form method="post" action="edit_types.php">
                        <input type="hidden" name="delete_type_id" value="<?= $type['type_id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p><a href="index.php">Back to Admin Home</a></p>

<?php include('../view/footer.php'); ?>
