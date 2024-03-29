<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Edit Session</h2>
      <p class="mb-4">Edit: {{$session->title}}</p>
    </header>

    <form method="POST" action="/sessions/{{$session->id}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
        
      <div class="mb-6">
        <label for="title" class="inline-block text-lg mb-2">Title</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
          placeholder="Example: Senior Laravel Developer" value="{{$session->title}}" />

        @error('title')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>



      <div class="mb-6">
        <label for="description" class="inline-block text-lg mb-2">
          Description
        </label>
        <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
          placeholder="Include tasks, requirements, salary, etc">{{$session->description}}</textarea>

        @error('description')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="room" class="inline-block text-lg mb-2">Room</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="room"
          placeholder="Example: Remote, Boston MA, etc" value="{{$session->room}}" />

        @error('room')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="date" class="inline-block text-lg mb-2">Date</label>
        <input type="datetime-local" class="border border-gray-200 rounded p-2 w-full" name="date"  value="{{ $session->date }}" />

        @error('date')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="matier_id" class="inline-block text-lg mb-2">
            Matier
          </label>
          <select id="matier_id" name="matier_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
              @foreach ($matiers as $val)
                  <option value="{{ $val->id }}" selected="{{ $val->id==$session->matier->id ? true : false }}">{{ $val->title }}</option>
              @endforeach
          </select>

          @error('password_confirmation')
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
      </div>

      <div class="mb-6">
        <label for="logo" class="inline-block text-lg mb-2">
          Company Logo
        </label>
        <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

        <img class="w-48 mr-6 mb-6"
          src="{{$session->img ? asset('storage/' . $session->img) : asset('/images/no-image.png')}}" alt="" />

        @error('logo')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Update
        </button>

        <a href="/" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </x-card>
</x-layout>
