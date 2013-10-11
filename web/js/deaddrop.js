/**
 * Created for Dead Drop
 * Date: 2013-10-08
 * Time: 10:28 AM
 */

var pw;
var errCount=0;

function symmetricEncrypt() {
    "use strict";
    pw = makeid();
    var crypt = sjcl.encrypt(pw, $('#message').val());
    drop(crypt);

//    $("#encryptedDisplay").text(crypt);
    $("#password").val(pw);
  //  $(".encrypt").show();
}

function symmetricDecrypt () {
    try{
    "use strict";
    var pw = $("#password").val();
    var data = $('#encrypted').text();
    console.log(data);
    var crypt = sjcl.decrypt(pw, data);
    $("#decrypted").text(crypt);
    $(".final").show();
    $(".encrypted").hide();
    }catch(err){
        errCount++;
        alert('uh oh, that didnt work');
        if (errCount ==3){
            location.reload();
        }

    }
}

function drop (cryptData) {
    "use strict";
    $.post( "drop.php",{data:cryptData}, function(data) {
        $(".plain").hide(300,function(){
                var id = data.id;
                $("#url").text (buildUrl(id));
                $("#pass").text(pw);
            $(".final").show(200);
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
        console.log(m.random());
        console.log(possible.charAt(Math.floor(m.random() * possible.length)));
        text += possible.charAt(Math.floor(m.random() * possible.length));
    }

    return text;
}

function getDrop(id){
    $.ajax({
        url: 'getdrop.php?id='+id,
        success: function (data) {
            $("#encrypted").text(JSON.stringify(data));
            $(".encrypted").show();
            $(".initial").hide();
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
    var final = host.concat("/pickup.php?id=");
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