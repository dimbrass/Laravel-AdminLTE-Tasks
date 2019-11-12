function label_del(id, field, label)
{
    var link = 'task/label-del/?task_id=' + id + '&task_field=' + field;
    var msg = 'Удалить метку "' + label + '"?';                              //  alert(link);
    if (confirm(msg)) {
                    $( "#label-" + field + "-"   + id ).remove();
                    $( "#label-" + field + "-x-" + id ).remove();
        go_ajax(link);
    }
}



function go_ajax(link)
{
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: "application/json; charset=utf-8"
        });

        $.ajax({
            type: 'POST',
            url: link,
            dataType: 'json',
            data: JSON.stringify({link}),
            success: function(data) {                      // alert(data.task_id);
                var newlabel = '';
                switch (data.act) {
                    case 'complete':
                        newlabel = '<span class="label label-success" id="label-completed_at-' + data.task_id + '">Выполнена</span> <span class="label label-danger label-del pointer" id="label-completed_at-x-' + data.task_id + '" data-task-label="Выполнена" data-task-id="' + data.task_id + '" data-task-field="completed_at">x</span><br>';
                        break;
                    case 'complete_part':
                        newlabel = '<span class="label label-warning" id="label-completed_part-' + data.task_id + '">Выполнена частично</span> <span class="label label-danger label-del pointer" id="label-completed_part-x-' + data.task_id + '" data-task-label="Выполнена частично" data-task-id="' + data.task_id + '" data-task-field="completed_part">x</span><br>';
                        break;
                    case 'add_time':
                        newlabel = '<span class="label label-primary" id="label-add_time-' + data.task_id + '">Продлить до ' + data.add_time.substr(0, 22) + '</span> <span class="label label-danger label-del pointer" id="label-add_time-x-' + data.task_id + '" data-task-label="Продлить до ' + data.add_time.substr(0, 22) + '" data-task-id="' + data.task_id + '" data-task-field="add_time">x</span><br>';
                        break;
                    case 'report':
                        newlabel = '<span class="label label-info id="label-report_id-' + data.task_id + '">Отчет</span> <span class="label label-danger label-del pointer" id="label-report_id-x-' + data.task_id + '" data-task-label="Отчет" data-task-id="' + data.task_id + '" data-task-field="report_id">x</span><br>';
                        break;
                    case 'delete':
                        newlabel = '<span class="label label-danger" id="label-deleted_at-' + data.task_id + '">Удалена</span> <span class="label label-danger label-del pointer" id="label-deleted_at-x-' + data.task_id + '" data-task-label="Удалена" data-task-id="' + data.task_id + '" data-task-field="deleted_at">x</span><br>';
                        break;
                }
                $( "#td-task-labels-" + data.task_id ).prepend(newlabel);
                                                                                       /// вешаю обработчик события на крестик рядом
                $( "#label-"+ data.field +"-x-" + data.task_id ).on('click', function (e) {
                    label_del(data.task_id, data.field, '');
                });
                                                                         /*
                if (data.act == 'label_del') {
                    $( "#label-" + data.field + "-"   + data.task_id ).remove();
                    $( "#label-" + data.field + "-x-" + data.task_id ).remove();
                }*/
            },
            error: function (msg) {
                alert(data.error);
            }
        });
}



$(document).ready(function () {

        $('.label-del').on('click', function (e) {
            label_del($(this).data('task-id'), $(this).data('task-field'), $(this).data('task-label'));
        });

        $('.link-report').on('click', function (e) {
        var arr_phones = [];
            taskname = $(this).data('task-name');
            firstname = $(this).data('user-firstname');
            lastname = $(this).data('user-lastname');
            phones = $(this).data('user-phones');
            $('#modalReportH4').html(taskname);
            $('#modalReport #firstName').val(firstname);
            $('#modalReport #lastName').html(lastname);
            $('#modalReport').modal('show');
        });

        $('ul.task-acts a').on('click', function (e) {
            var link = $(this).attr('href');
            e.preventDefault();

            if (link.substr(5, 8) == 'add-time') {
                var add_time = prompt("Введите дополнительную дату завершения задачи:", "2019-11-22");
                if (add_time > "") {
                    link = link + "&add_time=" + add_time;
                }
            }
            if (link.substr(5, 6) == 'report') {
                $('#modalReportLabel').html('');
                $('#modalReport').modal('show');
            }

            go_ajax(link);
        });
});