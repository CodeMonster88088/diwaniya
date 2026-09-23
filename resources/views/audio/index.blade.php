<x-public-layout title="التسجيلات الصوتية">

    <section class="public-page-header">
        <div class="public-container">

            <div class="page-heading">

                <h1>التسجيلات الصوتية</h1>

                <p>
                    أرشيف التسجيلات الصوتية والجلسات والمحاضرات
                    المحفوظة لملا عطية الجمري
                </p>

            </div>

        </div>
    </section>


    <section class="audio-archive-section">

        <div class="public-container">

            @if ($audioRecordings->count())

                <div class="public-audio-list">

                    @foreach ($audioRecordings as $audio)

                        <article class="public-audio-card">

                            <div class="public-audio-info">

                                <h2>
                                    {{ $audio->title }}
                                </h2>

                                <div class="audio-meta">

                                    @if ($audio->speaker)
                                        <span>
                                            {{ $audio->speaker }}
                                        </span>
                                    @endif

                                    @if ($audio->recorded_at)
                                        <span>
                                            {{ $audio->recorded_at->format('Y-m-d') }}
                                        </span>
                                    @endif

                                    @if ($audio->category)
                                        <span>
                                            {{ $audio->category->name }}
                                        </span>
                                    @endif

                                </div>

                                @if ($audio->description)
                                    <p>
                                        {{ $audio->description }}
                                    </p>
                                @endif

                            </div>


                            <div class="public-audio-player">

                                <audio controls preload="metadata">
                                    <source
                                        src="{{ $audio->storage_url }}"
                                        type="{{ $audio->mime_type }}"
                                    >

                                    متصفحك لا يدعم تشغيل الملفات الصوتية.
                                </audio>

                            </div>

                        </article>

                    @endforeach

                </div>


                <div class="public-pagination">
                    {{ $audioRecordings->links() }}
                </div>

            @else

                <div class="public-empty-state">

                    <h2>
                        لا توجد تسجيلات حالياً
                    </h2>

                    <p>
                        ستظهر التسجيلات الصوتية هنا عند إضافتها إلى الأرشيف.
                    </p>

                </div>

            @endif

        </div>

    </section>

</x-public-layout>