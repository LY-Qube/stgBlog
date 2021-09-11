<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List posts
        </h2>
    </x-slot>

    <div class="mx-0 mt-12">

        <div class="mx-5 sm:mx-6">

            <!--Nav-->
            <div class="p-12 w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t">
                <div class="w-full h-auto flex flex-wrap justify-content-between align-items-center">

                    <div class="w-full lg:w-3/6">
                        @can('create', \App\Models\Post::class)
                            <a href="{{ route('post.create') }}"
                               class="px-5 py-2 m-1 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                Create
                            </a>
                        @endcan
                    </div>
                    <div class="w-full lg:w-3/6 mt-5 lg:mt-0 text-right">
                        @if(!isset($order) || !$order || $order === "asc")
                            <a href="{{ route('post.index',[
                            'published' => (!isset($published)) ?? $published,
                            'order'     => "desc"
                        ]) }}"
                               class="px-5 py-2 m-1 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                Old posts
                            </a>
                        @else
                            <a href="{{ route('post.index',[
                            'published' => (!isset($published)) ?? $published,
                            'order'     => "asc"
                        ]) }}"
                               class="px-5 py-2 m-1 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                New posts
                            </a>
                        @endif
                        @if(!$published || !isset($published))
                            <a href="{{ route('post.index',[
                            'published' => true,
                            'order'     => (!isset($order) || !$order) ? 'asc' : $order
                        ]) }}"
                               class="px-5 py-2 m-1 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                Unpublished
                            </a>
                        @else
                            <a href="{{ route('post.index',[
                            'published' => false,
                            'order'     => (!isset($order) || !$order) ? 'asc' : $order
                        ]) }}"
                               class="px-5 py-2 m-1 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                Published
                            </a>
                        @endif
                    </div>

                </div>


                <!--Posts Container-->
                <div class="container w-full max-w-6xl mx-auto px-2 py-8">
                    <div class="flex flex-wrap -mx-2">
                        @foreach($posts as $post)
                            <x-card-post :post="$post"></x-card-post>
                        @endforeach
                    </div>
                </div>
                <!-- paginate -->
                <p class="mb-12">
                    {{ $posts->links('vendor.pagination.tailwind') }}
                </p>

            </div>

        </div>

    </div>

    <x-flash-session></x-flash-session>

</x-app-layout>