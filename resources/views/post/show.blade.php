<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List posts
        </h2>
    </x-slot>

    <div class="mx-5 sm:mx-6">

        <!--Nav-->
        <div class="p-12 w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t">
            <div class="w-full h-auto flex flex-wrap justify-content-between align-items-center">
                <div class="w-full lg:w-3/6">
                    @can('approve',\App\Models\Post::class)
                        @if(is_null($post->approve_at))
                            <button
                                    class="px-5 py-2 m-1 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                Approve
                            </button>
                        @endif
                    @endcan
                </div>

                <div class="w-full lg:w-3/6 mt-5 lg:mt-0 text-right">
                    @can('update',$post)
                        <a href="{{ route('post.edit' ,compact('post'))}}"
                           class="px-5 py-2 m-1 border-yellow-500 border text-yellow-500 rounded transition duration-300 hover:bg-yellow-700 hover:text-white focus:outline-none">
                            Edit
                        </a>
                    @endcan
                    @can('delete',$post)
                        <form method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class=" px-5 py-2 m-1 border-pink-500 border text-pink-500 rounded transition duration-300 hover:bg-pink-700 hover:text-white focus:outline-none">
                                @if(is_null($post->deleted_at))
                                    Delete
                                @else
                                    Force Delete
                                @endif
                            </button>
                        </form>
                    @endcan
                </div>

            </div>

        </div>


    </div>

    <!--Title-->
    <div class="text-center pt-16 md:pt-32">
        <p class="text-sm md:text-base text-green-500 font-bold">
            {{ \Carbon\Carbon::parse($post->created_at)->format('d M y') }}
            <span class="text-gray-900">/</span> {{ $post->category->name }}
        </p>
        <h1 class="font-bold break-normal text-3xl md:text-5xl">{{ $post->title }}</h1>
    </div>

    <!--image-->
    <div class="container w-full max-w-6xl mx-auto bg-white bg-cover mt-8 rounded"
         style="background-image:url('{{ asset("storage/{$post->image}") }}'); height: 75vh;"></div>

    <!--Container-->
    <div class="container max-w-5xl mx-auto -mt-32">

        <div class="mx-0 sm:mx-6">

            <div class="bg-white w-full p-8 md:p-24 text-xl md:text-2xl text-gray-800 leading-normal"
                 style="font-family:Georgia,serif;">

                <!--Post Content-->


            {{ $post->body }}

            <!--/ Post Content-->

            </div>


            <!--Author-->
            <div class="flex w-full items-center font-sans p-8 md:p-24">
                <div class="flex-1">
                    <p class="text-base font-bold text-base md:text-xl leading-none">{{ $post->creator->username }}</p>
                </div>
                <div class="justify-end">
                    <a href="{{ route('publisher.show',['user' => $post->creator]) }}"
                       class="bg-transparent border border-gray-500 hover:border-green-500 text-xs text-gray-500 hover:text-green-500 font-bold py-2 px-4 rounded-full">Read
                        More posts</a>
                </div>
            </div>
            <!--/Author-->

        </div>


    </div>


    <div class="bg-gray-200">

        <div class="container w-full max-w-6xl mx-auto px-2 py-8">
            <div class="flex flex-wrap -mx-2">
                @foreach($posts as $post)
                    <x-card-post :post="$post"></x-card-post>
                @endforeach
            </div>

        </div>

    </div>


</x-app-layout>