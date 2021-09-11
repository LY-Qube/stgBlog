@if(session('error'))
    <div class="fixed left-1 bottom-1 flex items-center bg-red-400 opacity-1 text-black text-sm font-bold px-4 py-3"
         role="alert">
        <p>{{ session('error') }}</p>
    </div>
@endif