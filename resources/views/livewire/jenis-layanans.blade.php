<!-- header slot -->
<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Layanan') }}
        </h2>
        <div class="flex justify-end text-gray-500">
            <!-- not working, kita akan ganti dengan breadcrumb sajalah -->
             jenis layanan / index
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

    <div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg mb-6">
        <div class="">
            @if($showForm)
            <div>
                <!-- header form -->
                <div class="flex justify-between border-b border-gray-200 pb-4 sm:px-6 lg:px-8 px-4 py-6">
                    <h2>{{ $isEditing ? 'Update' : 'Create' }} Jenis Layanan</h2>
                </div>

                @if($isEditing)
                <form wire:submit.prevent="update" class="sm:px-6 lg:px-8 px-4 py-6 bg-gray-100">
                @else
                <form wire:submit.prevent="store" class="sm:px-6 lg:px-8 px-4 py-6 bg-gray-100">
                @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="namaJenisLayanan" class="block text-sm font-medium text-gray-700">Nama Jenis Layanan</label>
                            <input type="text" id="namaJenisLayanan" wire:model="namaJenisLayanan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('namaJenisLayanan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="kode" class="block text-sm font-medium text-gray-700">Kode Jenis Layanan</label>
                            <input type="text" id="kode" wire:model="kode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('kode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="parentId" class="block text-sm font-medium text-gray-700">Parent Jenis Layanan</label>
                            <select id="parentId" wire:model="parentId" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="0">Buat Sebagai Parent</option>
                                @foreach($jenisLayanans->where('parent_id', 0) as $jenisLayanan)
                                    <option value="{{ $jenisLayanan->id }}">{{ $jenisLayanan->nama_jenis_layanan }}</option>
                                @endforeach
                            </select>
                            @error('parentId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="iconJenisLayanan" class="block text-sm font-medium text-gray-700 flex">Icon Jenis Layanan</label>
                            <select id="iconJenisLayanan" wire:model.live="iconJenisLayanan"  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Icon</option>
                                @foreach($icons as $icon)
                                    <option value="{{ $icon }}" {{ $icon === $iconJenisLayanan ? 'selected' : '' }}>{{ $icon }}</option>
                                @endforeach
                            </select>
                            @error('iconJenisLayanan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="isAktif" class="block text-sm font-medium text-gray-700">Status</label>
                            <input type="checkbox" id="isAktif" wire:model="isAktif" class="mt-1">
                            <label for="isAktif" class="ms-2 text-sm font-medium text-gray-700">Set Aktif</label>
                            
                        </div>
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea id="keterangan" wire:model="keterangan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                            @error('keterangan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
            </div>
            @else
            <!-- header form -->
            <div class="flex justify-between border-b border-gray-200 pb-4 sm:px-6 lg:px-8 px-4 py-6">
                <h2>Daftar Jenis Layanan</h2>
                <div class="flex justify-end">
                    <a href="https://docs.google.com/document/d/1A6n9TprBqWwQoJEdThb5qYHqUIDwZWmofNV4dpXrE3I/edit?tab=t.f2zs32rvse0a" 
                        target="_blank" class="flex justify-between px-2 py-2 text-sm font-medium bg-indigo-500 hover:bg-indigo-700 text-white rounded me-1" 
                        title="help">
                        <x-antdesign-question-o class="w-5 h-5 text-white"/>
                        Help
                    </a>
                    <button class="flex justify-between px-5 py-2 text-sm font-medium bg-sky-500 hover:bg-sky-700 text-white rounded" wire:click="formTambahData">
                        <x-heroicon-s-plus class="w-5 h-5 text-white me-2"/>
                        Tambah Data
                    </button>
                </div>
            </div>

            <div class="sm:px-6 lg:px-8 px-4 py-6 bg-gray-100">
                <!-- datatable -->
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nama Jenis Layanan</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Parent</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Aktif</th>
                            <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jenisLayanans as $jenisLayanan)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $jenisLayanan->nama_jenis_layanan }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $jenisLayanan->icon_jenis_layanan }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ ($jenisLayanan->parent->nama_jenis_layanan ?? '-') }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap">{{ $jenisLayanan->is_aktif ? 'Ya' : 'Tidak' }}</td>
                                <td class="px-6 py-4 whitespace-no-wrap flex">
                                    <!-- Actions -->
                                    <button wire:click="edit({{ $jenisLayanan->id }})" class="flex justify-between text-sm font-medium text-blue-600 hover:text-blue-900 me-2">
                                        <x-heroicon-o-pencil class="w-5 h-5 text-blue-600 me-2"/>
                                        Edit
                                    </button>
                                    <button wire:click="confirmDeletion({{ $jenisLayanan->id }})" class="flex justify-between text-sm font-medium text-red-600 hover:text-red-900">
                                        <x-heroicon-o-trash class="w-5 h-5 text-red-600 me-2"/>
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $jenisLayanans->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>