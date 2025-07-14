<!-- header slot -->
<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Layanan') }} : {{ $jenisLayanan->nama_jenis_layanan }}
        </h2>
        <div class="flex justify-end text-gray-500">
            <!-- not working, kita akan ganti dengan breadcrumb sajalah -->
             Layanan / {{ $jenisLayanan->nama_jenis_layanan }}
        </div>
    </div>
</x-slot>

<div class="py-6">
    <!-- confirmation -->
    <x-confirmation-modal wire:model="confirmingDeletion">
        <x-slot name="title">
            {{$alertTitle}}
        </x-slot>
        <x-slot name="content">
            {{$alertMessage}}
        </x-slot>   
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                Batal
            </x-secondary-button>
            <button class="ml-2 bg-red-500 py-2 px-4 rounded-md " wire:click="delete" wire:loading.attr="disabled">
                Confirm
            </button>
        </x-slot>
    </x-confirmation-modal>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 py-6 bg-white shadow-md rounded-lg">
        <div class="">
            @if($showForm)
            <div>
                <!-- header form -->
                <div class="flex justify-between mb-6">
                    <h2>{{ $isEditing ? 'Update' : 'Create' }} Layanan</h2>
                </div>
                <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-200">

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
                        <button type="submit"
                                class="flex justify-between px-5 py-2 text-sm font-medium bg-sky-500 hover:bg-sky-700 text-white rounded">
                            <x-antdesign-save-o class="w-5 h-5 text-white me-2"/>                                
                            {{ $isEditing ? 'Update' : 'Create' }}
                            
                        </button>
                        <button type="button" wire:click="resetForm"
                                class="flex bg-gray-500 hover:bg-gray-700 px-4 py-2 rounded text-white">
                            <x-heroicon-o-x-mark class="w-5 h-5 text-white me-2"/>
                            Cancel
                        </button>
                    </div>
                </form>
            @else
            <!-- header form -->
            <div class="flex justify-between mb-6">
                <h2>Daftar Layanan : {{ $jenisLayanan->nama_jenis_layanan }}</h2>
                <div class="flex justify-end">
                    <button class="flex justify-between px-5 py-2 text-sm font-medium bg-sky-500 hover:bg-sky-700 text-white rounded" wire:click="formTambahData">
                        <x-heroicon-s-plus class="w-5 h-5 text-white me-2"/>
                        Tambah Data
                    </button>
                </div>
            </div>
            <hr class="h-px my-6 bg-gray-200 border-0 dark:bg-gray-200"> 

            <div>
                <!-- datatable -->
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Warga</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Domisili</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Jenis Layanan</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($layanans as $layanan)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $layanan->nama_jenis_layanan }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $layanan->icon_jenis_layanan }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ ($layanan->parent->nama_jenis_layanan ?? '-') }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $layanan->is_aktif ? 'Ya' : 'Tidak' }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap flex">
                                    <!-- Actions -->
                                    <button wire:click="edit({{ $layanan->id }})" class="flex justify-between text-sm font-medium text-blue-600 hover:text-blue-900 me-2">
                                        <x-heroicon-o-pencil class="w-5 h-5 text-blue-600 me-2"/>
                                        Edit
                                    </button>
                                    <button wire:click="confirmDeletion({{ $layanan->id }})" class="flex justify-between text-sm font-medium text-red-600 hover:text-red-900">
                                        <x-heroicon-o-trash class="w-5 h-5 text-red-600 me-2"/>
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $layanans->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>