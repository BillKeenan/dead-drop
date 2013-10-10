<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Allows you to create a one-time use link to securely send passwords or other information" />
    <meta name="keywords" content="dead drop,security,encryption,passwords,secure" />
    <meta name="author" content="metatags generator">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="3 month">
    <title>Send Secure information, passwords, links, dead drop</title>
    <!-- secure, password, encryption -->

    <style>
        .encrypt{
            display: none;
        }
        .final .decrypted{
            display: none;
        }

        .final{display:none;}
        .encrypted{ display: none;}
        .code{
            font-weight:bold;font-weight:normal;color:grey;letter-spacing:0pt;word-spacing:0pt;font-size:13px;text-align:left;font-family:tahoma, verdana, arial, sans-serif;line-height:1;
        }

    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/skull.png">

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="/dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <script>
        if (top != self) {
            top.location.href = 'http://yoururl/';
        }
    </script>
    <![endif]-->
</head>

<body>

<div class="container theme-showcase">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1>One Time Dead Drop</h1>
        <p>Need to send some data securely? Password? Love Note? Haiku? This is the place</p>
        <p><a class="btn btn-primary btn-lg" href="#about">Learn more &raquo;</a></p>
    </div>


    <div class="row initial" id="encryptedRow" >
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"> Ok, you found a drop, make sure you have the password and press the button to load the encrypted data. You will then be able to use your password to decrpt it securely in your browser.
                        <br>
                        <br>
                        <strong>NOTE:</strong>&nbsp;once you push that button, the data WILL be deleted on the server, there are no second chances.</h3>
                </div>
                <div class="panel-body">
                    <div style="overflow: auto" id="encryptedDisplay"></div>
                </div>
                <div class="panel-footer">
                   <button type="button" class="btn btn-lg btn-primary" onclick="getDrop('<?php echo($_GET["id"]); ?>')">Get My Drop</button>
                </div>
            </div>
        </div><!-- /.col-sm-4 -->
    </div>
<p></p>
    <div class="row encrypted" >

        <div class="alert alert-success">
            Ok, you got the drop, it NO LONGER EXISTS on the server, so enter your password and click the decrypt button.
        </div>

        <!-- /.col-sm-4 -->
    </div>
    <div class="row encrypted" id="finalRow" >
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Encrypted Data</h3>
                </div>
                <div class="panel-body">
                    <div style="overflow: auto" id="encrypted">

                    </div>
                </div>
                <div class="panel-footer">
                    <span class="col-sm-3"><input  type="text" id="password" placeholder="Enter your password here" size="25"/></span>
                    <button type="button" class="btn btn-lg btn-primary" onclick="symmetricDecrypt()">Decrypt</button>
                </div>
            </div>
        </div><!-- /.col-sm-4 -->
    </div>

    <div class="row final" >

        <div class="alert alert-success">
            All Done.
        </div>

        <!-- /.col-sm-4 -->
    </div>
    <div class="row final" id="finalRow" >
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Decrypted Data</h3>
                </div>
                <div class="panel-body">
                    <div style="overflow: auto" id="decrypted">

                    </div>
                </div>
                <div class="panel-footer">

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
                    This isn't great <b>That email sits on a server forever! if their email is EVER compromised then so is your data</b>

                    <br>
                    <br>
                    Here we follow a couple basic steps.
                    <ul>
                        <li>We never send your data over the wire unencrypted. We do it all via javascript in YOUR browser</li>
                        <li>We can not decrypt your data, we simply don't have the password</li>
                        <li>We do not use cookies. the end.</li>
                        <li>We do not log your I.P., we log the visit for load calculations, but nothing ABOUT you</li>
                        <li>We don't do encryption, we leave that to the clever people at <a target="_blank" href="http://bitwiseshiftleft.github.io/sjcl/">Stanford</a></li>
                        <li>Error on the side of safety, something goes wrong (wrong password,etc..) we delete the data. This is not a locker.</li>
                    </ul>
                    <h2>So is this safe?</h2>
                    The design is such that your on IM with someone, or in email conversation, and you want to send some secure data NOW. So you create the dead drop and send the info.
                    <br>
                    The issues are
                    <ul>
                        <li>someone gets the url/password before the intended recipient.
                        <li>If their email is compromised, and someone is monitoring it, well your out of luck</li>
                        <li>you text the info, and someone else has the recipients phone</li>
                    </ul>
                    I think that if these are issues, your a <a target="_blank" href="http://en.wikipedia.org/wiki/James_Bond">spy</a> of some sort and really shouldn't be using anonymous services on the internet.
                    <p></p>

                    <h2>What if your lying?</h2>
                    Well, your a clever person, have a look at the <a href="js/deaddrop.js" target="_blank">code</a>
                    <h2>Technologies in Use</h2>
                    <a target="_blank" href="https://gist.github.com/banksean/300494">MersenneTwister implementation in javacsript</a>
                    <br>
                    <a target="_blank" href="http://bitwiseshiftleft.github.io/sjcl/">Symmetric Encryption in javascript</a>
                </div>
            </div>
        </div><!-- /.col-sm-4 -->
    </div>

</div> <!-- /container -->

 <pre id="pubkey">

 </pre>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/assets/js/jquery.js"></script>
<script src="/js/deaddrop.js"></script>
<script src="/dist/js/bootstrap.min.js"></script>
<script src="/assets/js/holder.js"></script>
<script src="/js/sjcl.js"></script>
<script src="/js/merseen.js"></script>
</body>
</html>
