const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
$(document).ready(function() {
    $('.add-to-cart').on('click', function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');
        var quantity = 1;

        $.ajax({
            url: '/cart/add/' + productId,
            type: 'POST',
            data: {
                _token: csrfToken,
                quantity: quantity,
            },
            success: function(response) {
                $('.cart-count').text(response.cart_count);
                $('#addToCartModal').modal('show');
            },
            error: function() {
                alert('Произошла ошибка. Попробуйте позже.');
            }
        });
    });

    $('.add-to-wishlist').on('click', function(e) {
        e.preventDefault();

        var productId = $(this).data('product-id');

        $.ajax({
            url: '/wishlist/add/' + productId,
            type: 'POST',
            data: {
                _token: csrfToken,
            },
            success: function(response) {
                alert('Товар добавлен в желаемое!');
            },
            error: function() {
                alert('Произошла ошибка. Попробуйте позже.');
            }
        });
    });
});
