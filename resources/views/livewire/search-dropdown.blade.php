<div class="relative mt-3 md:mt-0" style="z-index:100; position: fixed;position:relative; left:-10%;"
    x-data="{ isOpen: true }" @click.away="isOpen = false">
    <input wire:model.live.debounce.500ms="search" wire:keydown.enter="openNav()" type="text"
        class="bg-orange-800 text-sm rounded-full w-64 px-4 pl-8 py-1 
    focus:outline-none focus:shadow-outline text-white placeholder-white"
        placeholder="Search" wire:keydown.enter="passDataToController($event.target.value)" @focus = "isOpen = true"
        @keydown.escape.window="isOpen = false" @keydown.shift.tab="isOpen = false" @keydown="isOpen = true">
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-white mt-2 ml-2" viewBox="0 0 24 24">
            <path class="heroicon-ui"
                d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
        </svg>
    </div>
    <div wire:loading
        class="inline-block h-6 w-6 animate-spin rounded-full border-4 border-solid border-current border-e-transparent align-[-0.125em] text-primary motion-reduce:animate-[spin_1.5s_linear_infinite]"
        role="status" style="position: absolute;left:90%;top:10%">
        <span
            class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
    </div>
    @if (strlen($search) >= 2)
        <div class="absolute bg-orange-800 text-sm rounded w-64 mt-4" x-show.transition.opacity="isOpen">
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        @if (strlen($result['media_type']) >= 6)
                            <li class="border-b border-white">
                                <a href="#" class="hover:bg-white hover:text-red-800 p-2 rounded px-3 py-3 flex items-center">
                                    @if ($result['profile_path'] != 'null')
                                        <img src="https://image.tmdb.org/t/p/w500/{{ $result['profile_path'] }}"
                                            alt="actor poster"
                                            class="hover:opacity-80 transition ease-in-out duration-50 w-10">
                                        <span class="ml-4"> {{ $result['name'] }}</span>
                                </a>
                            @else
                                <img src="https://via.placeholder.com/40x60" alt="movie poster"
                                    class="hover:opacity-80 transition ease-in-out duration-50 w-10">
                        @endif
                        </li>
                    @elseif(strlen($result['media_type']) <= 2)
                        <li class="border-b border-white">
                            <a href="{{ route('tv.show', $result['id']) }}"
                                class="hover:bg-white hover:text-red-800 p-2 rounded px-3 py-3 flex items-center">
                                @if ($result['poster_path'] != 'null')
                                    <img src="https://image.tmdb.org/t/p/w500/{{ $result['poster_path'] }}"
                                        alt="tv poster" class="hover:opacity-80 transition ease-in-out duration-50 w-10"
                                        @if ($loop->last) @keydown.tab="isOpen = false" @endif>
                                    <span class="ml-4"> {{ $result['name'] }}</span>
                            </a>
                        @else
                            <img src="https://via.placeholder.com/40x60" alt="movie poster"
                                class="hover:opacity-80 transition ease-in-out duration-50 w-10">
                    @endif
                    </li>
                @else
                    <li class="border-b border-white">
                        <a href="{{ route('movies.show', $result['id']) }}"
                            class="hover:bg-white hover:text-red-800 p-2 rounded px-3 py-3 flex items-center">
                            @if ($result['poster_path'] != 'null')
                                <img src="https://image.tmdb.org/t/p/w500/{{ $result['poster_path'] }}" alt="tv poster"
                                    class="hover:opacity-80 transition ease-in-out duration-50 w-10"
                                    @if ($loop->last) @keydown.tab="isOpen = false" @endif>
                                <span class="ml-4"> {{ $result['title'] }}</span>
                        </a>
                    @else
                        <img src="https://via.placeholder.com/40x60" alt="movie poster"
                            class="hover:opacity-80 transition ease-in-out duration-50 w-10">
            @endif
            </li>
    @endif
    @endforeach
    </ul>
@else
    <div class="px-3 py-3">NO RESULT for "{{ $search }}"</div>
    @endif
</div>
@endif
</div>
