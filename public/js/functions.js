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
function getWidthWindow()
{
    return window.innerWidth;
}
function getHeightWindow()
{
    return window.innerHeight;
}
function getWidthElement(id)
{
    return document.getElementById(id).clientWidth;
}
function getHeightElement(id)
{
    return document.getElementById(id).clientHeight;
}
function utf8ToB64(str)
{
    return window.btoa(unescape(encodeURIComponent(str)));
//    return window.btoa(encodeURIComponent(escape(str)));
}
function b64ToUtf8(str)
{
    return decodeURIComponent(escape(window.atob(str)));
//    return unescape(decodeURIComponent(window.atob(str)));
}
function submitDownloadForm(id, title, data)
{
    var form = document.getElementById(id);
    form['title'].value = title;
    form['data'].value = data;
    form.submit();
}
function scaleData(width)
{
    return width / 1000;
}
