<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Our Platform</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
  <style>
    body {
      width: 100%;
      max-width: 650px;
      margin: 30px auto;
      font-family: 'Nunito', sans-serif;
      background-color: #f4f4f9;
      color: #333;
      padding: 20px;
    }
    a {
      text-decoration: none;
      color: #ffffff;
    }
    p {
      font-size: 15px;
      line-height: 1.8;
      margin: 10px 0;
    }
    h1 {
      font-size: 28px;
      color: #4a4a4a;
      text-align: center;
    }
    .container {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 40px 30px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }
    .button {
      display: inline-block;
      padding: 14px 24px;
      background-color: #4f46e5;
      border-radius: 8px;
      font-weight: bold;
      margin: 20px auto;
      text-align: center;
      transition: background-color 0.3s ease;
    }
    .button:hover {
      background-color: #4338ca;
    }
    .footer {
      text-align: center;
      color: #666;
      font-size: 13px;
      margin-top: 30px;
    }
    .footer a {
      color: #4f46e5;
    }
  </style>
</head>
<body>
  <table width="100%">
    <tr>
      <td>
        <table class="container" align="center">
          <tr>
            <td style="text-align: center;">
              <img src="{{ asset('assets/images/brand/logo.png') }}" alt="Company Logo" style="max-width: 180px; margin-bottom: 20px;">
            </td>
          </tr>
          <tr>
            <td>
              <h1>Welcome  {{ $user->name }}!</h1>
              <p>We're excited to have you with us. Your journey with our platform starts now, and we’re here to support you every step of the way.</p>
              <p>Confirm your email address to unlock all features and get started:</p>
              <div style="text-align: center;">
                <a style="
                color: #fff !important;
                background-color: #5b7fff;
                border-color: #5b7fff;
                box-shadow: 0 0px 10px -5px rgba(91, 127, 255, 0.5);
            " href="{{route('registerConfirm')}}/{{ base64_encode($user->email) }}" class="button">Confirm My Email</a>
              </div>
              <p>If you didn’t sign up for this account, please disregard this email.</p>
              <p>Welcome aboard,<br><strong>The Support Team</strong></p>
            </td>
          </tr>
        </table>

        <table width="100%" style="margin-top: 30px; text-align: center;">
            <tr>
              <td class="footer">
                <p><a href="https://www.sufeelatif.com">www.sufeelatif.com</a></p>
                <p>WhatsApp: <a href="https://wa.me/923242193100">923242193100</a></p>
              </td>
            </tr>
          </table>
      </td>
    </tr>
  </table>
</body>
</html>
