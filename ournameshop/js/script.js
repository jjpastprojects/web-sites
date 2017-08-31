$(function() {

  $('.start-sell-this').on('click', function(e) {
    e.preventDefault();
    var lnk = $(this);

    if(user_id == 0)
    {
      $('.show-login-popup').trigger('click');

      $(document).off('login_successful').on('login_successful', function() {
        user_id = 99999999999999;

        lnk.trigger('click');
      });
    }
    else
    {
      lnk.text('Please wait...');
      
      var params          = print_designer.share_params();

      params.variant_id   = $('input[name=surface_id]').val();
      
      params.template_id  = $('input[name=tpl_id]').val();
      params.lastname_id  = $('input[name=lastname_id]').val();

      $.post('/catalog/save_print_design', params, function(data) {
        if(data.success)
        {
          location = '/campaign/create?lid=' + params.lastname_id + 
                     '&vid=' + params.variant_id + 
                     '&tid=' + params.template_id + 
                     '&sid=' + data.id;
        }

      }, 'json');
    }
  });

  $('.choose-available-styles').on('click', function(e) {
    e.preventDefault();

    $('.avail-styles-holder').toggleClass('visible');
  });

  $('[data-avail-style-id]').on('click', function() {
    var lnk = $(this);

    $('.avail-style').removeClass('avail-style-current');
    lnk.addClass('avail-style-current');

    $('[data-change-product]').val(lnk.data('avail-style-id'));

    
    $('[data-change-product]').trigger('change');

    $('.avail-styles-holder').removeClass('visible');

    $('.product-model').text(lnk.data('avail-style-name'));
  });

  var files = false;

  $('#def-comb-listing-img').on('change', function() {
    var input = $(this);
    files = event.target.files;

    var reader = new FileReader();
    
    reader.onload = function (e) {
      $('.preview-def-listing-img').attr('src', e.target.result).removeClass('hidden');
    };

    reader.readAsDataURL(input[0].files[0]);
  });




  $('.save-preset').on('click', function(e) {
    e.preventDefault();
    var lnk = $(this);

    var data = new FormData();

    if(files)
    {
      $.each(files, function(key, value)
      {
          data.append(key, value);
      });  
    }
    


    lnk.text('please wait...');
    
    var params          = print_designer.share_params();
    

    data.append('canvas_params', params.canvas_params);
    data.append('img', params.img);

    data.append('variant_id', $('input[name=surface_id]').val());
    data.append('template_id', $('input[name=tpl_id]').val());

    data.append('lastname_id', $('input[name=lastname_id]').val());

    data.append('preset', lnk.data('preset') ? lnk.data('preset') : 0);
    data.append('def_comb', lnk.data('def-comb') ? lnk.data('def-comb') : 0);
    data.append('clear', lnk.data('clear') ? lnk.data('clear') : 0);
    
    
    $.ajax({
        url: '/catalog/save_print_design',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data)
        {
            lnk.text(params.clear ? 'cleared' : 'saved');
        }
    });
  });
});  


$(function() {

  var lname_navi  = $('[data-lastname-navigation]');
  var lname_input = lname_navi.find('[contentEditable]');

  lname_input.on('keydown', function(e) {
    var l     = $(this);
    var text  = $.trim(l.text());
    var limit = 20;
    
    if(e.keyCode == 13)
    {
      e.preventDefault();
      location = '/' + text;
    }
    else if(e.keyCode == 27)
    {
      lname_navi.find('span.glyphicon-remove').trigger('click');      
    }
    else
    {
      if(text.length > limit)
        e.preventDefault();
    }
  });

  lname_navi.on('click', function() {
    lname_input.data('ln', lname_input.text());

    lname_input.focus();

    lname_navi.find('span.glyphicon-search').addClass('hidden');
    lname_navi.find('span.glyphicon-remove').removeClass('hidden');
    
    document.execCommand('selectAll',false,null);
  });

  lname_navi.find('span.glyphicon-remove').on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();

    lname_navi.find('span.glyphicon-remove').addClass('hidden');
    lname_navi.find('span.glyphicon-search').removeClass('hidden');

    lname_input.text(lname_input.data('ln'));
    lname_input.blur();
  })

  function add2col() {
    var lnk = this;
    lnk.find('img').addClass('rotating');

    var url = lnk.parents().closest('.itemx1').find('.addx1 a').attr('href');//lnk.parent().prev().find('a').attr('href');

    $('#add-col-ifr').remove();

    $('body').append(
      '<iframe id="add-col-ifr" src="' + url + '?add_2collection=1" style="display: none;"></iframe>'    
    );

    $(document).off('added2col').on('added2col', function(e, cnt) {

      lnk.find('img').removeClass('rotating');
      lnk.find('span').removeClass('glyphicon-heart-empty').addClass('glyphicon-heart');

      $('.fav-cnt').text(cnt).removeClass('hidden');

    });
  }


  $('body').on('click', '.add2col', function(e) {
    e.preventDefault();
    var me = $(this);
  
    if(user_id == 0)
    {
      $('.show-login-popup').trigger('click');

      $(document).off('login_successful').on('login_successful', function() {
        user_id = 99999999999999;

        add2col.call(me);
        $.fancybox.close();
      });
    }
    else
    {
      add2col.call(me);
    }
  });

  $('.fast-switch-product select').on('change', function(e) {
    location = $(this).val();
  });

  $('[data-change-product]').on('change', function() {

    var sel           = $(this);
    var product_id    = sel.val();
    
    var surface_img   = $('img.surface');
    var color_holder  = $('.color-holder');
    
    var size_sel      = $('.size-sel');

    $.getJSON('/catalog/product.json', {id: product_id}, function(data) {
      if(data.success)
      {
        var product         = data.product;
        variants_by_color   = data.by_color;

        surface_img.prop('src', product.image);

        if(product.preview_thumb)
        {
          surface_img.parent().addClass('overlay-color')
        }
        else
        {
          surface_img.parent().removeClass('overlay-color');
        }

        if(true)//by_color
        {
          color_holder.empty();

          $.each(data.by_color, function(k, v) {
            color_holder.append('<div data-color-code="' + k + '" class="color"\
                style="background: ' + k + '"></div>'
              );
          });

          color_holder.find('div.color:first').trigger('click');
        }

        if(true)//by_size
        {
          size_sel.empty();

          size_sel.append('<option value="">Choose</option>');

          $.each(data.by_size, function(k, v) {
            size_sel.append('<option value="' + k + '">' + k + '</option>');
          });
        }
      }
      else
      {

      }
    });
  });

  $('.open-floating-search').on('click', function(e) {
    e.preventDefault();
    var panel = $('.floating-search-panel');

    panel.addClass('active');

    panel.find('input:text').focus();

  });

  $('.close-holder').on('click', function(e) {
    e.preventDefault();
    var panel = $('.floating-search-panel');

    panel.removeClass('active');
  });

  $(document).on('click', '.close-fancybox', function(e) {
    e.preventDefault();
    $.fancybox.close();
  });

  $(document).on('click', '#social-login-popup .soicon-mail', function(e) {
    e.preventDefault();
    $('.email-login-holder').toggle();
    $.fancybox.reposition();
  });


  $('.lastname-form').on('submit', function(e) {
    e.preventDefault();

    var string = $(this).find('input:text').val();
    window.location = '/' + string.charAt(0).toUpperCase() + string.slice(1);
  });

  $('.filter-family input:radio').on('change', function() {
  	$('.catalog-items-overlay').fadeIn();

    $('.filter-family .cat-id').removeClass('active');
    $(this).prev().addClass('active');
    
  	$.getJSON('/catalog/load_family_items', $('.filter-family').serialize(), function(data) {

  		$('.family-items').html(data.html);
  		
      $('.catalog-items-overlay').fadeOut('normal', function() {
  			
  		});
  		

  	});
  });
  
  $(document).on('click', '.logo-color-holder .color', function(e) {
    var lnk = $(this);
    
    lnk.parent().find('.color').removeClass('active');
    lnk.addClass('active');
    
    if(lnk.data('color-code') == '#ffffff')
    {
      $('.tpl-thumb').addClass('inverted');
      $('[name=white_logo]').val('1');
    }
    else
    {
      $('.tpl-thumb').removeClass('inverted');
      $('[name=white_logo]').val('0');
    }
  });
  
  $('.phone-case-model').on('change', function() {
    var sel = $(this);

    $('img.surface').prop(
      'src', sel.find('option:selected').data('img')
    );

    $('[name=surface_id]').val(sel.val());
  });  


  $(document).on('click', '.size-and-color .color', function(e) {
    var lnk = $(this);

    if(lnk.hasClass('active'))
      return;

    var frm = lnk.parents().closest('form');

    lnk.parent().find('.color').removeClass('active');
    lnk.addClass('active');

    
      var curr_src  = $('img.surface').attr('src');
      var new_src   = variants_by_color[lnk.data('color-code')][0].image;

      var current_variant;

      if(has_sizes && frm.find('.size-sel').val())
      {
        
          $.each(variants_by_color[lnk.data('color-code')], function(i, v) {
            if(v.size == frm.find('.size-sel').val())
            {
              
              current_variant = v;
              return false;
            }

          });
        
      }
      else
      {
        var current_variant = variants_by_color[lnk.data('color-code')][0];        
      }

      frm.find('input[name="surface_id"]').val(current_variant.id);

      var q_price = current_variant.price * frm.find('input[name=q]').val();

      frm.find('button:submit').text('BUY NOW $' + q_price);
      frm.find('button:submit').data('price', current_variant.price);

      frm.find('.button-q').removeClass('hidden');

      if($('.overlay-color').length)
      {
        $('.overlay-color').css('background-color', lnk.data('color-code'));

        $('.overlay-color').css(
            'background-color',
            $('.overlay-color').css('background-color').replace(')', ', 0.9)').replace('rgb', 'rgba')
        );
      }
      else
      {
        if(new_src != curr_src)
        {
          $('img.surface').on('load', function() {
            $(this).removeClass('hidden');
          });

          $('img.surface').attr('src', new_src);
        }
        else
        {
          
        }  
      }
      
      

      
      

      $('.size-and-color .size').removeClass('hidden');
    
  });
  
  $('.size-and-color .color-holder .color:first').trigger('click');  
  
  function product_logo_joiner(product_url, logo_url, params)
  {
      var params = designer_config.joiner;
      
      $('#canvas-joiner').remove();
      
      var canvas = $(
        '<div class="hidden"><canvas id="canvas-joiner" width="300" height="375"></canvas></div>'
      );

      $('body').append(canvas);
      
      var frm = this;

      canvas          = new fabric.Canvas('canvas-joiner');

      fabric.Image.fromURL(product_url, function(oImg) {
        canvas.add(oImg);

        fabric.Image.fromURL(logo_url, function(oImg) {

            oImg.scale(params.scale).set({
              top: params.top,
              left: params.left,
            });
            
            canvas.add(oImg);

            $(document).trigger('logo-joined', [canvas, frm]);
        });
    }); 
  }

  $('form.product-chooser-frm').on('submit', function(e) {
    e.preventDefault();

    var frm = $(this);

    if(user_id == 0)
    {
      $('.show-login-popup').trigger('click');

      $(document).off('login_successful').on('login_successful', function() {
        user_id = 999999999999;
        frm.trigger('submit');
      });

      return;
    }

    var btn = frm.find('button:submit');

    btn.data(
      'old_text', btn.text()
    );

    btn.text('Please wait...');
    // btn.attr('disabled', true);

    var variant_id = null;

    if(has_colors)
    {
      variant_id = variants_by_color[$('.color-holder')
                  .find('.color.active').data('color-code')][0].id;
    }
    else
    {
      variant_id = variants_by_color[''][0].id;
    }

    product_logo_joiner.call(
      $(this), 
      '/catalog/variant_proxy?variant_id=' + variant_id, 
      $('#canvas-logo')[0].toDataURL(), {}
    );
  
    $(document).off('logo-joined').on('logo-joined', function(e, joined_canvas, frm) {

      var btn = frm.find('button:submit');

      var canvas            = print_designer.getCanvas();
      var params            = frm.serialize();
      var old_canvas_width  = canvas.getWidth();

      print_designer.resizeEntireCanvas(300);
      
      if(true)
      {
        params += '&canvas='         + joined_canvas.toDataURL();
        params += '&canvas_params='  + JSON.stringify(print_designer.jsonsify());
      }

      if(typeof(campaign_id) != 'undefined')
      {
        params += '&campaign_id=' + campaign_id;
      }

      print_designer.resizeEntireCanvas(old_canvas_width);

      $.post('/cart/add_item', params, function(data) {
        
        btn.text(btn.data('old_text'));
        btn.attr('disabled', false);
        
        if(data.success)
        {
          $.fancybox.open({
            content: data.html,
            closeBtn: false
          });

          update_cart_items_cnt(data.cart_items_cnt);
        }
      }, 'json');
    });
  });

  function update_cart_items_cnt(cnt)
  {
    $('.cart-lnk').find('.label.label-primary').remove();

    if(cnt > 0)
      $('.cart-lnk').append(
        '<span class="label label-primary">' + cnt + '</span>'
      );
  }

  $(document).on('change', '.size-and-color select.size-sel', function() {
    var sel = $(this);
    var frm = sel.parents().closest('form');

    if(!sel.val())
    {
      frm.find('.button-q').addClass('hidden');
      return;
    }

    var variants_obj = variants_by_color[$('.size-and-color .color.active').data('color-code')];
    
    if(!has_colors)
    {
      variants_obj = variants_by_color[''];
    }

    $.each(variants_obj, function(i, v) {
      if(v.size == sel.val())
      {
        frm.find('input[name="surface_id"]').val(v.id);

        var q_price = v.price * frm.find('input[name=q]').val();

        frm.find('button:submit').text('BUY NOW $' + q_price);
        frm.find('button:submit').data('price', v.price);

        frm.find('.button-q').removeClass('hidden');

        return false;
      }
    });
  });
  
  if(typeof(variant) != 'undefined')
  {
    if(variant !== false)
    {
      $('.size-and-color .color[data-color-code="' + variant.color_code + '"]').trigger('click');
      $('.size-and-color .size-sel').val(variant.size).trigger('change');
    }
    else
    {
      // $('.size-and-color .color:first').trigger('click');
    }  
  }

  $(document).on('change', '.product-chooser-frm [name=q]', function() {
    var frm = $(this).parents().closest('form');

    frm.find('button:submit').html(
      'BUY NOW $' + round(frm.find('button:submit').data('price') * $(this).val(), 2)
    );
  });

  $('.cart-form').on('submit', function() {
    $(this).find('button:submit').text('please wait...').attr('disabled', true);
  });

  $('.remove-from-cart').on('click', function(e) {
    e.preventDefault();
    
    var lnk = $(this);
    var item_id = lnk.parents().closest('tr').data('id');

    $.post('/cart/remove_item', {id: item_id}, function(data) {
      if(data.success)
      {
        lnk.parents().closest('tr').remove(); 
        $('.cart-items span.subtotal').text(data.subtotal);

        update_cart_items_cnt(data.cart_items_cnt);
      }
      else
      {
        alert(data.msg);
      }
    }, 'json');
  });

  $('.cart-item .q-input').on('change', function() {
    var holder  = $(this).parents().closest('tr');
    var item_id = holder.data('id');
    
    holder.addClass('changed');
    $.post('/cart/update_q', {id: item_id, q: $(this).val()}, function(data) {
      if(data.success)
      {
        holder.removeClass('changed'); 
      
        holder.find('.total').text(data.item.total);
        $('.cart-items span.subtotal').text(data.subtotal);

        update_cart_items_cnt(data.cart_items_cnt);
      }
      else
      {
        alert(data.msg);
      }
    }, 'json');
  });

  $('.cart-item .q-input').on('keypress', function(e) {
    if(e.keyCode == 13)
    {
      e.preventDefault();
      $(this).blur();
    }
  });

  $(document).on('change', '[data-hidden-name]', function() {
    var frm = $(this).parents().closest('form');

    frm.find('input[name="params[' + $(this).data('hidden-name') + ']"]').val($.trim($(this).find('option:selected').html()));
  });

  $('.show-login-popup').fancybox({
    href:               '#social-login-popup',
    padding:            false,
    closeBtn:           false,
      beforeShow: function() {
        var holder = $('.fancybox-inner');

        holder.on('click', '[data-network]', function(e) {
          e.preventDefault();
          var lnk = $(this);

          hello.login(lnk.data('network'), {scope: 'email'}).then(function(auth) {

            hello( auth.network ).api( '/me?fields=email' ).then( function(r) {  //Modified_Cezar 5/26/2016  __ Social Login__ 
              
              r.network = lnk.data('network');

              $.post('/social_login', r, function(data) {
                if(data.success)
                {
                  $(document).trigger('login_successful');
                }
                else
                {
                  alert(data.msg);
                }
              }, 'json');
            });


          }, function(e) {
            alert("Signin error: " + e.error.message );
          });
        });


        holder.on('submit', '.email-login-holder form.signin-form', function(e) {
          e.preventDefault();
          
          var frm = $(this);

          frm.find('.text-danger').slideUp('fast');
          frm.find('input:submit').val('please wait...');

          $.post(frm.attr('action'), frm.serialize(), function(data) {
            if(data.success)
            {
              $(document).trigger('login_successful');
            } 
            else
            {
              frm.find('input:submit').val('Sign In');
              frm.find('.text-danger').html(data.msg).slideDown('fast');
            }
          }, 'json');
        });

        holder.on('click', '#social-login-popup .btn-register', function(e) {
          e.preventDefault();
          var holder = $('#social-login-popup');
          if(holder.find('.forgot-form').hasClass('hidden'))
            holder.find('.signin-form, .signup-form').toggleClass('hidden');
          else
            holder.find('.forgot-form, .signup-form').toggleClass('hidden');
        });

        holder.on('click', '#social-login-popup .forgot-lnk', function(e) {
          e.preventDefault();
          var holder = $('#social-login-popup');

          holder.find('.signin-form, .forgot-form').toggleClass('hidden');
        });

        holder.on('click', '#social-login-popup .back-to-login', function(e) {
          e.preventDefault();
          var holder = $('#social-login-popup');

          holder.find('.signin-form, .forgot-form').toggleClass('hidden');
        });

        holder.on('submit', '#social-login-popup form.forgot-form', function(e) {
          e.preventDefault();
          var frm = $(this);

          frm.find('.text-danger').slideUp('fast');
          frm.find('button:submit').text('Please wait...');

          $.post(frm.attr('action'), frm.serialize(), function(data) {
            if(data.success)
            {
              frm.find('button:submit').text('Please check your email');
            }
            else
            {
              frm.find('button:submit').text('Reset Password');

              frm.find('.text-danger p').text(data.msg);
              frm.find('.text-danger').slideDown('fast');
            }
          }, 'json');
        });

        holder.on('submit', '#social-login-popup form.signup-form', function(e) {
          e.preventDefault();
          var frm = $(this);

          frm.find('.text-danger').slideUp('fast');
          frm.find('input:submit').val('please wait...');

          $.post(frm.attr('action'), frm.serialize(), function(data) {
            if(data.success)
            {
              $(document).trigger('login_successful');
            } 
            else
            {
              frm.find('input:submit').val('Sign Up');
              frm.find('.text-danger').html(data.msg).slideDown('fast');
            }
          }, 'json');
        });
      }
  });

  $(document).on('login_successful', function() {
    window.location.reload();
  });

  $(document).on('click', '.itemx1 .addx1 a, .surface-items .item .img a, .surface-items .item .title a', function(e) {
    var lnk = $(this);

    if(user_id == 0)
    {
      e.preventDefault();
      $('.show-login-popup').trigger('click');

      $(document).off('login_successful').on('login_successful', function() {
        window.location = lnk.attr('href');
      });
    }
  });

  $(document).on('change', '.pay-popup [name=method]', function() {
    $('.pay-popup .card-info').toggleClass('hidden');
    $.fancybox.reposition();
  });

  $('.zoom-lnk').on('click', function(e) {
    e.preventDefault();

    var content     = '<div style="background: ' + $('.product-preview.overlay-color').css('background-color') + '"\
                       class="popup-preview-item text-center">\
                       <img class="surface" src="' + $('img.surface').attr('src') + '" />\
                       <img src="/img/ajax-loader.gif" class="loader" />';
    
    var img_src;
    
    $.fancybox.open({
      content: content
    });

    if($('img.tpl-thumb').length)
    {
      
    }
    else
    {
      var canvas = print_designer.getCanvas();
      canvas.discardActiveObject();

      $('#zoomcanvas').remove();

      var canvas_zoom = $('#zoom-container').append(
        $('<canvas id="zoomcanvas"></canvas>')
      );

      canvas_zoom = new fabric.Canvas('zoomcanvas');

      canvas_zoom.setWidth(canvas.getWidth());
      canvas_zoom.setHeight(canvas.getHeight());

      canvas_zoom.loadFromJSON(
        JSON.stringify(canvas), canvas_zoom.renderAll.bind(canvas_zoom)
      );
      
      var img = new Image();
      img.src = logo_url;

      $(img).on('load', function(e) {
        window.setTimeout(function() {
          SCALE_FACTOR = canvas_zoom.getWidth() / 300;
          
          var SCALEX = 1 / SCALE_FACTOR;

          canvas_zoom.setHeight(canvas_zoom.getHeight() * SCALEX);
          canvas_zoom.setWidth(canvas_zoom.getWidth() * SCALEX);

          canvas_zoom.renderAll();

          var objects = canvas_zoom.getObjects();
          
          for (var i in objects) {
            obj = objects[i];

            var scaleX = obj.scaleX;
            var scaleY = obj.scaleY;
            var left = obj.left;
            var top = obj.top;
        
            var tempScaleX = scaleX * (1 / SCALE_FACTOR);
            var tempScaleY = scaleY * (1 / SCALE_FACTOR);
            var tempLeft = left * (1 / SCALE_FACTOR);
            var tempTop = top * (1 / SCALE_FACTOR);

            obj.scaleX = tempScaleX;
            obj.scaleY = tempScaleY;
            obj.left = tempLeft;
            obj.top = tempTop;

            obj.setCoords();
          }
          
          canvas_zoom.renderAll();
          img_src = $('#zoomcanvas')[0].toDataURL();

          var logo    = $('<img style="display: none;" class="' + $('.tpl-thumb').attr('class') + '" src="' + img_src + '" />')
          var holder  = $('.fancybox-inner');

          holder.find('.popup-preview-item').append(logo);
            
          holder.find('img.loader').animate({'left': 1000}, 1000, 'easeInQuart', function() {
            logo.fadeIn();  
          });
        }, 500);
      });
    }
  })
});

jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
  def: 'easeOutQuad',
  easeInQuart: function (x, t, b, c, d) {
    return c*(t/=d)*t*t*t + b;
  }
});

(function ($) {
    $.fn.applyInvert = function (options) {
        var settings = $.extend({
            callback: function() {},
        }, options );


        var el = this,
            transparent;
        transparent = function (c) {
            var m = c.match(/[0-9]+/g);
            if (m !== null) {
                return !!m[3];
            }
            else return false;
        };
        while (transparent(el.css('background-color'))) {
            el = el.parent();
        }

        parts = el.css('background-color').match(/[0-9]+/g);
        this.lightBackground = !!Math.round(
            (
                parseInt(parts[0], 10) + // red
                parseInt(parts[1], 10) + // green
                parseInt(parts[2], 10) // blue
            ) / 765 // 255 * 3, so that we avg, then normalise to 1
        );

        settings.callback(this.lightBackground);
        
        return this;
    };
}(jQuery));

function round(value, decimals) {
    return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
}

