@props(['question', 'id', 'description'])
<div class="text-blueGray-700">
    <div class="xcontainer items-center px-5 py-4 lg:px-20">
        <div class="flex flex-col w-full px-6 py-3 mx-auto transition duration-500 ease-in-out transform bg-white border rounded-lg lg:w-2/6 md:w-1/2 md:mt-0">
            <div class="relative">
               {{ $slot }}
            </div>
        </div>
    </div>
</div>
