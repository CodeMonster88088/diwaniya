<x-public-layout title="الصور والقصائد">

    {{-- Page Header --}}
    <section class="public-page-header">
        <div class="public-container">

            <div class="page-heading">
                <h1>الصور والقصائد</h1>

                <p>
                    مجموعة من الصور التاريخية والقصائد المحفوظة
                    ضمن أرشيف ملا عطية الجمري
                </p>
            </div>

        </div>
    </section>


    {{-- Historical Photos --}}
    <section id="photos" class="archive-photos-section">

        <div class="public-container">

            <div class="archive-section-heading">
                <h2>الصور التاريخية</h2>
                <span></span>
            </div>

            @if ($photos->count())

                <div class="public-photo-grid">

                    @foreach ($photos as $photo)

                        <article class="public-photo-card">

                            <div class="public-photo-image">
                                <img src="{{ asset('storage/photos/' . $photo->filename) }}" alt="{{ $photo->title }}">
                            </div>

                            <div class="public-photo-content">

                                <h3>
                                    {{ $photo->title }}
                                </h3>

                                @if ($photo->photographed_at)
                                    <p class="public-photo-date">
                                        {{ $photo->photographed_at->format('Y-m-d') }}
                                    </p>
                                @endif

                                @if ($photo->description)
                                    <p class="public-photo-description">
                                        {{ $photo->description }}
                                    </p>
                                @endif

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="public-empty-state">
                    <h2>لا توجد صور حالياً</h2>

                    <p>
                        ستظهر الصور التاريخية هنا عند إضافتها إلى الأرشيف.
                    </p>
                </div>

            @endif

        </div>

    </section>


    {{-- Poems --}}
    <section id="poems" class="archive-poems-section">

        <div class="public-container">

            <div class="archive-section-heading">
                <h2>القصائد</h2>
                <span></span>
            </div>

            @if ($poems->count())

                <div class="public-poem-grid">

                    @foreach ($poems as $poem)

                        <article class="public-poem-card">

                            <div class="poem-decoration">
                                ❧
                            </div>

                            <h3>
                                <a href="{{ route('archive.poems.show', $poem) }}">
                                    {{ $poem->title }}
                                </a>
                            </h3>

                            @if ($poem->poet)
                                <p class="public-poet">
                                    {{ $poem->poet }}
                                </p>
                            @endif

                            @if ($poem->content)
                                <p class="public-poem-preview">
                                    {{ \Illuminate\Support\Str::limit($poem->content, 160) }}
                                </p>
                                <a href="{{ route('archive.poems.show', $poem) }}" class="read-poem-link">
                                    قراءة القصيدة كاملة
                                    ←
                                </a>
                            @endif

                            @if ($poem->written_at)
                                <p class="public-poem-date">
                                    {{ $poem->written_at->format('Y-m-d') }}
                                </p>
                            @endif

                        </article>

                    @endforeach

                </div>

            @else

                <div class="public-empty-state">
                    <h2>لا توجد قصائد حالياً</h2>

                    <p>
                        ستظهر القصائد هنا عند إضافتها إلى الأرشيف.
                    </p>
                </div>

            @endif

        </div>

    </section>

</x-public-layout>