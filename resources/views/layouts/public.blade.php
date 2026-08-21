<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'ديوانية ملا عطية الجمري' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="public-site">

    <header class="public-header">
        <div class="public-container public-nav">

            <div class="site-logo">
                ديوانية ملا عطية الجمري
            </div>

            <nav>
                <a href="/" class="active">الرئيسية</a>
                <a href="#">تسجيلات صوتية</a>
                <a href="#">الصور والقصائد</a>
                <a href="#">عن الديوانية</a>
            </nav>

        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

</body>
</html>