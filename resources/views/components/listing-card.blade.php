@props(['val'])

<x-card>
    <div class="flex">
        <img class="hidden w-48 mr-6 md:block"
        src="{{$val->img ? asset('storage/' . $val->img) : asset('/images/no-image.png')}}" alt="" />
        <div>
        <h3 class="text-2xl">
            <a href="/sessions/{{$val->id}}">{{$val->title}}</a>
        </h3>
        <div class="text-xl font-bold mb-4">by {{$val->prof->name}}</div>
        <ul class="flex">
            <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                <a href="?tag={{$val->matier->title}}">{{$val->matier->title}}</a>
            </li>
        </ul>
        <div class="text-lg mt-4">
            <i class="fa-solid fa-calendar-days"></i> {{$val->date}}
        </div>
        </div>
    </div>
</x-card>
