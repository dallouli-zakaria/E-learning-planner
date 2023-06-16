<x-layout>
    @if (!Auth::check())
      @include('partials._hero')
    @endif

    @include('partials._search')

    @if(auth()->user()->role=="Admin")
      <div class="w-1/4 m-auto my-5">
          <a href="/register"
              class="block p-10 w-50 bg-black text-white py-2 rounded-xl hover:opacity-80">
              Add User</a>
      </div>
    @endif
    <div class="mx-10">

        @if(count($users) != 0)

        <x-table :data="$users" />

        @else
        <p>No users found</p>
        @endif
    </div>

  </x-layout>
