@props(['title' => null])

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $title ? $title . ' | ' : '' }}ديوانية ملا عطية الجمري
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="public-site">

    <header class="public-header">

        <div class="public-container navbar">

            <a href="{{ route('home') }}" class="navbar-logo">

                <img src="{{ asset('images/diwaniya-logo.png') }}" alt="ديوانية ملا عطية الجمري">

            </a>

            <nav class="public-navigation">

                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    الرئيسية
                </a>

                <a href="{{ route('audio.index') }}" class="{{ request()->routeIs('audio.*') ? 'active' : '' }}">
                    تسجيلات صوتية
                </a>

                <a href="{{ route('archive.index') }}#photos">
                    الصور
                </a>

                <a href="{{ route('archive.index') }}#poems">
                    القصائد
                </a>

                <a href="#">
                    عن الديوانية
                </a>

            </nav>

        </div>

    </header>


    <main>
        {{ $slot }}
    </main>


    <footer class="public-footer">

        <img src="{{ asset('images/diwaniya-logo.png') }}" alt="ديوانية ملا عطية الجمري">

        <p>
            جميع الحقوق محفوظة — موقع أرشيفي غير تفاعلي
        </p>

    </footer>

</body>

</html>