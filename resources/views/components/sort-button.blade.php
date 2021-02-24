<span x-data="{ direction: 'desc' }" class="flex space-x-1 cursor-pointer text-blueGray-300" x-on:click="$dispatch('sort-by', {criteria: 'name', direction: direction}); direction === 'asc' ? direction = 'desc' : direction = 'asc'">
    <img class="fill-current" src="{{ asset("images/chevron-down.svg") }}" alt="chevron">
    <h3>{{ ucfirst($criteria) }}</h3>
</span>