<div>
    <div class="text-center">
        <livewire:search-bar />
    </div>
    @if ($isSearch === false)
    <div class="flex flex-row h-full w-full justify-center align-middle">
        <div class="flex-1 mt-64 text-center">
            <span class="font-extrabold">Movies & TV Shows</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="96" height="96"
                class="icon-film m-auto rounded-full transition duration-150 ease-in-out hover:bg-gray-400 p-2 bg-gray-200">
                <path class="primary"
                    d="M4 3h16a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v2h2V5H4zm0 4v2h2V9H4zm0 4v2h2v-2H4zm0 4v2h2v-2H4zM18 5v2h2V5h-2zm0 4v2h2V9h-2zm0 4v2h2v-2h-2zm0 4v2h2v-2h-2z" />
                <path class="secondary"
                    d="M9 5h6a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1zm0 8h6a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-4a1 1 0 0 1 1-1z" />
            </svg>
        </div>

        <div class="flex-1 mt-64 text-center">
            <span class="font-extrabold">Books</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="96" height="96"
                class="icon-book-open m-auto rounded-full transition duration-150 ease-in-out hover:bg-gray-400 p-2 bg-gray-200">
                <g>
                    <path class="secondary"
                        d="M12 21a2 2 0 0 1-1.41-.59l-.83-.82A2 2 0 0 0 8.34 19H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4a5 5 0 0 1 4 2v16z" />
                    <path class="primary"
                        d="M12 21V5a5 5 0 0 1 4-2h4a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1h-4.34a2 2 0 0 0-1.42.59l-.83.82A2 2 0 0 1 12 21z" />
                </g>
            </svg>
        </div>
    </div>
    @else
    <livewire:found-results />
    @endif
</div>