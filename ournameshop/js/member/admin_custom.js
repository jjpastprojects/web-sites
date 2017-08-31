jQuery.fn.highlight = function (str, className) {
    var regex = new RegExp(str, "gi");
    return this.each(function () {
        $(this).contents().filter(function() {
            return this.nodeType == 3 && regex.test(this.nodeValue);
        }).replaceWith(function() {
            return (this.nodeValue || "").replace(regex, function(match) {
                return "<span class=\"" + className + "\">" + match + "</span>";
            });
        });
    });
};

(function($){
    $.fn.extend({
        thsort: function(options){      
            
            var settings = $.extend({}, options);
            
            $(this).each(function(i,v) {
                var $this = $(this);
                $this.find('[data-sort-field]').each(function() {
                    var holder      = $(this);
                    
                    var sort_field  = holder.data('sort-field');
                    var sort_order  = options.current_sort_order == 'asc' ? 'desc' : 'asc';

                    var sort_string = 'sort=' + sort_field + '&order=' + sort_order;
                    
                    var query_string;
                    
                    if(!options.qs)
                        query_string = '?' + sort_string;
                    else
                        query_string = '?' + options.qs + '&' + sort_string;

                    var link_html = '<a href="' + options.current_url + query_string +'">' + holder.html() + '</a>';

                    if(options.current_sort_field == sort_field)
                        link_html += (options.current_sort_order == 'desc' ? '&#9660' : '&#9650');
                    
                    holder.html(link_html);
                });
            });
        }
    });
})(jQuery);