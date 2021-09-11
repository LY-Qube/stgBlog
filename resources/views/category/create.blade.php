<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new category') }}
        </h2>
    </x-slot>

    <!-- component -->
    <form method="POST" action="{{ route('category.store') }}" class="shadow rounded-lg p-6">
        @csrf
        <div class="grid lg:grid-cols-2 gap-6">
            <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                    <p>
                        <label for="name" class="bg-white text-gray-600 px-1">Category *</label>
                    </p>
                </div>
                <p>
                    <input id="name" name="name"
                           value="{{ old('name') }}"
                           autocomplete="false" tabindex="0" type="text"
                           class="py-1 px-1 text-gray-900 outline-none block h-full w-full">
                </p>
            </div>
            @error('name')
            <div class="flex items-center bg-red-400 opacity-1 text-white text-sm font-bold px-4 py-3" role="alert">
                <p>{{ $message }}</p>
            </div>
            @enderror
        </div>
        <div class="border-t mt-6 pt-3">
            <button class="rounded text-gray-100 px-3 py-1 bg-blue-500 hover:shadow-inner hover:bg-blue-700 transition-all duration-300">
                Save
            </button>
        </div>
    </form>

</x-app-layout>