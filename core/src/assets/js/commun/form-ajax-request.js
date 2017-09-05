(function(){
    var submitAjaxRequest = function(e){
        var button = this;
        var form  = $(this);
        $(this.parentElement.parentElement).addClass('hide');
        var method = form.find('input[name="_method"]').val() || 'POST';

        $.ajax({
            type: method,
            url: form.prop('action'),
            data: form.serialize(),
            success: function(){
                $.publish('form.submitted', button);
            }
        });

        e.preventDefault();
    }

    $('form[data-remote]').on('submit', submitAjaxRequest);
})();
