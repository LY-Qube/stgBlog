<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            post of  {{ $user->username }}
        </h2>
    </x-slot>

    <div class="mx-0 mt-12">

        <div class="mx-5 sm:mx-6">

            <!--Nav-->
            <div class="p-12 w-full text-xl md:text-2xl text-gray-800 leading-normal rounded-t">

                <h1>{{ $user->username }}</h1>
                <!--Posts Container-->
                <div class="flex flex-wrap justify-between pt-12 -mx-6">

                    @foreach($posts as $post)
                        <x-card-post :post="$post"></x-card-post>
                    @endforeach

                </div>
                <!--/ Post Content-->

            </div>

        </div>

    </div>

</x-app-layout>