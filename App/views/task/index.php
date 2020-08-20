<form class="form form-group" data-action='/task/addTask' id="task_form">
    <p>
    <div>
        <input class="form__input form-control"  type="text" id="name" name="name" placeholder="Enter name" value="">
    </div>
    <div>
        <input class="form__input form-control" type="text" id="email" name="email" placeholder="Enter email" value="">
    </div>

    <div>
        <textarea class="form__input form-control" id="task" name="task" placeholder="Enter task"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Add</button>
    </p>
</form>
<div id="taskList"></div>
