<x-public-layout title="الصور والقصائد">

```
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

                            <button
                                type="button"
                                class="photo-lightbox-trigger"
                                data-photo-index="{{ $loop->index }}"
                                aria-label="عرض {{ $photo->title }}"
                            >
                                <img
                                    src="{{ asset('storage/photos/' . $photo->filename) }}"
                                    alt="{{ $photo->title }}"
                                >
                            </button>

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


            {{-- Photo Lightbox --}}
            <div
                id="photoLightbox"
                class="photo-lightbox"
                aria-hidden="true"
            >

                <button
                    type="button"
                    class="photo-lightbox-close"
                    aria-label="إغلاق"
                >
                    &times;
                </button>


                <button
                    type="button"
                    class="photo-lightbox-prev"
                    aria-label="الصورة السابقة"
                >
                    ‹
                </button>


                <div class="photo-lightbox-content">

                    <img
                        id="lightboxImage"
                        src=""
                        alt=""
                    >


                    <div class="photo-lightbox-info">

                        <h3 id="lightboxTitle"></h3>

                        <p id="lightboxDate"></p>

                        <p id="lightboxDescription"></p>

                        <span id="lightboxCounter"></span>

                    </div>

                </div>


                <button
                    type="button"
                    class="photo-lightbox-next"
                    aria-label="الصورة التالية"
                >
                    ›
                </button>

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


                            <a
                                href="{{ route('archive.poems.show', $poem) }}"
                                class="read-poem-link"
                            >
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


{{-- Prepare Photo Data for JavaScript --}}
@php

    $archivePhotos = $photos->values()->map(function ($photo) {

        return [
            'src' => asset('storage/photos/' . $photo->filename),
            'title' => $photo->title,
            'date' => $photo->photographed_at
                ? $photo->photographed_at->format('Y-m-d')
                : '',
            'description' => $photo->description ?? '',
        ];

    });

@endphp


{{-- Photo Data --}}
<script>
    const archivePhotos = {{ Js::from($archivePhotos) }};
</script>


{{-- Photo Lightbox JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const lightbox =
            document.getElementById('photoLightbox');

        const image =
            document.getElementById('lightboxImage');

        const title =
            document.getElementById('lightboxTitle');

        const date =
            document.getElementById('lightboxDate');

        const description =
            document.getElementById('lightboxDescription');

        const counter =
            document.getElementById('lightboxCounter');


        const closeButton =
            document.querySelector('.photo-lightbox-close');

        const previousButton =
            document.querySelector('.photo-lightbox-prev');

        const nextButton =
            document.querySelector('.photo-lightbox-next');


        let currentIndex = 0;


        /*
         * Show a specific photo
         */
        function showPhoto(index) {

            if (!archivePhotos.length) {
                return;
            }


            currentIndex =
                (index + archivePhotos.length) %
                archivePhotos.length;


            const photo =
                archivePhotos[currentIndex];


            image.src = photo.src;

            image.alt = photo.title;


            title.textContent =
                photo.title;


            date.textContent =
                photo.date;

            date.style.display =
                photo.date ? '' : 'none';


            description.textContent =
                photo.description;

            description.style.display =
                photo.description ? '' : 'none';


            counter.textContent =
                (currentIndex + 1) +
                ' / ' +
                archivePhotos.length;
        }


        /*
         * Open lightbox
         */
        function openLightbox(index) {

            showPhoto(index);


            lightbox.classList.add('active');

            lightbox.setAttribute(
                'aria-hidden',
                'false'
            );


            document.body.classList.add(
                'lightbox-open'
            );
        }


        /*
         * Close lightbox
         */
        function closeLightbox() {

            lightbox.classList.remove('active');


            lightbox.setAttribute(
                'aria-hidden',
                'true'
            );


            document.body.classList.remove(
                'lightbox-open'
            );


            image.src = '';
        }


        /*
         * Open photo when clicked
         */
        document
            .querySelectorAll('.photo-lightbox-trigger')
            .forEach(button => {

                button.addEventListener(
                    'click',
                    () => {

                        const index =
                            Number(
                                button.dataset.photoIndex
                            );


                        openLightbox(index);
                    }
                );

            });


        /*
         * Close button
         */
        closeButton.addEventListener(
            'click',
            closeLightbox
        );


        /*
         * Previous photo
         */
        previousButton.addEventListener(
            'click',
            () => {

                showPhoto(
                    currentIndex - 1
                );

            }
        );


        /*
         * Next photo
         */
        nextButton.addEventListener(
            'click',
            () => {

                showPhoto(
                    currentIndex + 1
                );

            }
        );


        /*
         * Close when clicking outside the image
         */
        lightbox.addEventListener(
            'click',
            event => {

                if (
                    event.target === lightbox
                ) {

                    closeLightbox();

                }

            }
        );


        /*
         * Keyboard controls
         */
        document.addEventListener(
            'keydown',
            event => {

                if (
                    !lightbox.classList.contains(
                        'active'
                    )
                ) {
                    return;
                }


                /*
                 * Escape
                 */
                if (
                    event.key === 'Escape'
                ) {

                    closeLightbox();

                }


                /*
                 * Previous
                 */
                if (
                    event.key === 'ArrowLeft'
                ) {

                    showPhoto(
                        currentIndex - 1
                    );

                }


                /*
                 * Next
                 */
                if (
                    event.key === 'ArrowRight'
                ) {

                    showPhoto(
                        currentIndex + 1
                    );

                }

            }
        );

    });
</script>
```

</x-public-layout>
