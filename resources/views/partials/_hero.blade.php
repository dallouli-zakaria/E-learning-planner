<section class="relative h-72 bg-blue-800 flex flex-col justify-center align-center text-center space-y-4 mb-4">
  <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
    style="background-image: url('images/laravel-logo.png')"></div>

  <div class="z-10">
    <h1 class="text-6xl font-bold uppercase text-white">
      <span class="text-white">I<span class="text-red-500">S</span>GA</span>
    </h1>
    <p class="text-2xl text-gray-200 font-bold my-4">
        find sessions to join
    </p>
    @auth
        <a href="/sessions"
        class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">Sessions</a>
    @endauth


</section>

<div class="relative h-72 bg-blue-800 flex flex-col justify-center align-center text-center space-y-4 mb-4">
    @auth
      @if (auth()->user()->role!="Admin")
          <p class="text-2xl text-gray-200 font-bold">You are currently a {{ auth()->user()->role }}</p>
          <form method="POST" action="/users/role" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="mb-6">
                  <label for="password2" class="inline-block text-lg text-2xl text-gray-200 font-bold ">
                    Role
                  </label>
                  <select id="role" name="role" class=" inline-block border-2 border-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black block text-center rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                      <option value="Etudiant" @selected(auth()->user()->role=="Etudiant")>Etudiant</option>
                      <option value="Professor" @selected(auth()->user()->role=="Professor")>Professor</option>
                  </select>

                  @error('password_confirmation')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                  @enderror
                </div>

              <div class="mb-6">
              <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                  Update Role
              </button>
              </div>
          </form>
      @endif
    @else
    <a href="/login"
      class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">Login</a>
    @endauth

</div>
  </div>
