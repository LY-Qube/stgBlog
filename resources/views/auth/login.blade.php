<x-guest-layout>

    <div class="w-full flex flex-wrap">

        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col">

            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl">Welcome.</p>
                <form action="{{ route('login') }}" method="POST"
                      class="flex flex-col pt-3 md:pt-8" >
                    @csrf
                    <div class="flex flex-col pt-4">
                        <label for="username" class="text-lg">Username :</label>
                        <input type="text"
                               name="username"
                               id="username"
                               placeholder="Username"
                               value="{{ old('username') }}"
                               class="@error('username') border-red-100 @enderror shadow appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    @error('username')
                    <span class="text-red-400">{{ $message }}</span>
                    @enderror

                    <div class="flex flex-col pt-4">
                        <label for="password"
                               class="text-lg">Password</label>
                        <input type="password"
                               name="password"
                               id="password"
                               placeholder="Password"
                               class="@error('password') border-red-100 @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    @error('password')
                    <span class="text-red-400">{{ $message }}</span>
                    @enderror

                    <input type="submit" value="Log In" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">
                </form>
            </div>
            <x-flash-session></x-flash-session>
        </div>

        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="{{ asset('images/background_login.png') }}">
        </div>

    </div>
</x-guest-layout>
