var pw;

function symmetricEncrypt(){

    pw = makeid();
    var crypt= sjcl.encrypt(pw, $('#message').val())
    $("#encryptedDisplay").text(crypt);
    $("#password").val(pw);
    $(".encrypt").show();
    $(".plain").hide();
}

function symmetricDecrypt(){

}

function drop(){
    var cryptData = $("#encryptedDisplay").text();
    $.post( "drop.php",{data:cryptData}, function( data ) {
        $(".encrypt").hide();
        $(".final").show();

        var id = data.id;
        $("#url").text (buildUrl(id));
        $("#pass").text(pw);
    });
}
function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 15; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function buildUrl(id){
    var http = location.protocol;
    var slashes = http.concat("//");
    var host = slashes.concat(window.location.hostname);
    var final = host.concat("?id=");
    var final = final.concat(id);
    return final;

}

function require(script) {
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
}/**
 * Created with JetBrains PhpStorm.
 * User: bill
 * Date: 2013-10-08
 * Time: 10:28 AM
 * To change this template use File | Settings | File Templates.
 */

function showMessages(str) {
    alert(str);
}