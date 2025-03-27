<?php include('header.php'); ?>

<h1>Zippy Used Autos</h1>

<form method="get" action="../controllers/vehicles.php">
    <label for="sort_by">Sort by:</label>
    <select name="sort_by" id="sort_by">
        <option value="price">Price (High to Low)</option>
        <option value="year">Year (New to Old)</option>
    </select>

    <label for="filter_type">Filter by:</label>
    <select name="filter_type" id="filter_type">
        <option value="">-- None --</option>
        <option value="make_id">Make</option>
        <option value="type_id">Type</option>
        <option value="class_id">Class</option>
    </select>

    <select name="filter_value" id="filter_value">
        <option value="">-- Select Value --</option>
        <?php
        if ($filter_type == 'make_id') {
            foreach ($makes as $make) {
                echo "<option value=\"{$make['make_id']}\">{$make['make']}</option>";
            }
        } elseif ($filter_type == 'type_id') {
            foreach ($types as $type) {
                echo "<option value=\"{$type['type_id']}\">{$type['type']}</option>";
            }
        } elseif ($filter_type == 'class_id') {
            foreach ($classes as $class) {
                echo "<option value=\"{$class['class_id']}\">{$class['class']}</option>";
            }
        }
        ?>
    </select>

    <button type="submit">Apply</button>
</form>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Year</th>
            <th>Make</th>
            <th>Model</th>
            <th>Type</th>
            <th>Class</th>
            <th>Price ($)</th>
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
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include('footer.php'); ?>
