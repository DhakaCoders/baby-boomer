


checkCookie();
function showIt2() {
    setTimeout(function() {
        document.getElementById("cta_box").style.display = "block";
        //lwr();
    }, 500);
}


function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


function checkCookie() {
    var sale = getCookie("sale");
    if (sale != "") {
        // alert("Welcome again" + sale);
        setTimeout(function () {
            $('#cta_box').show();
        }, 1000); //2230000
    } else {
        // alert("..............");
        setCookie("sale", "set", 30);
        setTimeout(function () {
            $('#cta_box').show();
        }, 1734000); //2230000
    }
}

var hash = window.location.hash;
var query_string = window.location.search;
var url_param = '';
var new_url ='';
if(hash == null){
    url_param = query_string;
}else if (query_string == null){
    url_param = hash;
}else{
    url_param = query_string+hash;
}

var first_char =  url_param.charAt(0);
if(first_char==='?'){
    new_url =  url_param.replace('?','&')
}

//  alert(url_param.charAt(0));
// Store
localStorage.setItem("hash_url", url_param);
localStorage.setItem("hash_url_faq", new_url);
$('.buy_step1').attr('href','step1.php'+url_param);

!function(e,n){"function"==typeof define&&define.amd?define(n):"object"==typeof exports?module.exports=n(require,exports,module):e.ouibounce=n()}(this,function(){return function(e,n){function o(e,n){return"undefined"==typeof e?n:e}function t(e){var n=24*e*60*60*1e3,o=new Date;return o.setTime(o.getTime()+n),"; expires="+o.toUTCString()}function i(){L.addEventListener("mouseleave",u),L.addEventListener("mouseenter",r),L.addEventListener("keydown",c)}function u(e){e.clientY>v||d(T,"true")&&!l||(w=setTimeout(m,p))}function r(){w&&(clearTimeout(w),w=null)}function c(e){g||d(T,"true")&&!l||e.metaKey&&76===e.keyCode&&(g=!0,w=setTimeout(m,p))}function d(e,n){return a()[e]===n}function a(){for(var e=document.cookie.split("; "),n={},o=e.length-1;o>=0;o--){var t=e[o].split("=");n[t[0]]=t[1]}return n}function m(){f(),y()}function f(){e&&(e.style.display="block"),s()}function s(e){var e=e||{};"undefined"!=typeof e.cookieExpire&&(E=t(e.cookieExpire)),e.sitewide===!0&&(b=";path=/"),"undefined"!=typeof e.cookieDomain&&(x=";domain="+e.cookieDomain),"undefined"!=typeof e.cookieName&&(T=e.cookieName),document.cookie=T+"=true"+E+x+b,L.removeEventListener("mouseleave",u),L.removeEventListener("mouseenter",r),L.removeEventListener("keydown",c)}var n=n||{},l=n.aggressive||!1,v=o(n.sensitivity,20),k=o(n.timer,1e3),p=o(n.delay,0),y=n.callback||function(){},E=t(n.cookieExpire)||"",x=n.cookieDomain?";domain="+n.cookieDomain:"",T=n.cookieName?n.cookieName:"viewedOuibounceModal",b=n.sitewide===!0?";path=/":"",w=null,L=document.documentElement;setTimeout(i,k);var g=!1;return{fire:f,disable:s}}});

ouibounce(document.getElementById('ouibounce-model'),{aggressive: true});
$('body').on('click', function() {
    $('#ouibounce-model').hide();
});
$('#ouibounce-model .closerM').on('click', function() {
    $('#ouibounce-model').hide();
});
$('#ouibounce-model .model').on('click', function(e) {
    e.stopPropagation();
});

$('#nav1').onePageNav({
  currentClass: 'current',
  currentId: 'href',
  changeHash: false,
  scrollSpeed: 750,
  scrollThreshold: 0.5,
  filter: '',
  easing: 'swing',
  begin: function() {
    //I get fired when the animation is starting
  },
  end: function() {
    //I get fired when the animation is ending
  },
  scrollChange: function($currentListItem) {
    //I get fired when you enter a section and I pass the list item of the section
    console.log($currentListItem);

   /*alert($("#nav").attr("href","https://www.dhakacoders.com"));*/

   var addtext = $("hm-scroll-btn a").text();

  }
});



