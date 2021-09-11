<x-guest-layout
                 >
<div style="background-image: url('{{ asset("images/header.png") }}');"
     class="leading-normal tracking-normal text-indigo-400 bg-cover bg-fixed px-12">
    <!--Nav-->
    <div class="w-full container mx-auto">
        <div class="w-full flex items-center justify-between">
            <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
                STG<span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500">blog</span>
            </a>

            <div class="flex w-1/2 justify-end content-center">

                <a href="{{ route('login') }}"
                        class="bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out"
                >
                    Login
                </a>
            </div>
        </div>
    </div>

    <!--Main-->
    <div class="container pt-24 md:pt-36 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
            <h1 class="my-4 text-3xl md:text-5xl text-white opacity-75 font-bold leading-tight text-center md:text-left">
                Main
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500">
              Hero Message
            </span>
                to sell yourself!
            </h1>
            <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left">
                Sub-hero message, not too long and not too short. Make it just right!
            </p>

        </div>

        <!--Right Col-->
        <div class="w-full xl:w-3/5 p-12 overflow-hidden">
            <img class="mx-auto w-full md:w-4/5 transform -rotate-6 transition hover:scale-105 duration-700 ease-in-out hover:rotate-6"
                 src="{{ asset('images/macbook.svg') }}" />
        </div>

        <div class="mx-auto md:pt-16 ">
            <p class="text-blue-400 font-bold pb-8 lg:pb-6 text-center">
                Welcome
            </p>
        </div>

    </div>

</div>

</x-guest-layout>
