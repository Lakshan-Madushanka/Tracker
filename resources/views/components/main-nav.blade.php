<nav class="py-4 bg-black">
    <ul class="flex flex-grow gap-x-4 justify-center items-center">
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
</nav>
