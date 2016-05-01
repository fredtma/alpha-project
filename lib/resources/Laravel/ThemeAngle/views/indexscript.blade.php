<script>
    $(document).ready(function () {
        $('#datatable').footable();
        $("#pagination").attr('colspan',$("#datatable").find('tr')[0].cells.length);
    });
</script>
<script>
    $('.deletemodal').click(function () {
        var token = $(this).data('token');
        var id = $(this).data('id');
        var url = "<?php echo $controller; ?>";
        swal({
            title: "Delete Entry",
            text: "Are you sure you want to proceed?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#1ab394",
            confirmButtonText: "Delete",
            closeOnConfirm: false,
            customClass: 'btn'
        }, function () {
            $.ajax({
                url: url + '/' + id,
                type: 'POST',
                data: {_method: 'delete', _token: token}
            }).done(function () {
                swal({
                    title: "Success",
                    text: "Entry has been deleted successfully.",
                    type: "success",
                    closeOnConfirm: false,
                    confirmButtonColor: "#1ab394",
                    confirmButtonText: "Okay",
                }, function () {
                    location.reload();
                });
            });
        });
    });
</script>
