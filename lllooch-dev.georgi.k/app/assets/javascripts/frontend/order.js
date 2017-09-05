var Order = function (el) {
    var delivery_types = el.find('input[data-delivery-type]'),
        payment_types = function () {
            return el.find('[data-payment-type]')
        },
        free_translation = el.data('free'),
        address_view = $('[data-view=address]'),
        payment_view = $('[data-view=payment]'),
        delivery_view = function () {
            return el.find('[data-order=delivery-price]')
        },
        total_view = el.find('[data-order=total]'),
        map_view = function () {
            return el.find('[data-order=map]').first()
        },
        address_region = el.find('[data-layout=address]'),
        payment_region = el.find('[data-layout=payment]'),
        address = function () {
            return el.find('[data-order=address]').first()
        },
        address_wrap = function () {
            return el.find('[data-order=address-wrap]').first()
        },
        form = el.find('form'),
        submit_btn = el.find('[data-order=submit]'),
        delivery_price = undefined,
        delivery_hint = el.find('[data-order=delivery_price_desc]'),
        delivery_error = el.find('[data-order=delivery_price_error]'),
        delivery_fields = function () {
            return el.find('[data-delivery-calc]')
        },

        city = function () {
            return templates['address_and_payment'].find('[data-cart-kladr=city]').first()
        },

        street = function () {
            return templates['address_and_payment'].find('[data-cart-kladr=street]').first()
        },

        building = function () {
            return templates['address_and_payment'].find('[data-cart-kladr=building]').first()
        },

        site = function () {
            return templates['address_and_payment'].find('[data-cart-kladr=site]').first()
        },

        region = function () {
            return templates['address_and_payment'].find('[data-address=region]').first()
        },

        zip = function () {
            return templates['address_and_payment'].find('[data-address=zip]').first()
        },
//        site = function() { return el.find('[data-cart-kladr=building]').first() },

        delivery_type = false,
        params_to_save = ['country', 'city', 'region', 'zip', 'street', 'street_number', 'site', 'comment'],
        templates = {},
        data = {},
        calculateDelivery = false,
        old_vars = {},
        delivery_request = false,
        delivery_request_aborted = true
        ;

    var showPayment = function () {
        var template = _.template(payment_view.html());
        payment_region.html(template());

        payment_region.find('input[type=radio]').each(function () {
            new iRadio($(this));
        });

        payment_types().each(function () {
            if ($.inArray($(this).data('payment-type'), order_options.delivery_types[delivery_type].payment_types) < 0)
                $(this).remove();
        })
    };

    var showMap = function (search, show) {
        address().html(show);
        map_view().css('top', address_wrap().outerHeight());
        new StaticMap(map_view(), search);
    };

    form.submit(function (e) {
        if (delivery_price === undefined) {
            e.preventDefault();
            return false;
        }
    });

    var showDeliveryPriceLoading = function () {
        delivery_view().html($('<div>').addClass('b-loading'));
        delivery_error.html('');
    }

    var showDeliveryPriceError = function (errors) {
        var icon = $('<div>').addClass('b-loading-error');
        delivery_view().html(icon);
        delivery_error.html(errors.join(''));
    }

    var clearDeliveryPrice = function () {
        delivery_view().html('—');
        delivery_error.html('');
    };

    var requestDeliveryPrice = function () {
        showDeliveryPriceLoading();

        if (delivery_request) {
            delivery_request.abort();
            delivery_request_aborted = true;
        }

        delivery_request = $.post(el.data('delivery-path'), form.serialize())
            .error(function () {
                if (!delivery_request_aborted) showDeliveryPriceError(['Ошибка расчета стоимости доставки.'])
            })
            .success(function (r) {
                enableForm();
                delivery_request_aborted = false;

                if (r.price) {
                    delivery_price = r.price / 1;
                    calculate();
                }
                else if (r.errors) {
                    delivery_price = false;
                    calculate();
                    showDeliveryPriceError(r.errors);
                }
            });
    };

    var getDeliveryPrice = function () {
        var errors = [];

        delivery_fields().each(function () {
            if ($(this)[0].checkValidity() === false)
                errors.push(1);
        });

        if (errors.length == 0)
            requestDeliveryPrice();
        else {
            clearDeliveryPrice();
        }
    };

    var disableForm = function () {
        submit_btn.attr('disabled', true);
    };

    var enableForm = function () {
        submit_btn.removeAttr('disabled');
    };

    var applyParams = function () {
        $.each(data, function (i) {
            form
                .find('[name="' + i + '"]')
                .val(data[i])
            ;
        });
    };

    var saveParams = function () {
        var params = form.serializeArray();
        $.each(params, function (i) {
            if (!params[i].name) return false;
            var name = params[i].name;
            var param = /^cart\[([^\]]+)\]/.exec(name);
            if (param && $.inArray(param[1], params_to_save) >= 0) data[name] = params[i].value
        });
    };

    var setRegionAndZip = function (kladr, isCity) {
        if (!kladr) return;

        if (kladr.parents.length > 0) {
            var parent = kladr.parents[0];
            var region_name = [parent.name];

//            if (parent.type != 'Город')
//                region_name.push(parent.typeShort)


            if (isCity && region_name != city().val())
                region().val(region_name.join(' '));
        }

        if (kladr.zip) zip().val(kladr.zip);

        if (calculateDelivery)
            getDeliveryPrice();
    };

    var updateAddress = function () {
        var full_address = [],
            search_address = [];

        if (zip().val()) full_address.push(zip().val());
        if (region().val() && region().val() != city().val()) full_address.push(region().val());
        if (city().val()) {
            var _city = street().kladr('current')
                    ? city().kladr('current').typeShort + '&nbsp;' + city().kladr('current').name
                    : city().val()
                ;

            search_address.push(city().val());
            full_address.push(_city);
        }

        if (street().val()) {
            var _street = street().kladr('current')
                    ? street().kladr('current').typeShort + '&nbsp;' + street().kladr('current').name
                    : street().val()
                ;

            search_address.push(street().val());
            full_address.push(_street);
        }

        if (building().val()) {
            full_address.push(building().val());
            search_address.push(building().val());
        }

        showMap(search_address.join(', '), full_address.join(', '));
    };

    var initKladrs = function () {
        new Kladr(city(), 'city');
        new Kladr(street(), 'street');
        new Kladr(building(), 'building');

        city().on('kladr_select kladr_check change', function (e, obj) {
            street().kladr('parentType', $.kladr.type.city);
            building().kladr('parentType', $.kladr.type.city);

            if (obj) {
                street().kladr('parentId', obj.id);
                building().kladr('parentId', obj.id);
            }

            if (city().val() != old_vars['city']) {
                old_vars['city'] = city().val();

                if (city().data('kladr_inited') === true)
                {
                    region().val('');
                    zip().val('');
                    street().val('');
                    building().val('');
                }
            }

            setRegionAndZip(obj, true);
            updateAddress();
        });

        city().on('change', function () {
            updateAddress();
        });


        street().on('kladr_select kladr_check', function (e, obj) {
            building().kladr('parentType', $.kladr.type.street);

            if (obj) {
                building().kladr('parentId', obj.id);
            }

            if (street().val() != old_vars['street']) {
                old_vars['street'] = street().val();
                if (street().data('kladr_inited') === true)
                {
                    zip().val('');
                    building().val('');
                }
            }

            setRegionAndZip(obj);
            updateAddress();
        });

        street().on('change', function () {
            updateAddress();
        });

        building().on('kladr_select kladr_check', function (e, obj) {
            setRegionAndZip(obj);
            updateAddress();
        });

        building().on('change', function () {
            updateAddress();
        });

        site().on('kladr_select kladr_check', function () {
            updateAddress();
        });

        site().on('change', function () {
            updateAddress();
        });

        region().on('kladr_select kladr_check', function () {
            updateAddress();
        })

        region().on('change', function () {
            updateAddress();
        });

        $([city(), street(), building(), site(), region()]).each(function () {
            if (this.val())
            {
                this.trigger('change');
                return false;
            }
        });

        $([city(), region(), street(), building(), site()]).each(function () {
//            this.data('kladr_inited', true);
            if (this.hasClass('invalid'))
                this.on('focus', function() {
                    $(this).removeClass('invalid');
                })
        });
    };

    var showAddress = function () {
        var template = _.template(address_view.html()),
            _initTemplate = false
            ;

        if (!templates['address_and_payment']) {
            templates['address_and_payment'] = $(template());
            _initTemplate = true;
        }

        address_region.append(templates['address_and_payment']);

        if (_initTemplate) {
            address_region.find('select').each(function () {
                new FancySelect($(this));
            });
            initKladrs();
        }
        ;

        updateAddress();
    };

    var resetRegions = function () {
        $.each(templates, function (i) {
            templates[i].detach();
        });

        payment_region.empty();
    }

    var selectDeliveryType = function (el) {
        delivery_type = el.val();

        saveParams();
        resetRegions();
        showPayment();

        delivery_hint.html(order_options.delivery_types[delivery_type].conditions);
        delivery_error.html('');

        if (order_options.delivery_types[delivery_type].layout == 'address_and_payment') {
            showAddress();
        }

        if (el.data('delivery-calculate')) {
            calculateDelivery = true;
            delivery_price = false;
            disableForm();
            getDeliveryPrice();
        }
        else {
            calculateDelivery = false;
            enableForm();
            delivery_price = order_options.delivery_types[delivery_type].price;
            calculate();
        }
    };

    form.find(':input').on('change', function () {
        data = form.serializeArray();
    });

    var calculate = function () {
        var total_price = order_options.items_price;

        if (delivery_price !== false) {
            if (delivery_price >= 0) {
                delivery_view().html(delivery_price == 0 ? free_translation : delivery_price.money(0, ' ', '', ' р.'));
                total_price += delivery_price;
            }
        }
        else
            delivery_view().html('—');

        total_view.html(total_price.money(0, ' ', '', ' р.'))
    };

    var tooltips = function () {
        el.find('[data-toggle=tooltip]')
    };

    delivery_types.click(function () {
        selectDeliveryType($(this));
    });

    delivery_types.each(function () {
        $(this).closest('div.radio-label').find('[data-order=popover]').popover({
            html: true,
            title: 'Условия доставки',
            trigger: 'hover',
            content: order_options.delivery_types[$(this).val()].hint,
            animation: true
        })
    })

    calculate();
//    showMap('Москва, ул. Дубининская, 57');
}

$(document).on('ready page:load', function () {
    $('[data-type=order]').each(function () {
        new Order($(this));
    });
});