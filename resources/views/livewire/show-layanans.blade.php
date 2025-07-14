<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
        <div class="flex justify-end text-gray-500">
            <!-- not working, kita akan ganti dengan breadcrumb sajalah -->
             test / test / test
        </div>
    </div>
</x-slot>

<div class="py-6">
    @if($showForm)
                <button type="button" wire:click="formTambahData" class="flex justify-between px-3 py-2 text-sm font-medium text-center text-white bg-red-500 rounded hover:bg-red-700 mx-1">
                    <x-heroicon-o-x-mark class="w-5 h-5 text-white me-2"/>Batal
                </button>
                <button type="button" wire:click="formTambahData" class="flex justify-between px-3 py-2 text-sm font-medium text-center text-white bg-sky-500 rounded hover:bg-sky-700 mx-1">
                    <x-antdesign-save-o class="w-5 h-5 text-white me-2"/>Simpan
                </button>
            @else
                <button type="button" wire:click="formTambahData" class="flex justify-between px-3 py-2 text-sm font-medium text-center text-white bg-sky-500 rounded hover:bg-sky-700 mx-1">
                    <x-heroicon-s-plus class="w-5 h-5 text-white me-2"/>Tambah
                </button>
            @endif
            <button type="button" class="btn-click flex justify-between px-3 py-2 text-sm font-medium text-center text-white bg-sky-500 rounded hover:bg-sky-700 mx-1">
                <x-heroicon-s-plus class="w-5 h-5 text-white me-2"/>Click
            </button>
    {{ $number }} {{ $testText }}
    <button wire:click="up" class="bg-blue-500 text-white px-4 py-2 rounded">Increment</button>
    <button wire:click="down" class="bg-red-500 text-white px-4 py-2 rounded">Decrement</button>
    
    @if($showForm)
        <form wire:submit.prevent="store" class="mb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nikWarga" class="block text-sm font-medium text-gray-700">nikWarga</label>
                    <input type="text" id="nikWarga" wire:model="nikWarga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('nikWarga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="namaWarga" class="block text-sm font-medium text-gray-700">namaWarga</label>
                    <input type="text" id="namaWarga" wire:model="namaWarga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('namaWarga') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="alamatDomisili" class="block text-sm font-medium text-gray-700">alamatDomisili</label>
                    <input type="text" id="alamatDomisili" wire:model="alamatDomisili" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('alamatDomisili') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="lingkunganDomisili" class="block text-sm font-medium text-gray-700">lingkunganDomisili</label>
                    <input type="text" id="lingkunganDomisili" wire:model="lingkunganDomisili" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('lingkunganDomisili') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-4 flex justify-end space-x-2">
                <button class="bg-sky-500 hover:bg-sky-700 px-4 py-2 rounded">Save changes</button>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded">
                    {{ $isEditing ? 'Update' : 'Create' }}
                </button>
                @if ($isEditing)
                    <button type="button" wire:click="resetForm"
                        class="bg-gray-500 text-white px-4 py-2 rounded">
                        Cancel
                    </button>
                @endif
            </div>
        </form>
    @else
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto px-4 py-8">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b text-left" style="width:10px">No</th>
                                <th class="px-4 py-2 border-b text-left" style="width:35%">NIK</th>
                                <th class="px-4 py-2 border-b text-left" style="width:35%">Nama</th>
                                <th class="px-4 py-2 border-b text-left" style="width:20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($layanans as $index => $layanan)
                                <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                                    <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border-b">{{ $layanan->nik_warga }}</td>
                                    <td class="px-4 py-2 border-b">{{ $layanan->nama_warga }}</td>
                                    <td class="px-4 py-2 border-b">
                                        <div class="inline-flex rounded-md shadow-xs" role="group">
                                            <button wire:click="edit({{ $layanan->id }})" type="button" class="flex px-4 py-2 text-sm font-medium bg-violet-500 text-white px-3 py-1 rounded hover:bg-violet-600 me-2">
                                                <x-heroicon-o-wrench class="w-4 h-4 text-white me-2"/>
                                                Edit
                                            </button>
                                            <button wire:click="delete({{ $layanan->id }})" type="button" class="flex px-4 py-2 text-sm font-medium bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                <x-monoicon-delete class="w-4 h-4 text-white me-2"/>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $layanans->links() }}
                </div>
            </div>
        </div>
    @endif
</div>

@script
<script>
    document.querySelector(".btn-click").addEventListener('click', function(){
        $wire.dispatch('tambah-data');
    })
    

    
</script>
@endscript
