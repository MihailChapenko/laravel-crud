import Swal from "sweetalert2";

$(document).ready(function () {
    $('#createUser').on('click', function () {
        $('#createUserModal').modal('show');
    });

    $('#createUserSubmit').on('click', function() {
        let name = $('#userName').val(),
            email = $('#userEmail').val();

        $.ajax({
            type: 'post',
            url: 'create_user',
            data: {
                userName: name,
                userEmail: email,
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.message,
                    type: 'error',
                })
            },
            success: function (data) {
                $('#userName').val("");
                $('#userEmail').val("");
                $('#createUserModal').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'User has been created',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    });

    $('#userTable').on('click', '.edit-user', function () {
        let id = $(this).attr('id-user');

        $.ajax({
            type: 'get',
            url: 'get_user',
            data: { id: id},
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.message,
                    type: 'error',
                })
            },
            success: function (data) {
                $('#createUserSubmit').hide();
                $('#editUserSubmit').removeAttr('hidden');
                $('#userId').val(data.user.id);
                $('#userName').val(data.user.name);
                $('#userEmail').val(data.user.email);
                $('#createUserModal').modal('show');
            }
        });
    });

    $('#editUserSubmit').on('click', function() {
        let id = $('#userId').val(),
            name = $('#userName').val(),
            email = $('#userEmail').val();

        $.ajax({
            type: 'put',
            url: 'edit_user',
            data: {
                id: id,
                userName: name,
                userEmail: email
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.message,
                    type: 'error',
                })
            },
            success: function (data) {
                $('#createUserSubmit').text('Create');
                $('#userId').val("");
                $('#userName').val("");
                $('#userEmail').val("");
                $('#createUserModal').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'User has been updated',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    });

    $('#userTable').on('click', '.delete-user', function () {
        let id = $(this).attr('id-user');

        Swal.fire({
            title: 'Are you sure?',
            text: "No way back",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, I want to delete it'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'delete',
                    url: 'delete_user',
                    data: {
                        id: id
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: error.responseJSON.message,
                            type: 'error',
                        })
                    },
                    success: function(data) {
                        if (data.success) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'center',
                                showConfirmButton: false,
                                timer: 3000
                            });

                            Toast.fire({
                                type: 'success',
                                title: 'User was deleted'
                            });

                            $("#userTable tbody").find("[id-user='" + id + "']").remove();
                        }
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    });
})
