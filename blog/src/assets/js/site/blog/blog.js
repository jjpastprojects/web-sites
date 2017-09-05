$('li[id^="category-"]').click(function(){
    var id = this.id;
    $('li[data-parent="'+id+'"]').each(function(key, item){
        $(item).toggleClass('hide');
    });
    $('ul[data-parent="'+id+'"]').toggleClass('hide');
});
