<?php

// Add and delete classes

require_once('../model/database.php');
require_once('../model/classes_db.php');

$error = '';

// Handle Add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['class_name'])) {
    $class = filter_input(INPUT_POST, 'class_name', FILTER_SANITIZE_STRING);
    if ($class) {
        add_class($class);
        header("Location: edit_classes.php");
        exit();
    } else {
        $error = "Invalid class name.";
    }
}

// Handle Delete
if (isset($_POST['delete_class_id'])) {
    $class_id = filter_input(INPUT_POST, 'delete_class_id', FILTER_VALIDATE_INT);
    if ($class_id) {
        delete_class($class_id);
        header("Location: edit_classes.php");
        exit();
    }
}

$classes = get_all_classes();

include('../view/admin_header.php');
?>

<h1>Edit Classes</h1>

<?php if ($error) : ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>

<form action="edit_classes.php" method="post">
    <label for="class_name">Add Class:</label>
    <input type="text" name="class_name" required>
    <button type="submit">Add</button>
</form>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Class</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($classes as $class) : ?>
            <tr>
                <td><?= $class['class']; ?></td>
                <td>
                    <form method="post" action="edit_classes.php">
                        <input type="hidden" name="delete_class_id" value="<?= $class['class_id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p><a href="index.php">Back to Admin Home</a></p>

<?php include('../view/footer.php'); ?>
