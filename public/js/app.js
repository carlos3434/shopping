function calculatePrice(unit_price, car_id)
{
    var qty = $('#qty-' + car_id).val();
    $('#total-' + car_id).html(qty * unit_price);

    updateGrandTotal();
}
function redirectTo(url)
{
    setTimeout(function(){
        window.location.href=url; 
    }, 3000);
}
function showAlert(id, classAlert, message){
    $(id).addClass(classAlert).show().html(message);
    setTimeout(function(){
        $(id).addClass(classAlert).show().hide() 
    }, 2000);
}
function addToCart(e, id)
{
    e.preventDefault();
    $.ajax({
        url:  "/order",
        type: "POST",
        data: {
            car_id: id
        },
        success: function(response) {
            $('#add-cart-' + id).addClass('disabled');
            showAlert('#notify-' + id,'alert-success', 'Added!');
        },
        error: function(xhr) {
            showAlert('#notify-' + id,'alert-warning', xhr.responseJSON.message);
        }
    });
}