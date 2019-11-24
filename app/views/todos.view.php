<?php require 'partials/header.php'; ?>

<br>
<form method="POST" action="/addtodo">
    <input type="text" name="description" id="description" placeholder="Add new task" />
    <button type="submit">Submit</button>
</form>
<br>

<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>DESCRIPTION</td>
            <td>COMPLETED</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task) : ?>
            <tr>
                <td><?= $task->id ?></td>
                <td><?= $task->description ?></td>
                <td><?= $task->completed ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require 'partials/footer.php'; ?>