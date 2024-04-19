$(document).ready(function () {
    $(".modal-load").on("click", function (e) {

        e.preventDefault();
        $('.modal-body').html('');

        $.ajax({
            type: 'get',
            url: $(this).attr('href'),
            success: function (data) {
                $(".modal-body").html(data);

            }
        });
    });



    $(document).on('submit', '.submitData', function (e) {
        e.preventDefault();
        console.log('click');
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            dataType: 'json',
            processData: false,
            success: function (data) {
                if (data.status == true) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.msg,
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                } else {

                    if (data.status == false) {
                        $('.error').text('');
                        $.each(data.error, function (key, value) {
                            $('.' + key + '_error').text(value);
                            // console.log('.' + key + '_error');
                        });
                    }
                }
            }
        });
    });


    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).attr('href');
        console.log(url + "----------" + id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: { id: id },
                    success: function (data) {
                        var jsonData = JSON.parse(data);
                        if (jsonData.status == true) {
                            Swal.fire(
                                'Deleted!',
                                jsonData.msg,
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                        else {
                            alert('Something went wrong!');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log('AJAX request failed:', error);
                    }
                });
            }
        });
    });

    $(document).ready(function () {
        $('#classId').change(function () {
            var classId = $(this).val();
            console.log(classId);
            $.ajax({
                type: 'GET',
                url: 'process.php',
                data: { class_id: classId },
                success: function (response) {
                    $('#bookSelect').html(response);
                }
            });
        });
    });


});


// ClassicEditor
//     .create(document.querySelector('#question'))
//     .catch(error => {
//         console.error(error);
//     });

