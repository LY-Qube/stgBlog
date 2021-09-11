<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 pr-10 lg:px-8">
        <!-- create component -->
        <div class="align-middle rounded-tl-lg rounded-tr-lg inline-block w-full py-4 px-12 overflow-hidden bg-white shadow-lg">
            <a href="{{ route('category.create') }}"
               class="px-5 py-2 m-1 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                Create
            </a>
        </div>
        <!-- list of categories -->
        <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg">
            <table class="min-w-full">
                <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                        #
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                        Category
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                        Number of posts
                    </th>
                    <th colspan="3"
                        class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider text-right">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @foreach($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm leading-5 text-gray-800">#{{ $loop->index + 1 }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="text-sm leading-5 text-blue-900">{{ $category->name }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                            <span aria-hidden
                                  class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                            <span class="relative text-xs">{{ $category->posts_count }}</span>
                        </span>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                            <a href="{{ route('category.show', compact('category')) }}" class="px-5 py-2 m-1 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                Show
                            </a>
                            <a href="{{ route('category.edit', compact('category')) }}"
                               class="px-5 py-2 m-1 border-yellow-500 border text-yellow-500 rounded transition duration-300 hover:bg-yellow-700 hover:text-white focus:outline-none">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('category.destroy',compact('category')) }}" class="inline px-5 py-2 m-1 border-pink-500 border text-pink-500 rounded transition duration-300 hover:bg-pink-700 hover:text-white focus:outline-none">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-flash-session></x-flash-session>

</x-app-layout>