<x-public-layout title="الرئيسية">

    <section class="public-hero">

        <div class="public-container hero-grid">

            {{-- Portrait --}}
            <div class="hero-portrait">
                <img
                    src="{{ asset('images/mulla-atiya.png') }}"
                    alt="ملا عطية الجمري"
                >
            </div>


            {{-- Content --}}
            <div class="hero-content">

                <img
                    src="{{ asset('images/diwaniya-logo.png') }}"
                    alt="ديوانية ملا عطية الجمري"
                    class="hero-calligraphy"
                >

                <p class="hero-description">
                    أرشيف يحفظ الصوت والكلمة والصورة
                    <br>
                    للإرث الثقافي والشعري لملا عطية الجمري
                </p>

                <div class="hero-actions">
                    <span class="archive-button">
                        <span class="archive-icon">▣</span>
                        موقع أرشيفي فقط
                    </span>
                </div>

            </div>

        </div>

    </section>
    <section class="archive-notice-section">

    <div class="public-container">

        <div class="archive-notice">

            <div class="archive-notice-icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="32"
                    height="32"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <rect x="4" y="7" width="16" height="13" rx="1" />
                    <path d="M3 4h18v3H3z" />
                    <path d="M9 11h6" />
                </svg>
            </div>

            <div class="archive-notice-text">
                <p>
                    هذا الموقع هو أرشيفي غير تفاعلي يهدف إلى حفظ إرث
                    ملا عطية الجمري من التسجيلات الصوتية
                    والصور التاريخية والقصائد التي كتبها.
                </p>
            </div>

        </div>

    </div>

</section>

</x-public-layout>