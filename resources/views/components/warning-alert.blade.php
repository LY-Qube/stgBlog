@if(session('warning'))
    <div class="fixed left-1 bottom-1 flex items-center bg-pink-400 opacity-1 text-white text-sm font-bold px-4 py-3"
         role="alert">
        <p>{{ session('warning') }}</p>
    </div>
@endif