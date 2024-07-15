<nav class="py-4 bg-black">
    <ul class="flex-grow gap-x-4 justify-center items-center hidden md:flex">
        <li class="justify-self-start text-white">Tracker</li>
        <li>
            <a
                @class([
                    "link link-secondary",
                    "font-bold" => request()->routeIs('home'),
                ])
                href="{{route('home')}}"
            >
                Home
            </a>
        </li>
        <li>
            <a
                @class([
                    "link link-secondary",
                    "font-bold" => request()->routeIs('categories'),
                ])
                href="{{route('categories')}}"
            >
                Categories
            </a>
        </li>
        <li>
            <a
                @class([
                    "link link-secondary",
                    "font-bold" => request()->routeIs('links'),
                ])
                href="{{route('links')}}"
            >
                Links
            </a>
        </li>
    </ul>

    <ul x-data="{show:false}" x-cloak class="flex justify-between items-center px-2 text-white md:hidden">
        <li>
            <div x-show="!show" x-transition>
                <x-lucide-align-justify  @click="show=!show" class="h-4 w-4"/>
            </div>
            <div x-show="show" x-transition>
                <x-lucide-align-justify x-show="show" @click="show=!show" class="h-4 w-4 rotate-90"/>
            </div>

            <div x-show="show" x-transition class="flex flex-col gap-y-1 mt-2">
                <a
                    @class([
                        "link link-secondary",
                        "font-bold" => request()->routeIs('home'),
                    ])
                    href="{{route('home')}}"
                >
                    Home
                </a>
                <a
                    @class([
                        "link link-secondary",
                        "font-bold" => request()->routeIs('categories'),
                    ])
                    href="{{route('categories')}}"
                >
                    Categories
                </a>
                <a
                    @class([
                        "link link-secondary",
                        "font-bold" => request()->routeIs('links'),
                    ])
                    href="{{route('links')}}"
                >
                    Links
                </a>
            </div>
        </li>
        <li><a href="{{route('home')}}" class="justify-self-start text-white cursor-pointer">Tracker</a></li>
    </ul>
</nav>
