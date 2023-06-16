<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Edit matier</h2>
      <p class="mb-4">Edit: {{$matier->title}}</p>
    </header>

    <form method="POST" action="/matiers/{{$matier->id}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-6">
        <label for="title" class="inline-block text-lg mb-2">Title</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title" value="{{$matier->title}}" />

        @error('title')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Update matier
        </button>

        <a href="/matiers" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </x-card>
</x-layout>
