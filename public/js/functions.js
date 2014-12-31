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
function jhGetWidthWindow()
{
    return window.innerWidth;
}
function jhGetHeightWindow()
{
    return window.innerHeight;
}
function jhGetWidthElement(id)
{
    return document.getElementById(id).clientWidth;
}
function jhGetHeightElement(id)
{
    return document.getElementById(id).clientHeight;
}
function jhUtf8ToB64(str)
{
    return window.btoa(unescape(encodeURIComponent(str)));
//    return window.btoa(encodeURIComponent(escape(str)));
}
function jhB64ToUtf8(str)
{
    return decodeURIComponent(escape(window.atob(str)));
//    return unescape(decodeURIComponent(window.atob(str)));
}
function jhSubmitDownloadForm(id, title, data)
{
    var form = document.getElementById(id);
    form['title'].value = title;
    form['data'].value = data;
    form.submit();
}
function jhScaleData(width)
{
    return width / 1000;
}
function jhGetClientCurrentPosition()
{
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(jhClientGeoSuccess, jhClientGeoError, jhClientGeoOptions);
    } else {
        console.log('Geolocation service is not supported by browser.');
    }
}
function jhGetClientWatchPosition()
{
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(jhClientGeoSuccess, jhClientGeoError, jhClientGeoOptions);
    } else {
        console.log('Geolocation service is not supported by browser.');
    }
}
function jhClientGeoSuccess(position)
{
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    var altitude = position.coords.altitude;
    var accuracy = position.coords.accuracy;
    var altitudeAccuracy = position.coords.altitudeAccuracy;
    var heading = position.coords.heading;
    var speed = position.coords.speed;
    var timestamp = position.timestamp;
    
    // do something:
    
//    console.log(latitude);
//    console.log(longitude);
//    console.log(altitude);
//    console.log(accuracy);
//    console.log(altitudeAccuracy);
//    console.log(heading);
//    console.log(speed);
//    console.log(timestamp);
}
function jhClientGeoError(error)
{
    console.log(error.code + ' : ' + error.message);
}
function jhClientGeoOptions()
{
    return {
        enableHighAccuracy: true,
        timeout: 10000, // 10 seconds.
        maximumAge: Infinity
    };
}
function jhPointInPolygon(point, vs)
{
    // ray-casting algorithm based on
    // http://www.ecse.rpi.edu/Homepages/wrf/Research/Short_Notes/pnpoly.html
    var xi, xj, i, intersect,
            x = point[0],
            y = point[1],
            inside = false;
    for (var i = 0, j = vs.length - 1; i < vs.length; j = i++) {
        xi = vs[i][0],
                yi = vs[i][1],
                xj = vs[j][0],
                yj = vs[j][1],
                intersect = ((yi > y) != (yj > y))
                && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
        if (intersect)
            inside = !inside;
    }
    return inside;
}
