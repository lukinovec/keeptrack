<div class="flex flex-col items-center w-full h-full mt-24 md:mt-12 justify-evenly md:flex-row md:space-y-0 md:space-x-32" style="height: 59%">

        <section class="flex flex-col space-y-20">
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