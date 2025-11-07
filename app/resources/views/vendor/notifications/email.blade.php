@php
    $appName  = "Notes";
    $resetUrl = $actionUrl ?? null;

    $brandTopA = '#6B8BFF';
    $brandTopB = '#6F5BFF';
    $btnColor  = '#5E55FF';
@endphp
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Восстановление доступа</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    .preheader { display:none!important; visibility:hidden; opacity:0; color:transparent; height:0; width:0; overflow:hidden; mso-hide:all; }
    @media (max-width:620px){
      .container{ width:100%!important; }
      .p-24{ padding:20px !important; }
      .btn{ width:100% !important; }
    }
  </style>
</head>
<body style="margin:0; padding:0; background:#F6F7FB;">
  <div class="preheader">
    Сброс пароля для вашей учётной записи в {{ $appName }}. Если вы не запрашивали — игнорируйте письмо.
  </div>

  <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0" style="background:#F6F7FB; padding:24px 12px;">
    <tr>
      <td align="center">
        <table role="presentation" class="container" width="600" border="0" cellspacing="0" cellpadding="0"
               style="max-width:600px; width:600px; background:#FFFFFF; border-radius:16px; overflow:hidden; box-shadow:0 8px 28px rgba(16,24,40,.06);">
          <tr>
            <td style="padding:28px 24px; color:#ffffff; background:{{ $brandTopA }};
                       background:linear-gradient(135deg, {{ $brandTopA }}, {{ $brandTopB }} 65%);">
              <div style="font:14px/1.4 -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial; opacity:.9; margin:0 0 8px 0;">
              </div>
              <h1 style="margin:0; font:700 22px/1.35 -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial;">🔑 Восстановление доступа</h1>
            </td>
          </tr>

          <tr>
            <td class="p-24" style="padding:28px 24px; color:#2B2F36; font:15px/1.65 -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial;">
              <h2 style="margin:0 0 8px 0; font:700 18px/1.4 -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial; color:#14171F;">
                Привет!
              </h2>

              <p style="margin:0 0 16px 0;">
                Похоже, вы запросили сброс пароля для своей учётной записи в <strong>{{ $appName }}</strong>.
                Не переживайте — всё под контролем. Мы поможем вернуть доступ к вашим идеям 💡
              </p>

              @if($resetUrl)
              <!-- Кнопка: VML для Outlook -->
              <!--[if mso]>
              <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="left" style="margin:18px 0 8px;">
                <tr>
                  <td align="left">
                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" arcsize="20%" href="{{ $resetUrl }}"
                      style="height:46px; v-text-anchor:middle; width:260px;" strokecolor="{{ $btnColor }}" fillcolor="{{ $btnColor }}">
                      <w:anchorlock/>
                      <center style="color:#FFFFFF; font-family:Arial, sans-serif; font-size:16px; font-weight:bold;">
                        Сбросить пароль
                      </center>
                    </v:roundrect>
                  </td>
                </tr>
              </table>
              <![endif]-->

              <!-- Остальные клиенты -->
              <!--[if !mso]><!-- -->
              <p style="margin:18px 0 8px;">
                <a href="{{ $resetUrl }}" class="btn"
                   style="display:inline-block; padding:14px 28px; background:{{ $btnColor }}; color:#fff !important;
                          border-radius:12px; font-weight:700; letter-spacing:.2px;">
                  Сбросить пароль
                </a>
              </p>
              <!--<![endif]-->
              @endif

              <div style="height:1px; background:#EEF0F4; margin:22px 0;"></div>

              <p style="margin:0 0 8px 0; color:#6B7280;">
                Если кнопка не работает, используйте ссылку ниже:
              </p>

              <div style="background:#F8F9FF; border:1px solid #ECEFFD; border-radius:12px; padding:14px 16px; word-break:break-word;">
                👉 <a href="{{ $resetUrl }}" style="color:#4F46E5; text-decoration:underline;">{{ $resetUrl }}</a>
              </div>

              <div style="height:1px; background:#EEF0F4; margin:22px 0;"></div>

              <p style="margin:0;">
                <strong>Совет:</strong> после восстановления пароля сохраните его в менеджере паролей, чтобы всегда иметь доступ к своим заметкам.
              </p>

              <p style="margin:14px 0 0 0; color:#98A2B3; font-size:13px;">
                Если вы не запрашивали сброс пароля, проигнорируйте письмо — доступ останется без изменений.
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding:16px 24px 28px; text-align:center; color:#98A2B3; font:13px/1.5 -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial;">
              Берегите свои идеи — команда <strong style="color:#6B7280;">{{ $appName }}</strong> всегда рядом 🌿
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
