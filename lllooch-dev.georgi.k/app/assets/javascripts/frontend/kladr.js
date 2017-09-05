var LabelFormat = function( obj, query ){
    var label = '';

    var name = obj.name.toLowerCase();
    query = query.toLowerCase();

    var start = name.indexOf(query);
    start = start > 0 ? start : 0;

    if(obj.typeShort){
        label += '<span class="ac-s2">' + obj.typeShort + '. ' + '</span>';
    }

    if(query.length < obj.name.length){
        label += '<span class="ac-s2">' + obj.name.substr(0, start) + '</span>';
        label += '<span class="ac-s">' + obj.name.substr(start, query.length) + '</span>';
        label += '<span class="ac-s2">' + obj.name.substr(start+query.length, obj.name.length-query.length-start) + '</span>';
    } else {
        label += '<span class="ac-s">' + obj.name + '</span>';
    }

    if(obj.parents){
        for(var k = obj.parents.length-1; k>-1; k--){
            var parent = obj.parents[k];
            if(parent.name){
                if(label) label += '<span class="ac-st">, </span>';
                label += '<span class="ac-st">' + parent.name + ' ' + parent.typeShort + '.</span>';
            }
        }
    }

    return label;
};

var Kladr = function(el, type) {
    if (el.data('__kladr')) return;
    el.data('__kladr', this);

    var type = type || el.data('kladr');

    var options = {
        token: '52d629fa31608fc822000003',
        key: '576b169718f2ebc8d905c51a6f39899661d5543e',
        type: $.kladr.type[type],
        withParents: true,
        verify: true
    };

    if ('city' == type)
        options['labelFormat'] = LabelFormat;

    el.kladr(options);
};

$(document).on('ready page:load', function() {
    $('[data-kladr]').each(function() {
        new Kladr($(this));
    })
});