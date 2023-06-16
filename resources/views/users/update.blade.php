<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Update User</h2>
      <p class="mb-4">{{ $user->name }}</p>
    </header>

    <form method="POST" action="/users/{{ $user->id }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-6">
        <label for="name" class="inline-block text-lg mb-2"> Name </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{$user->name}}" />

        @error('name')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2">Email</label>
        <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{$user->email}}" />

        @error('email')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="password2" class="inline-block text-lg mb-2">
          Role
        </label>
        <select id="role" name="role" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
            <option value="Etudiant" @selected($user->role=="Etudiant")>Etudiant</option>
            <option value="Professor" @selected($user->role=="Professor")>Professor</option>
        </select>

        @error('password_confirmation')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="niveau_id" class="inline-block text-lg mb-2">
          Niveau
        </label>
        <select id="niveau_id" name="niveau_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
            @foreach ($niveaux as $val)
                <option value="{{ $val->id }}" @checked($user->niveau->id==$val->id)>{{ $val->title }}</option>
            @endforeach
        </select>

        @error('password_confirmation')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>


      <div class="mb-6">
        <label for="logo" class="inline-block text-lg mb-2">
          User Avatar
        </label>
        <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

        <img class="w-48 mr-6 mb-6"
          src="{{$user->avatar ? asset('storage/' . $user->avatar) : asset('/images/no-image.png')}}" alt="" />

        @error('logo')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button type="submit" class="bg-blue-900 w-full text-white rounded py-2 px-4 hover:bg-black">
          Update
        </button>
      </div>

      {{-- <div class="mt-8">
        <p>
          Already have an account?
          <a href="/login" class="text-blue-900">Login</a>
        </p>
      </div> --}}
    </form>
  </x-card>
</x-layout>
