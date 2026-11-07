<!doctype html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Password Reset</title>
  <style>
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table { border-collapse: collapse !important; }
    img { border: 0; line-height: 100%; text-decoration: none; -ms-interpolation-mode: bicubic; }
    a { text-decoration: none; }
    .preheader { display: none !important; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0; }
  </style>
</head>
<body style="margin:0; padding:30px; background-color:#f4f6f8; font-family: Arial, Helvetica, sans-serif; direction:ltr;">

  <!-- Preheader text -->
  <div class="preheader">
    Password reset request — use the link or code below to set a new password.
  </div>

  <!-- Main wrapper -->
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:24px 12px;">
    <tr>
      <td align="center">

        <!-- Email container -->
        <table role="presentation" width="680" cellpadding="0" cellspacing="0" style="max-width:680px; width:100%; background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 6px 18px rgba(0,0,0,0.06);">
          
          <!-- Header -->
          <tr>
            <td style="padding:20px 24px; text-align:center; background:linear-gradient(90deg,#0ea5a4,#06b6d4); color:#fff;">
              <h1 style="margin:0; font-size:20px; font-weight:700;">Password Reset</h1>
              <p style="margin:6px 0 0; font-size:13px; opacity:0.95;">Account recovery request — Support Team</p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding:28px 28px 16px; color:#213547;">
              <p style="margin:0 0 14px; font-size:16px; line-height:1.6;">
                Hello,
              </p>

              <p style="margin:0 0 14px; font-size:15px; line-height:1.6; color:#475569;">
                We received a request to reset the password for your account. You can reset it using the code below.
              </p>

              <!-- Token box -->
              <div style="text-align:center; margin:18px 0;">
                <div style="display:inline-block; background:#f8fafc; border:1px dashed #e6eef5; padding:14px 20px; border-radius:8px; font-size:22px; font-weight:700; letter-spacing:4px; color:#0f172a;">
                  {{ $token }}
                </div>
              </div>

              <!-- Action Button (optional) -->
              <!--
              <div style="text-align:center; margin:22px 0;">
                <a href="{{ url('/reset-password?token=' . $token) }}"
                   style="display:inline-block; background:linear-gradient(90deg,#0ea5a4,#06b6d4); color:#fff; padding:12px 26px; border-radius:8px; font-weight:700; font-size:16px; box-shadow:0 6px 18px rgba(6,182,212,0.18);">
                  Reset Password
                </a>
              </div>
              -->

              <p style="margin:20px 0 0; font-size:14px; color:#475569; line-height:1.6;">
                If you did not request a password reset, you can safely ignore this email. For any assistance, please contact our support team.
              </p>

              <p style="margin:18px 0 0; font-size:14px; color:#475569;">
                Best regards,
                <br>
                <strong>The Support Team</strong>
              </p>
            </td>
          </tr>

          <!-- Divider -->
          <tr>
            <td style="padding:0 24px;">
              <hr style="border:none; border-top:1px solid #eef2f7; margin:0;">
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding:14px 24px 28px; background:#fbfdff; color:#6b7280; font-size:13px; text-align:center;">
              <p style="margin:6px 0 0;">
                This email was sent automatically — please do not reply.
              </p>
              <p style="margin:8px 0 0; font-size:12px; color:#9aa4b2;">
                © {{ date('Y') }} App Name. All rights reserved.
              </p>
            </td>
          </tr>

        </table>
        <!-- End container -->

      </td>
    </tr>
  </table>

</body>
</html>
