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
        <li x-data>
            <span
                class="link link-secondary"
                @click="$dispatch('create-error')"
            >
                Create Error
            </span>
        </li>
        <li x-data>
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
    </ul>

    <ul class="flex justify-between px-2 text-white sm:hidden">
        <li x-data="{show:false}">
            <span @click="show=!show">list</span>
            <div x-show="show" x-transition class="flex flex-col gap-y-1">
                <a
                    @class([
                        "link link-secondary",
                        "font-bold" => request()->routeIs('home'),
                    ])
                    href="{{route('home')}}"
                >
                    Home
                </a>
                <span
                    class="link link-secondary"
                    @click="$dispatch('create-error')"
                >
                Create Error
            </span>
            </div>
        </li>
        <li class="justify-self-start text-white">Tracker</li>
    </ul>
</nav>
