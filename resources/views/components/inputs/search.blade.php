@props(['target' => "", 'inputAttr' => ''])

@php
    $target = !empty($target) ? "target=$target}" : '';
@endphp

<label {{$attributes->merge(['class' => 'input input-bordered flex items-center gap-2'])}}>
    <input {{$inputAttr}} type="search" class="grow" placeholder="Search"/>
    <x-lucide-search class="w-4 h-4 opacity-70"/>
</label>

