function setCookie(cname, days) {
  var date, expires;
  date = new Date();
  date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
  expires = ' expires=' + date.toGMTString();
  document.cookie = cname + '=true; path=/;' + expires;
}

function hasCookie(cname) {
  if (document.cookie.indexOf(cname+'=true') >= 0) {
    return true;
  }
  return false;
}

$(document).ready(function() {



});
