<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Layanan') }}
        </h2>
        <div class="flex justify-end text-gray-500">
            <!-- not working, kita akan ganti dengan breadcrumb sajalah -->
             layanan / index
        </div>
    </div>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 py-6 bg-white shadow-md rounded-lg">
        @foreach($jenisLayanans as $jenisLayananParent)
            <div class="flex justify-between mb-6">
                <h2 class="text-lg font-semibold">{{ $jenisLayananParent->nama_jenis_layanan }}</h2>
            </div>
            <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-200">
            @if($jenisLayananParent->children->isEmpty())
                <p class="text-gray-500">Tidak ada sub jenis layanan.</p>
            @else
                <div class="grid grid-cols-3 gap-4">
                @foreach($jenisLayananParent->children as $jenisLayanan)
                    <a href="{{ route('layanans.by-jenis', ['id'=>$jenisLayanan->id]) }}" class="mb-4 p-4 bg-gray-200 rounded-lg">
                        <h3 class="text-md font-semibold">{{ $jenisLayanan->nama_jenis_layanan }}</h3>
                        <p class="text-sm text-gray-600">Parent ID: {{ $jenisLayanan->parent_id }}</p>
                    </a>
                @endforeach
                </div>
            @endif
        @endforeach
    </div>
</div>