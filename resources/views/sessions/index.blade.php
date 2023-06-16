<x-layout>
  @if (!Auth::check())
    @include('partials._hero')
  @endif

  @include('partials._search')

  @if(auth()->user()->role=="Professor")
    <div class="w-1/4 m-auto my-5">
        <a href="/sessions/create"
            class="block p-10 w-50 bg-black text-white py-2 rounded-xl hover:opacity-80">
            Add Session</a>
    </div>
  @endif
  <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
    @if(count($sessions) != 0)
        @foreach($sessions as $val)
            <x-listing-card :val="$val" />
        @endforeach
    @else
        <p>No sessions found</p>
    @endif
  </div>

</x-layout>
