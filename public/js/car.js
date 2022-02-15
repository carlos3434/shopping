$( document ).ready(function() {
    calculatePrice();
});

function removeFromCart(e, id)
{
    e.preventDefault();
    $.ajax({
        url:  "/order/" + id,
        type: "DELETE",
        success: function(response) {
            $( "#item-" + id ).remove();
            updateGrandTotal();
        },
        error: function(xhr) {
            alert('There are some error processing request');
        }
    });
}

function updateGrandTotal()
{
    var total = 0;
    $('[id^=total-]').each(function(index, value) {
        var car_id = value.id.split("-")[1];
        var unit_price = $('#qty-' + car_id).val();
        var qty = parseInt($('#unit-' + car_id).innerHTML);
        total += parseInt(this.innerHTML);
        $('#grand-total').html(qty * unit_price);
    });

    $('#grand-total').html('$'+total);
}

function createCar(e)
{
    e.preventDefault();

    var form_data = new FormData();
    form_data.append("title",$('#title').val());
    form_data.append("description",$('#description').val());
    form_data.append("original_price", $('#original_price').val());
    form_data.append("actual_price", $('#actual_price').val());
    form_data.append("quantity", $('#quantity').val());
    form_data.append("model", $('#model').val());
    form_data.append("size", $('#size').val());
    form_data.append("registration", $('#registration').val());
    form_data.append("category_id", $('#category_id').val());
    form_data.append("status", $('input[name=status]:checked').val() );
    if (  document.querySelector('input[type="file"]').files.length > 0) {
        form_data.append("image",document.querySelector('input[type="file"]').files[0]);
    }

    $.ajax({
        url:  "/admin/car",
        type: "POST",
        contentType:false,
        cache:false,
        processData:false,
        data: form_data,
        enctype: 'multipart/form-data',
        success: function(response) {
            $('#car-form').trigger("reset");
            showAlert('#notify','alert-success', 'car created!');
            redirectTo("/admin/car");
        },
        error: function(xhr) {
            showAlert('#notify','alert-warning', xhr.responseJSON.message);
        }
    });
}
function updateCar(e, id)
{
    e.preventDefault();

    var form_data = new FormData();
    form_data.append("title",$('#title').val());
    form_data.append("description",$('#description').val());
    form_data.append("original_price", $('#original_price').val());
    form_data.append("actual_price", $('#actual_price').val());
    form_data.append("quantity", $('#quantity').val());
    form_data.append("model", $('#model').val());
    form_data.append("size", $('#size').val());
    form_data.append("registration", $('#registration').val());
    form_data.append("category_id", $('#category_id').val());
    form_data.append("status", $('input[name=status]:checked').val() );
    form_data.append("_method", 'PUT');

    if (  document.querySelector('input[type="file"]').files.length > 0) {
        form_data.append("image",document.querySelector('input[type="file"]').files[0]);
    }
    $.ajax({
        url:  "/admin/car/" + id,
        type: "POST",
        contentType:false,
        cache:false,
        processData:false,
        data: form_data,
        enctype: 'multipart/form-data',
        success: function(response) {
            showAlert('#notify','alert-success', 'car updated!');
        },
        error: function(xhr) {
            showAlert('#notify','alert-warning', xhr.responseJSON.message);
        }
    })
}

function deleteCar(e, id)
{
    e.preventDefault();
    $.ajax({
        url:  "/admin/car/" + id,
        type: "DELETE",
        success: function(response) {
            $( "#car-" + id ).remove();
            showAlert('#notify','alert-success', 'car deleted!');
        },
        error: function(xhr) {
            showAlert('#notify','alert-warning', xhr.responseJSON.message);
        }
    })
}