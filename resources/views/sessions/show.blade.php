<x-layout>
  <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
  </a>
  <div class="mx-4">
    <x-card class="p-10">
      <div class="flex flex-col items-center justify-center text-center">
        <img class="w-48 mr-6 mb-6"
          src="{{$val->img ? asset('storage/' . $val->img) : asset('/images/no-image.png')}}" alt="" />

        <h3 class="text-2xl mb-2">
          {{$val->title}}
        </h3>
        <div class="text-xl font-bold mb-4">{{$val->company}}</div>

        <ul class="flex">
            <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                <a href="?tag={{$val->matier->title}}">{{$val->matier->title}}</a>
            </li>
          </ul>

        <div class="text-lg mt-4">
            <i class="fa-solid fa-user-tie"></i> {{$val->prof->name}}
        </div>
        <div class="text-lg">
            <i class="fa-solid fa-calendar-days"></i> {{$val->date}}
        </div>
        <div class="text-lg">
            <i class="fa-sharp fa-solid fa-door-closed"></i> {{$val->room}}
        </div>
        <div class="border border-gray-200 w-full my-6"></div>
        <div>
          <h3 class="text-3xl font-bold mb-4">Session Description</h3>
          <div class="text-lg space-y-6">
            {{$val->description}}

            <a href="mailto:{{$val->prof->email}}"
              class="block bg-blue-800 text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                class="fa-solid fa-envelope"></i>
              Contact Proffesor</a>

            @if(auth()->user()->id==$val->prof->id)
                <a href="/sessions/{{ $val->id }}/edit"
                class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i class="fa-solid fa-pen-to-square"></i>
                edit</a>
            @endif
            <?php $flag = false ?>
            @if ($val->prof->id==auth()->user()->id || auth()->user()->role=="Professor")
                <?php $flag = true ?>
            @else
                @foreach ($val->students as $user)
                    @if ($user->user->id == auth()->user()->id)
                        <?php $flag = true ?>
                    @endif
                @endforeach
            @endif

            @if (isset($flag) && $flag==false)
                <a href="/sessions/{{ $val->id }}/subscribe"
                class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i class="fa-solid fa-globe"></i>
                Subscribe</a>
            @endif
          </div>
        </div>
        <div class="border border-gray-200 w-full mt-6"></div>
        <div>
            <x-tableUser :data="$val->students" />
        </div>
        </div>
      </div>
    </x-card>

    {{-- <x-card class="mt-4 p-2 flex space-x-6">
      <a href="/listings/{{$listing->id}}/edit">
        <i class="fa-solid fa-pencil"></i> Edit
      </a>

      <form method="POST" action="/listings/{{$listing->id}}">
        @csrf
        @method('DELETE')
        <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
      </form>
    </x-card> --}}
  </div>
</x-layout>
