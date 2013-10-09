<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .encrypt{
            display: none;
        }
        .final{
            display: none;
        }

        .code{
            font-weight:bold;font-weight:normal;color:grey;letter-spacing:0pt;word-spacing:0pt;font-size:13px;text-align:left;font-family:tahoma, verdana, arial, sans-serif;line-height:1;
        }

    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/assets/ico/favicon.png">

    <title>Theme Template for Bootstrap</title>

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



<div class="page-header">
    <h1>Enter the info to secure</h1>
</div>
    <div class="row encrypt" >

        <div class="alert alert-success">
            Ok, data encrypted securely, in your browser. Click below to create the drop and get the link to send
        </div>

        <!-- /.col-sm-4 -->
    </div>
    <div class="row encrypt" id="encryptedRow" >
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Encrypted Data</h3>
                </div>
                <div class="panel-body">
                    <div style="overflow: auto" id="encryptedDisplay"></div>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-lg btn-primary" onclick="drop()">Make The Drop</button>
                </div>
            </div>
        </div><!-- /.col-sm-4 -->
    </div>
<p></p>
        <div class="row final" >

            <div class="alert alert-success">
                Ok, drop made, you need to send the info below, we recomend sending the url/password seperately (email/messenger/text)
            </div>

            <!-- /.col-sm-4 -->
        </div>
        <div class="row final" id="encryptedRow" >
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Final Data</h3>
                    </div>
                    <div class="panel-body">
                        <div style="overflow: auto" id="finalData">
                            Hi,<br>
                            I'm sending you some secure data.
                            <br>
                            Click here <span class="code" id="url"></span>
                            <br>
                            and use the password <span class="code" id="pass"></span>.
                            <br>
                            This will ONLY work once, so be careful with the password, and make sure to copy the data immediately.
                            <br>
                            After you pick it up, the data will self destruct and this link won't work anymore.
                            <br>
                            Thanks!
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="button" class="btn btn-lg btn-primary" onclick="copy()">Copy To Clipboard</button>
                    </div>
                </div>
            </div><!-- /.col-sm-4 -->
        </div>
        <p></p>
    <div class="row plain" id="plainTextRow">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Data To Encrypt</h3>
                </div>
                <div class="panel-body">
                    <textarea name="message" id="message" style="width:100%" rows="11"></textarea>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-lg btn-primary" onclick="symmetricEncrypt()">Encrypt!</button>
                    <button type="button" class="btn btn-lg btn-primary" onclick="symmetricDecrypt()">Decrypt!</button>
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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sit amet suscipit dolor. Pellentesque ac vulputate urna. Integer vitae diam lectus. Etiam hendrerit scelerisque quam vitae venenatis. Ut in sem vitae arcu faucibus fermentum. Sed ac mi purus. Cras fermentum magna nec ante dictum fermentum. Proin at metus sapien. In sollicitudin varius ante eget tincidunt. Nullam tempor felis quis est semper sagittis. Curabitur id est nec libero tincidunt varius non ut sem. Aliquam tincidunt, nisl a volutpat dapibus, eros mi imperdiet mauris, eget feugiat diam odio a nulla. Proin porta nunc id dolor tempus euismod. Pellentesque ullamcorper, felis varius ultrices scelerisque, quam magna aliquam augue, tristique molestie dolor tortor vitae lorem. Aenean quis faucibus nisi.
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
</body>
</html>
