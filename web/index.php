<?php
include_once("./class/storage.php");
?><!DOCTYPE html>
<html lang="en">
<head>
<meta property="og:image" content="http://dead-drop.me/skull.png" />
    <meta name="description" content="Allows you to create a one-time use link to securely send passwords or other information" />
    <meta name="keywords" content="dead drop,security,encryption,passwords,secure" />
    <meta name="author" content="metatags generator">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="3 month">
    <title>Send Secure information, passwords, links, dead drop</title>
    <!-- secure, password, encryption -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>

    <![endif]-->


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">


    <style>
        .dropComplete{
            display: none;
        }
        .plain{
            display:none;
        }
        .final{
            display: none;
        }

        .code{
            font-weight:bold;font-weight:normal;color:grey;letter-spacing:0pt;word-spacing:0pt;font-size:13px;text-align:left;font-family:tahoma, verdana, arial, sans-serif;line-height:1;
        }
        .final .decrypted{
            display: none;
        }

        .encrypted{ display: none;}

        code{
            white-space: pre-wrap;
        }

    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/skull.png">



    <script>
        <?php

            if (array_key_exists("id",$_GET)){
                 echo(sprintf("var dropid='%s';\r\n",$_GET["id"]));
            }
     ?>

    </script>
</head>

<body>
<input type="hidden" id="formKey" value="<?php print( Storage::timedKey()); ?>">
    <div class="container theme-showcase">

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <h1>One Time Dead Drop</h1>
    <p>Need to send some data securely? Password? Love Note? Haiku? This is the place.</p>
    <div class="col-sm-6"><a class="btn btn-primary btn-lg" href="#about">Learn more &raquo;</a></div>
    <div class="col-sm-6"><h2>This is available over <a href="http://yoewa2oiuuducqb5.onion/">TOR</a></h2></div>
<br>
</div>





        <div class="row dropComplete" >
            <div class="alert alert-success">
                THIS IS THE PASSWORD! YOU NEED TO COPY THIS!-> <strong><span id="pass"></span></strong>
            </div>


            <div class="alert alert-success">
                Ok, drop made, you need to send the info below, we recomend sending the url/password seperately (email/messenger/text)
            </div>

            <!-- /.col-sm-4 -->
        </div>
        <div class="row dropComplete" id="finalRow" >
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Final Data</h3>
                    </div>
                    <div class="panel-body">
                        <div style="overflow: auto" id="finalData">
Hi,<br>
I'm sending you some secure information.
<br>
Click here <span class="code" id="url"></span>
<br>
and use the password I sent you in the other email
<br>
This will ONLY work once, so be careful with the password, and make sure to copy the data immediately.
<br>
After you pick it up, the data will self destruct and this link won't work anymore.
<br>
This link will only work for 24 hours, so please check shortly.
<br>
Thanks!
                        </div>
                        <p>

                        </p>
                        <div></div>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-lg btn-primary" onclick="window.location.assign(root)">Make another  Drop</button>
                    </div>
                </div>
            </div><!-- /.col-sm-4 -->


        </div>
        <p></p>
        <div class="page-header plain">
            <h1>Enter the info to secure:</h1>
        </div>

    <div class="row plain" id="plainTextRow">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <textarea name="message" id="message" style="width:100%" rows="11"></textarea>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-lg btn-primary" onclick="symmetricEncrypt()">Make the drop!</button>
                </div>
            </div>
        </div><!-- /.col-sm-4 -->
    </div>

<div class="row encrypted" >


    <!-- /.col-sm-4 -->
</div>
<div class="row encrypted" id="finalRow" >
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Retrieve a the Drop</h3>
            </div>
            <div class="panel-body">
                <div style="overflow: auto">
                    Entering the password and clicking <strong>'Get The Drop'</strong> WILL delete the information on the server. Ensure you have correctly copied the password.
                </div>
                <br><br>
                <span class="col-sm-3"><input  type="text" id="password" placeholder="Enter your password here" size="25"/></span>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-lg btn-primary" onclick="getDrop()">Get The Drop</button>
            </div>
        </div>
    </div><!-- /.col-sm-4 -->
</div>

<div class="row final" >

    <div class="alert alert-success">
        Success
    </div>

    <!-- /.col-sm-4 -->
</div>
<div class="row final" id="finalRow" >
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Your Dead Drop</h3>
            </div>
            <div class="panel-body">
                <div style="overflow: auto" id="decrypted">

                </div>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-lg btn-primary" onclick="window.location.assign(root)">Make your own Drop</button>
            </div>
        </div>
    </div><!-- /.col-sm-4 -->
</div>


<a id="about"></a>
<div class="page-header">
    <h1>How Does This Work?</h1>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h2>The Problem</h2>
                Sending someone secure data is a real hassle. If they don't have GPG, or some such tool, then what do you do? Send a user name in one email. password in another most likely.
                <br>
                This isn't great.<br>
                <b>That email sits on a server forever! If their email is EVER compromised, then so is your data.</b>

                <br>
                <br>
                Here we follow a couple basic steps.
                <ul>
                    <li>Dead Drops are only stored for 24 hours, then they are deleted</li>
                    <li>We never send your data over the wire unencrypted&ndash;we do it all via javascript in YOUR browser</li>
                    <li>We can not decrypt your data, we simply don't have the password</li>
                    <li>We do not use cookies. THE END.</li>
                    <li>We do not log your I.P.&ndash;we log the visit for load calculations, but nothing ABOUT you</li>
                    <li>We don't do encryption&ndash;we leave that to the clever people at <a target="_blank" href="http://bitwiseshiftleft.github.io/sjcl/">Stanford</a></li>
                    <li>We Err on the side of safety&ndash;if an incorrect password is entered, or if anything else goes wrong we delete the data. This is not a locker service</li>
                </ul>
                <h2>So, is this safe?</h2>
                The possible security issues depend on what form of communication you're using, ie: text message, email, carrier pigeon, etc.
                <br>
                The issues are
                <ul>
                    <li>someone gets the url/password before the intended recipient.
                    <li>If their email is compromised, and someone is monitoring it, well your out of luck</li>
                    <li>you text the info, and someone else has the recipients phone</li>
                </ul>
                If these are deal breakers, you're probably a <a target="_blank" href="http://en.wikipedia.org/wiki/James_Bond">spy</a> of some sort, and thus shouldn't be using anonymous services on the internet.
                <br>
                The security of the encryption used is handled by the Symmetric Encryption engine developed at Stanford<br>
                <code>"SJCL is secure. It uses the industry-standard AES algorithm at 128, 192 or 256 bits; the SHA256 hash <br>
                    function; the HMAC authentication code; the PBKDF2 password strengthener; <br>
                    and the CCM and OCB authenticated-encryption modes."</code>
                <p></p>

                <h2>What if you're lying?</h2>
                Well, you're a clever person, have a look at the <a href="js/deaddrop.js" target="_blank">code.</a>
                <h2>Technologies in Use</h2>
                <a target="_blank" href="https://gist.github.com/banksean/300494">MersenneTwister implementation in javacsript</a>
                <br>
                <a target="_blank" href="http://bitwiseshiftleft.github.io/sjcl/">Symmetric Encryption in javascript</a>
<br>
                <a href="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">Jquery 1.10.2</a>
<br>
                <a href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js">bootstrap 3.0.0.0</a>
                <br>

                <a href="/js/merseen.js">A local version of the merseen script referenced above</a>

                <h2>Suggestions? Ideas?</h2>
                <script>document.write('<'+'a'+' '+'h'+'r'+'e'+'f'+'='+"'"+'m'+'&'+'#'+'9'+'7'+';'+'i'+'l'+'t'+'&'+'#'+'1'+'1'+'1'+';'+'&'+
                        '#'+'5'+'8'+';'+'&'+'#'+'9'+'8'+';'+'i'+'%'+'6'+'C'+'%'+'6'+'C'+'%'+'4'+'0'+'b'+'%'+'6'+'9'+'g'+'%'+
                        '&'+'#'+'5'+'4'+';'+'D'+'o'+'j'+'&'+'#'+'3'+'7'+';'+'6'+'F'+'&'+'#'+'4'+'6'+';'+'%'+'6'+'E'+'%'+'6'+
                        '&'+'#'+'5'+'3'+';'+'t'+"'"+'>'+'b'+'i'+'l'+'l'+'&'+'#'+'6'+'4'+';'+'b'+'&'+'#'+'1'+'0'+'5'+';'+'g'+
                        'm'+'o'+'j'+'o'+'&'+'#'+'4'+'6'+';'+'n'+'&'+'#'+'1'+'0'+'1'+';'+'t'+'<'+'/'+'a'+'>');</script><noscript>[Turn on JavaScript to see the email address]</noscript>
<br>

            </div>

            <div class="row plain" id="plainTextRow">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">GPG Public key for bill@bigmojo.net</h3>
                        </div>
                        <div class="panel-body">
                            <pre>
-----BEGIN PGP PUBLIC KEY BLOCK-----
Version: GnuPG/MacGPG2 v2.0.20 (Darwin)
Comment: GPGTools - http://gpgtools.org

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
=9n1M
-----END PGP PUBLIC KEY BLOCK-----

</pre>
                        </div>
                        <div class="panel-footer">
                        </div>
                    </div>
                </div><!-- /.col-sm-4 -->
            </div>
            </div>
        </div>
    </div><!-- /.col-sm-4 -->
</div>

</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//crypto.stanford.edu/sjcl/sjcl.js"></script>
    <script type="text/javascript" src="/min/?f=js/deaddrop.js,js/merseen.js&456&2"></script>
<!-- local all hosted version
    <script type="text/javascript" src="/min/?f=assets/js/jquery.js,js/deaddrop.js,dist/js/bootstrap.min.js,assets/js/holder.js,js/sjcl.js,js/merseen.js&456&1"></script>
-->

</body>
</html>
