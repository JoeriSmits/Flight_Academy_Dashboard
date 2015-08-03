$(document).ready(function () {
    runBind();
    function runBind() {

        /**
         * Deletes a task in the To Do list
         */
        $('.destroy').on('click', function (e) {
            var $currentListItem = $(this).closest('li');
            var $currentListItemLabel = $currentListItem.find('label');
            $('#main-content').trigger('heightChange');
            $.ajax({
                url: 'dashboard/deleteToDo',
                type: 'post',
                data: 'message=' + $currentListItemLabel.text().trim()
            }).success(function (data) {
                console.log(data);
                $currentListItem.remove();
            }).error(function () {
                alert("Error deleting this item. This item was not deleted, please try again.");
            })
        });

        /**
         * Finish the to do task or unfinish it depending on the data attribute.
         */
        $('.toggle').on('click', function (e) {
            var $currentListItemLabel = $(this).closest('li').find('label');
            /*
             * Do this or add css and remove JS dynamic css.
             */
            if ($currentListItemLabel.attr('data') == 'done') {
                $.ajax({
                    url: 'dashboard/finishToDo',
                    type: 'post',
                    data: 'message=' + $currentListItemLabel.text().trim() + '&finish=' + false
                }).success(function (data) {
                    $currentListItemLabel.attr('data', '');
                    $currentListItemLabel.css('text-decoration', 'none');
                }).error(function () {
                    alert("Error updating this item. This item was not updated, please try again.");
                })
            }
            else {
                $.ajax({
                    url: 'dashboard/finishToDo',
                    type: 'post',
                    data: 'message=' + $currentListItemLabel.text().trim() + '&finish=' + true
                }).success(function (data) {
                    $currentListItemLabel.attr('data', 'done');
                    $currentListItemLabel.css('text-decoration', 'line-through');
                }).error(function () {
                    alert("Error updating this item. This item was not updated, please try again.");
                })
            }
        });
    }

    $todoList = $('#todo-list');

    /**
     * Add a new To Do task.
     */
    $("#frm_toDo").submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var method = $(this).attr('method');
        var data = $(this).serialize();
        $.ajax({
            url: url,
            type: method,
            data: data
        }).success(function (data) {
            addItemToHTMLList();
            $('#new-todo').val('');
        }).error(function () {
            alert("Error saving this task. This task has not been saved, please try again.");
        });
    });

    /**
     * Adds the task that has been created directly to the HTML page
     */
    var addItemToHTMLList = function () {
        $('.destroy').off('click');
        $('.toggle').off('click');
        var todos = "";
        todos +=
            "<li>" +
            "<div class='view'>" +
                "<div class='row'>" +
                    "<div class='col-xs-1'>" +
                        "<input class='toggle' type='checkbox'>" +
                    "</div>" +
                    "<div class='col-xs-10'>" +
                        "<label id='item'>" + " " + $('#new-todo').val() + "</label>" +
                    "</div>" +
                    "<div class='col-xs-1'>" +
                        "<a class='destroy'></a>" +
                    "</div>" +
                "</div>" +
            "</div>" +
            "</li>" + $todoList.html();
        $todoList.html(todos);
        runBind();
        $('#main').show();
    }
});

