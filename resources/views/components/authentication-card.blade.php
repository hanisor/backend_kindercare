<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="p-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
    {{ $slot }} <!-- Default slot for the content -->
</div>

</div>
