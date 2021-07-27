function dequeue(id) {

    toastr.options = {
        "closeButton": true,
        "preventDuplicates": true,
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "positionClass": "toast-top-right"
    }

    toastr.clear();

    $.post(
        'index.php?r=api/aircraft/dequeue ',
        {"id": id}
    )

        .done(function (result) {
            console.log("result:", result);
            if (result.status == 200) {
                toastr.success(result.detail);
                $.pjax.reload({container:'#pjaxwidget'});
            } else {
                toastr.error(result.detail);
            }
        })

        .fail(function () {
            console.log('Server error!');
            toastr.error('An error has occurred!');
        });

    return false;
}