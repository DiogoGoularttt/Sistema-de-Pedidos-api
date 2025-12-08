<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
        body {
            margin: 0;
            padding: 40px 0;
            background: linear-gradient(to bottom right, #fff7ed, #ffffff, #fffbeb);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #374151;
        }

        .wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 600px;
            background: #ffffff;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        h1,
        h2,
        h3 {
            color: #111827;
            font-weight: 700;
        }

        a.button {
            display: inline-block;
            background-color: #f97316;
            color: white !important;
            padding: 14px 26px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            margin-top: 20px;
        }

        a.button:hover {
            background-color: #ea580c;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            margin-top: 32px;
        }

        .subcopy {
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
            font-size: 13px;
            line-height: 1.4;
            color: #6b7280;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="card">

            {{-- BODY --}}
            <div>
                {{ $slot }}
            </div>

            {{-- SUBCOPY --}}
            @isset($subcopy)
                <div class="subcopy">
                    {{ $subcopy }}
                </div>
            @endisset

            {{-- FOOTER --}}
            @isset($footer)
                <div class="footer">
                    {{ $footer }}
                </div>
            @endisset

        </div>
    </div>

</body>

</html>
