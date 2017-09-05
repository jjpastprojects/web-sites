var humanPrice = function(price) {
    return numeral(price).format('0,0').replace(',', '&nbsp;') + ' р.'
};

var Cart = function(form) {
    var cart_items = {},
        items = form.find('[data-cart=item]'),
        total_price = form.find('[data-cart=total-price]'),
        picture = form.find('[data-cart=picture]'),
        cart = this,
        cart_helper = $('[data-type=cart-helper]'),
        params = form.serialize()
    ;

    var CartItem = function(el) {
        var price = el.data('price'),
            price_view = el.find('[data-cart-item=price]'),
            quantity_input = el.find('[data-cart-item=quantity]'),
            variant = el.find('[data-cart-item=variant]'),
            picture = el.find('[data-cart-item=picture]'),
            originalPicture = picture.attr('src'),
            remove_btn = el.find('[data-cart-item=remove]'),
            cart_item = this
        ;

        this.id = el.data('item-id');
        
        var getPrice = function() {

            return price;
        };

        var getQuantity = function() {
            return quantity_input.val()/1;
        };

        var itemPrice = function() {

            var item_price = getPrice() * getQuantity();
            price_view.html(humanPrice(item_price));

            return item_price;
        };

        var changePicture = function(src) {
            if (src && picture.attr('src') != src)
                picture.attr('src', src);
            else if (!src)
                picture.attr('src', originalPicture);
        };

        var remove = function() {
            el.remove();
            cart.removeItem(cart_item.id);
        };

        variant.on('change', function() {
            var option = variant.find('option[value=' + $(this).val() + ']');

            price = option.data('price');
            changePicture(option.data('picture'));
            calculate();
        });

        quantity_input.on('change', function() {
            calculate();
        });

        remove_btn.on('click', function() {
            el.dequeue()
              .fadeOut()
              .slideUp(function() {
                remove();
              });
        });

        variant.trigger('change');

        this.price = function() {
            return itemPrice();
        };

        this.quantity = function() {
            return getQuantity();
        };
    };

    var calculate = function() {
        var totalPrice = 0,
            items_quantity = 0
        ;

        $.each(cart_items, function(i) {
            totalPrice += cart_items[i].price();
            items_quantity += cart_items[i].quantity();
        });

        total_price.html(humanPrice(totalPrice));
        cart_helper.html(items_quantity);

        var new_params = form.serialize();
        if (params != new_params)
        {
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                dataType: 'json',
                data: form.serialize()
            });

            params = new_params;
        }
    };

    items.each(function() {
        var cart_item = new CartItem($(this));
        cart_items[cart_item.id] = cart_item;
    });

    this.removeItem = function(id) {
        delete cart_items[id];
        calculate();
    }

    calculate();
};

$(document).on('ready page:load', function() {
    $('[data-type=cart]').each(function() {
        new Cart($(this));
    });
});