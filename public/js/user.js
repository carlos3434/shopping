function createUser(e)
{
    e.preventDefault();

    var form_data = new FormData();
    form_data.append("name", $('#name').val() );
    form_data.append("email", $('#email').val() );
    form_data.append("phone", $('#phone').val() );
    form_data.append("address", $('#address').val() );
    form_data.append("role_type", $('#role_type').val() );
    form_data.append("password", $('#password').val() );

    $.ajax({
        url:  "/admin/user",
        type: "POST",
        data: form_data,
        contentType:false,
        cache:false,
        processData:false,
        success: function(response) {
            $('#user-form').trigger("reset");
            showAlert('#notify','alert-success', 'User created!');
            redirectTo("/admin/user");
        },
        error: function(xhr) {
            showAlert('#notify','alert-warning', xhr.responseJSON.message);
        }
    });
}
function updateUser(e, id)
{
    e.preventDefault();
    var form_data = new FormData();
    form_data.append("name", $('#name').val());
    form_data.append("email", $('#email').val());
    form_data.append("phone", $('#phone').val());
    form_data.append("address", $('#address').val());
    form_data.append("role_type", $('#role_type').val());
    if ( $('#password').val() != '' ) {
        form_data.append("password", $('#password').val());
    }
    form_data.append("_method", 'PUT');

    $.ajax({
        url:  "/admin/user/"+id,
        type: "POST",
        data: form_data,
        contentType:false,
        cache:false,
        processData:false,
        success: function(response) {
            showAlert('#notify','alert-success', 'User updated!');
        },
        error: function(xhr) {
            showAlert('#notify','alert-warning', xhr.responseJSON.message);
        }
    });
}

function deleteUser(e, id)
{
    e.preventDefault();
    $.ajax({
        url:  "/admin/user/" + id ,
        type: "DELETE",
        success: function(response) {
            $( "#user-" + id ).remove();
            showAlert('#notify','alert-success', 'User deleted!');
        },
        error: function(xhr) {
            showAlert('#notify','alert-warning', xhr.responseJSON.message);
        }
    })
}
