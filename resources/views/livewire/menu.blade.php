<div class="z-30 flex flex-col items-center justify-between w-full h-full" style="height: 59%">

        <section class="flex m-16 space-x-6 sm:space-x-32">
            <a class="flex-1" href="/library/movie">
                <livewire:library-link type="movie" />
            </a>

            <a class="flex-1" href="/library/book">
                 <livewire:library-link type="book" />
            </a>
        </section>
        {{--
            Recently updated
            https://codepen.io/simeonunder2/pen/povGyVJ
        --}}
        <livewire:recently-updated :latestBook="$latestBook" :latestMovie="$latestMovie" />

</div>