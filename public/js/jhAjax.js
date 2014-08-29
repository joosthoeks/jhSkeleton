function jhAjax(url, container, type, key, value, callback)
{
    $(container).empty();
    
    if (value.length > 0) {
        $.ajax({
            type: 'post',
            url: url + '?page=ajax',
            data: 'type=' + type + '&key=' + key + '&value=' + value,
            success: function(msg) {
                $(container).empty();
                if(msg.length > 0) {
                    $(container).html(msg);
                }
                callback.call(null);
            }
        });
    }
}
