<?php
$sort = ($_GET['sort'] == 'DESC') ? 'ASC' : 'DESC'
?>

<table class="table  table-taskList table-bordered ">
    <thead>
    <tr>
        <th scope="col"><a class="column_sort" id="name" data-sort="<?php echo $sort ?>">Name</a></th>
        <th scope="col"><a class="column_sort" id="email" data-sort="<?php echo $sort ?>">Email</a></th>
        <th scope="col">Задача</th>
        <th scope="col"><a class="column_sort" id="performed" data-sort="<?php echo $sort ?>">Performed</a></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['data'] as $value): ?>
        <tr id="<?php echo $value['id'] ?>">
            <form id="edit_form"></form>
            <td><?php echo $value['name'] ?></td>
            <td><?php echo $value['email'] ?></td>
            <td><?php echo $value['task'] ?></td>
            <td>
                <?php if ($value['performed'])
                    echo("performed");
                else {
                    echo("not performed");
                }
                ?>
            </td>

            <?php if (isset($_SESSION['auth'])): ?>
                <td>
                    <a href="/task/edit/?id=<?php echo $value['id'] ?>" type="submit" class="edit">Edit</a>
                </td>
            <?php endif; ?>

            <?php if ($value['was_edit'] == 1): ?>
                <td>
                    Было отредактировано администратором
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
<nav>
    <ul class='pagination' id="pagination">
        <?php if (!empty($data['total_pages'])):for ($i = 1; $i <= $data['total_pages']; $i++):
            if ($i == $_GET['page']):?>
                <li class='page-item active' id="<?php echo $i; ?>"><span class="page-link "><?php echo $i; ?></span>
                </li>
            <?php else: ?>
                <li class='page-item ' id="<?php echo $i; ?>"><a class="total_pages page-link "
                                                                 data-page='<?php echo $i; ?>'><?php echo $i; ?></a>
                </li>
            <?php endif; ?>
        <?php endfor;endif; ?>
</nav>
