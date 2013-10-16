/**
 * Created for Dead Drop
 * Date: 2013-10-08
 * Time: 10:28 AM
 */

var pw;
var root;

function symmetricEncrypt() {
    "use strict";
    pw = makeid();
    var crypt = sjcl.encrypt(pw, $('#message').val());
    drop(crypt);
    $("#password").val(pw);

    $('html,body').animate({
            scrollTop: $("#password").offset().top},
        'slow');
}

function symmetricDecrypt (data) {
    try{
        "use strict";
        var pw = $("#password").val();
        //trim it
        pw = $.trim(pw);

        return sjcl.decrypt(pw, data);

    }catch(err){
        alert('Seems the password didn\'t work, ask for the information to be sent again');
        window.location.assign(root);
        return false;
    }
}



mail = function(){
    var subject = "I've Sent you a Dead Drop";
    var body = encodeURIComponent($("#finalData").text());
    window.open('mailto:nobody@nowhere.blah?subject='+subject+'&body='+body, '_Blank')
}

function drop (cryptData) {
    "use strict";
    $.post( "drop.php",{data:cryptData}, function(data) {
        $(".plain").hide(300,function(){
            var id = data.id;
            $("#url").text (buildUrl(id));
            $("#pass").text(pw);
            $(".dropComplete").show(200);
        }
        );


    });
}
function makeid()
{
    "use strict";

    var m = new MersenneTwister();


    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for ( var i =0; i < 15; i++ ){
        text += possible.charAt(Math.floor(m.random() * possible.length));
    }

    return text;
}

function getDrop(){

    if (typeof dropid == 'undefined' ){
        alert('no drop found');
        window.location.assign(root);
    }

    $.ajax({
        url: 'getdrop.php?id='+dropid,
        success: function (data) {
            if (data == null){
                alert('no drop found');
                window.location.assign(root);
                return false;
            }
            var plainText  = symmetricDecrypt( JSON.stringify(data));
            $("#decrypted").text(plainText);

            $(".encrypted").hide(300,function(){
                $(".final").show(300);
            });
        },
        error: function () {
            throw new Error("Could not load script " + script);
        }
    });
}

function buildUrl(id){
    "use strict";
    var http = location.protocol;
    var slashes = http.concat("//");
    var host = slashes.concat(window.location.hostname);
    var final = host.concat("/?id=");
    var final = final.concat(id);
    return final;

}

function require(script) {
    "use strict";
    $.ajax({
        url: script,
        dataType: "script",
        async: false,           // <-- this is the key
        success: function () {
            // all good...
        },
        error: function () {
            throw new Error("Could not load script " + script);
        }
    });
}

$(document).ready(function(){
    var http = location.protocol;
    var slashes = http.concat("//");
    root = slashes.concat(window.location.hostname);



    if (typeof dropid != 'undefined' ){
        //this is a pickup, show the password dialog
        $(".plain").hide();
        $(".encrypted").show();
    }else{
        $(".plain").show();
        $("#message").focus();

    }

    if (top != self) {
        top.location.assign(root);
    }
});