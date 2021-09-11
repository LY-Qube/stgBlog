<div class="w-full lg:w-1/3 md:w-3/6 px-2 pb-12">
    <div class="h-full bg-white rounded overflow-hidden shadow-md hover:shadow-lg relative smooth">
        <a href="#" class="no-underline hover:no-underline">
            <img src="{{ asset("storage/{$post->image}") }}"
                 class="h-48 w-full rounded-t shadow-lg">
            <div class="p-6 h-auto md:h-48">
                <a href="{{ route('post.show', compact('post')) }}">
                    <p class="text-gray-600 text-xs md:text-sm">{{ $post->creator->username }}</p>
                    <p class="text-gray-600 text-xs md:text-sm">{{ $post->category->name }}</p>
                    <div class="font-bold text-xl text-gray-900">{{ $post->title }}</div>
                    <p class="text-gray-800 font-serif text-base mb-5">
                        {{ substr($post->body,0,50)  }}
                        <a href="{{ route('post.show',compact('post')) }}"
                           class="text-blue-500 text-sm">Plus...</a>
                    </p>
                </a>

            </div>
            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <p class="text-gray-600 text-xs md:text-sm">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </a>
    </div>
</div>