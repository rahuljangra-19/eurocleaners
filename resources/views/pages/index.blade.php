@php
use Illuminate\Support\Str;
@endphp
@push('meta-description'){{ $page->meta_description }}@endpush
@push('meta-keywords'){{ $page->meta_title }}@endpush
@section('title', '| ' . $page->title)
<x-app-layout>
    <x-slot name="topbar">
        <x-top-bar :page="$page"></x-top-bar>
    </x-slot>

    @isset($page->components)
    @foreach ($page->components as $component)
    @php
    $componentName = Str::kebab($component['layout']); // Ensure the component name is in kebab-case
    $componentData = $component; // Pass the entire component as data
    @endphp
    <x-dynamic-component :component="$componentName" :data="$componentData" :date="$page->created_at" :title="$page->title" :id="$page->id"></x-dynamic-component>
    @endforeach
    @endisset
</x-app-layout>
