$(function () {
    function loadTable() {
        $.ajax({
            url: '/task/taskListTable/' + $(location).attr('search'),
            success: function (data) {
                $('#taskList').html(data);
            }
        })
    }

    function clear() {
        $('#success').html('');
        $('#error').html('');
    }

    $.ajax({
        url: $(location).attr('href'),
        success: function (data) {
            $('#result').html(data);
            if ($('#taskList')) {
                loadTable();
            }
        }
    });

    $(document).on('click', '#loginPage, #taskPage, #logout', function (event) {
        ajaxLink($(this).attr("href"));
        event.preventDefault();

    });

    function ajaxLink(url) {
        clear();
        $.ajax({
            url: url,
            success: function (data) {
                $('#result').html(data);
                history.pushState(null, null, url);
                if ($(location).attr('pathname') == "/task/taskList/") {
                    loadTable();
                }
                if (data.success) {
                    if (data.action == "redirect") {
                        window.location.href = data.redirectUrl;
                    }
                }
            }

        })
    }

    $(document).on('click', '.column_sort, .total_pages', function (event) {
        ajaxSort($(this));
        event.preventDefault();
    });

    function ajaxSort(from) {
        let order = from.attr("id");
        let sort = from.data("sort");
        let page = from.data("page");
        let pathUrl=$(location).attr('search').split("&");

        $.ajax({
            url: "/task/taskListTable/",
            method: "GET",
            data: {page: page, order: order, sort: sort},
            success: function (data) {
                if (page) {
                    if (pathUrl[1]) {
                        history.pushState(null, null, '/task/taskList/?page=' + page + '&' + pathUrl[1] + '&' + pathUrl[2]);
                    } else {
                        history.pushState(null, null, '/task/taskList/?page=' + page);
                    }
                }
                if (sort && order) {
                    if (pathUrl[1]) {
                        history.pushState(null, null, '/task/taskList/' + pathUrl[0] + '&order=' + order + '&sort=' + sort);
                    } else {
                        history.pushState(null, null, '/task/taskList/' + $(location).attr('search') + '&order=' + order + '&sort=' + sort);
                    }
                }
                $('#taskList').html(data);
            }
        })
    }

    $(document).on('submit', '#login_form, #task_form, #edit_form', function (event) {
        ajaxForm($(this),  $(this).data("action"), event);
    });

    function ajaxForm(form, action, event) {
        event.preventDefault();
        clear();
        $.ajax({
            url: action,
            data: form.serialize(),
            type: 'POST',
            success: function (data) {
                if (data.success) {
                    if (data.action == "redirect") {
                        window.location.href = data.redirectUrl;
                    }
                    if (data.action == "add") {
                        $.ajax({
                            url: data.addUrl + '/' + $(location).attr('search'),
                            success: function (data) {
                                $('#taskList').html(data);
                            }
                        })
                    }
                    $('#success').html(data.message);

                } else {
                    $('#error').html(data.message);
                }

            }
        });
    }
});
