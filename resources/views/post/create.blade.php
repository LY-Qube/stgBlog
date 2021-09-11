<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new post') }}
        </h2>
    </x-slot>

    <!-- component -->
    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data" class="shadow rounded-lg p-6">
        @csrf
        <div class="w-full lg:flex">
            <div class="w-full lg:w-3/6 px-2">
                <!-- title -->
                <div class="w-full">
                    <p>
                        <label for="title">Title *</label>
                    </p>
                    <p>
                        <input type="text"
                               id="title"
                               name="title"
                               placeholder="Title *"
                               value="{{ old('title') }}"
                               class="w-full h-10 rounded">
                    </p>
                    @error('title')
                    <p class="text-pink-400">{{ $message }}</p>
                    @enderror

                </div>
                <!-- body -->
                <div class="w-full">
                    <p>
                        <label for="body">Body *</label>
                    </p>
                    <p>
                        <textarea id="body"
                                  name="body"
                                  placeholder="Body *"
                                  class="w-full h-96 rounded">{{ old('body') }}</textarea>
                    </p>
                    @error('body')
                    <p class="text-pink-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="w-full lg:w-3/6 px-2 lg:mt-0 mt-5">
                <!-- category -->
                <div class="w-full">
                    <p>
                        <label for="category">Category *</label>
                    </p>
                    <p>
                        <select name="category"
                                id="category"
                                class="w-full h-10 rounded">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </p>
                    @error('category')
                    <p class="text-pink-400">{{ $message }}</p>
                    @enderror

                </div>
                <!-- published -->
                <div class="w-full">
                    <p>
                        <label for="published">Published *</label>
                    </p>
                    <p>
                        <select name="published"
                                id="published"
                                class="w-full h-10 rounded">
                                <option value="0">Unpublished</option>
                                <option value="1">Published</option>
                        </select>
                    </p>
                    @error('published')
                    <p class="text-pink-400">{{ $message }}</p>
                    @enderror
                </div>
                <!-- image -->
                <div class="w-full">
                    <p>
                        <label for="title">Image *</label>
                    </p>
                    <p>
                        <input type="file"
                               id="image"
                               name="image_"
                               accept="image/*"
                               class="w-full h-10 rounded border-2 shadow-lg">
                    </p>
                    @error('image')
                    <p class="text-pink-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="border-t mt-6 pt-3">
            <button class="rounded text-gray-100 px-3 py-1 bg-blue-500 hover:shadow-inner hover:bg-blue-700 transition-all duration-300">
                Save
            </button>
        </div>
    </form>

</x-app-layout>