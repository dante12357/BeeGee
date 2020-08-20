<?php if (isset($_SESSION['auth'])): ?>
    <form class="form form-group" data-action='/task/updateTask' id="edit_form">
        <input class="" type="hidden" value="<?php echo $data['id'] ?>"
               name="id" <?php if (1 == $data['performed']) echo('checked="checked"'); ?>>
        <p>
        <div>Name: <?php echo $data['name'] ?></div>
        <div>
            Task: <textarea class="form__input form-control" name="task"><?php echo $data['task'] ?></textarea></div>
        <div>
            <input class="" type="checkbox"
                   name="performed" <?php if (1 == $data['performed']) echo('checked="checked"'); ?>>
            <label class="form-check-label" for="defaultCheck1">
                Performed
            </label>
        </div>
        <button class="btn btn-primary" type="submit">Edit</button>
        </p>
    </form>
<?php else: ?>
    <span>Please log in</span>
<?php endif; ?>
