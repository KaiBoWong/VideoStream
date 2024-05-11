<div class="position-relative">
    <input wire:model.live.debounce.500ms="search" wire:keydown.enter="openNav()" type="text"
        class="form-control
        focus:outline-none focus:shadow-outline text-white placeholder-white"
        placeholder="Search" @focus="isOpen = true" @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false" @keydown="isOpen = true"
        style="background-color:#9A3412;font-size:0.875rem;line-height:1.25rem;border-radius:0.25rem;border-radius:9999px;width:16rem;width: 16rem; padding: 0.25rem 2rem; margin-left: 2rem;">
    <div class="position-absolute" style="left: 14%;top:-7%;">
        <svg class="mt-2 ml-2" viewBox="0 0 24 24" style="width: 1rem;">
            <path class="heroicon-ui" fill="white"
                d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
        </svg>
    </div>
    <div wire:loading class="spinner-border text-white" role="status"
        style="position: absolute;left:85%;top:10%;width:1.5rem;;height:1.5rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
    @if (strlen($search) >= 2)
        <div class="position-absolute" x-show.transition.opacity="isOpen"
            style="left:12%;background-color: #9A3412;z-index: 100 !important;font-size:0.875rem;line-height:1.25rem;border-radius:0.25rem;width:16rem;margin-top:1rem;">
            @if ($searchResults->count() > 0)
                <ul class="list-unstyled">
                    @foreach ($searchResults as $result)
                        @if (strlen($result['media_type']) >= 6)
                            <li class="border-bottom border-light">
                                <a href="#" class="px-3 py-3 d-flex align-items-center"
                                    style="display: flex; align-items: center; text-decoration: none; color: white;text-decoration: none;">
                                    @if ($result['profile_path'] != 'null')
                                        <img src="https://image.tmdb.org/t/p/w500/{{ $result['profile_path'] }}"
                                            alt="actor poster" style="width: 40px; height: 60px; margin-right: 10px;">
                                        <span class="ml-4"> {{ $result['name'] }}</span>
                                    @endif
                                </a>
                            </li>
                        @elseif(strlen($result['media_type']) <= 2)
                            <li class="border-bottom border-light">
                                <a href="{{ route('tv.show', $result['id']) }}" class="d-flex align-items-center px-3 py-3"
                                    style="display: flex; align-items: center; text-decoration: none; color: white;text-decoration: none;">
                                    @if ($result['poster_path'] != 'null')
                                        <img src="https://image.tmdb.org/t/p/w500/{{ $result['poster_path'] }}"
                                            alt="tv poster" style="width: 40px; height: 60px; margin-right: 10px;"
                                            @if ($loop->last) @keydown.tab="isOpen = false" @endif>
                                        <span class="ml-4"> {{ $result['name'] }}</span>
                                    @endif
                                </a>
                            </li>
                        @else
                            <li class="border-bottom border-light">
                                <a href="{{ route('movies.show', $result['id']) }}" class="d-flex align-items-center px-3 py-3"
                                    style="display: flex; align-items: center; text-decoration: none; color: white;text-decoration: none;">
                                    @if ($result['poster_path'] != 'null')
                                        <img src="https://image.tmdb.org/t/p/w500/{{ $result['poster_path'] }}"
                                            alt="tv poster" style="width: 40px; height: 60px; margin-right: 10px;"
                                            @if ($loop->last) @keydown.tab="isOpen = false" @endif>
                                        <span class="ml-4"> {{ $result['title'] }}</span>
                                    @endif
                                </a>
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
