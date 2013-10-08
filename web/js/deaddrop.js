function encrypt() {
    if (window.crypto.getRandomValues) {
        require("./openpgp.min.js");
        openpgp.init();
        var pub_key = openpgp.read_publicKey($('#pubkey').text());
        $('#message').val(openpgp.write_encrypted_message(pub_key,$('#message').val()));
        window.alert("This message is going to be sent:\n" + $('#message').val());
        return true;
    } else {
        $("#mybutton").val("browser not supported");
        window.alert("Error: Browser not supported\nReason: We need a cryptographically secure PRNG to be implemented (i.e. the window.crypto method)\nSolution: Use Chrome >= 11, Safari >= 3.1 or Firefox >= 21");
        return false;
    }
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
