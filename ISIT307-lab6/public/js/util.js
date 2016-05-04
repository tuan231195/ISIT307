function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

function paramExists(param){
    return window.location.href.search("[?&]" + param + "=") != -1;
};
