<x-public-layout :title="$poem->title">

    <section class="poem-show-section">

        <div class="public-container">

            <article class="full-poem">

                <header class="full-poem-header">

                    <div class="full-poem-decoration">
                        ❧
                    </div>

                    <h1>
                        {{ $poem->title }}
                    </h1>

                    @if ($poem->poet)
                        <p class="full-poem-poet">
                            {{ $poem->poet }}
                        </p>
                    @endif

                    @if ($poem->written_at)
                        <p class="full-poem-date">
                            {{ $poem->written_at->format('Y-m-d') }}
                        </p>
                    @endif

                </header>


                @if ($poem->description)

                    <div class="full-poem-description">
                        {{ $poem->description }}
                    </div>

                @endif


                <div class="full-poem-content">

                    @foreach (preg_split('/\R/u', $poem->content) as $line)

                        @if (trim($line) === '')

                            <div class="poem-stanza-gap"></div>

                        @else

                            @php
                                // Your poems use multiple spaces between
                                // the two halves of each verse.
                                $parts = preg_split('/\s{3,}/u', trim($line), 2);
                            @endphp

                            <div class="poem-line">

                                <span class="poem-right-half">
                                    {{ $parts[0] }}
                                </span>

                                @if (isset($parts[1]))
                                    <span class="poem-left-half">
                                        {{ $parts[1] }}
                                    </span>
                                @endif

                            </div>

                        @endif

                    @endforeach

                </div>


                <div class="full-poem-back">

                    <a href="{{ route('archive.index') }}">
                        العودة إلى الصور والقصائد
                    </a>

                </div>

            </article>

        </div>

    </section>

</x-public-layout>