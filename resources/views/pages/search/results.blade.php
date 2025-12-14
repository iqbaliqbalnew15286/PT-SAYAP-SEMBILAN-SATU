@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
@php
    $rbmDark = '#161f36'; // Deep Indigo Navy
    $rbmAccent = '#FF7518'; // Bright Orange
@endphp
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6" style="color: {{ $rbmDark }};">Search Results for "{{ $query }}"</h1>

    @if($products->count() > 0 || $services->count() > 0)
        {{-- Products Section --}}
        @if($products->count() > 0)
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4" style="color: {{ $rbmDark }};">Products</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-200">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2" style="color: {{ $rbmDark }};">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit(strip_tags($product->description), 100) }}</p>
                                <a href="{{ route('product.show', $product->slug ?? $product->id) }}" class="font-medium hover:underline" style="color: {{ $rbmAccent }};">View Details →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Services Section --}}
        @if($services->count() > 0)
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4" style="color: {{ $rbmDark }};">Services</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($services as $service)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-200">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2" style="color: {{ $rbmDark }};">{{ $service->name }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit(strip_tags($service->description), 100) }}</p>
                                <a href="{{ route('service.show', $service->slug ?? $service->id) }}" class="font-medium hover:underline" style="color: {{ $rbmAccent }};">View Details →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-search text-6xl"></i>
            </div>
            <h2 class="text-2xl font-semibold mb-2" style="color: {{ $rbmDark }};">No results found</h2>
            <p class="text-gray-600">Try adjusting your search terms or browse our products and services.</p>
            <div class="mt-6">
                <a href="{{ route('products') }}" class="text-white px-6 py-2 rounded-lg hover:opacity-90 transition-colors mr-4" style="background-color: {{ $rbmDark }};">Browse Products</a>
                <a href="{{ route('services') }}" class="text-white px-6 py-2 rounded-lg hover:opacity-90 transition-colors" style="background-color: {{ $rbmAccent }};">Browse Services</a>
            </div>
        </div>
    @endif
</div>
@endsection
