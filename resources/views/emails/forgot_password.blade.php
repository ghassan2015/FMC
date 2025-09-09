<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور</title>
    <style>
        * {
            margin: 0;
           
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f8fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background: white;
            max-width: 500px;
            width: 100%;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .content {
            padding: 30px;
            color: #333;
        }

        .greeting {
            font-size: 20px;
            margin-bottom: 20px;
            color: #1e293b;
        }

        .code-container {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }

        .code-label {
            font-size: 16px;
            color: #64748b;
            margin-bottom: 10px;
        }

        .code {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 8px;
            color: #4f46e5;
            background: white;
            padding: 15px;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .instructions {
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            border-radius: 0 8px 8px 0;
            margin: 25px 0;
            font-size: 15px;
            color: #854d0e;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #64748b;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>إعادة تعيين كلمة المرور</h1>
            <p>استلم رمز التحقق لإكمال العملية</p>
        </div>

        <div class="content">
            <div class="greeting">
                مرحبًا بك <strong>{{ $username }}</strong>،
            </div>

            <p>لقد طلبت إعادة تعيين كلمة المرور لحسابك. يرجى استخدام كود التحقق التالي:</p>

            <div class="code-container">
                <div class="code-label">كود التحقق</div>
                <div class="code">{{ $code }}</div>
            </div>

            <div class="instructions">
                ⚠️ يرجى عدم مشاركة هذا الرمز مع أي شخص. هذا الرمز صالح لمدة 15 دقيقة فقط.
            </div>

            <p>إذا لم تطلب إعادة تعيين كلمة المرور، يمكنك تجاهل هذا البريد.</p>
        </div>

        <div class="footer">
            © {{ date('Y') }} {{ config('app.name') }}. جميع الحقوق محفوظة.
        </div>
    </div>
</body>
</html>
