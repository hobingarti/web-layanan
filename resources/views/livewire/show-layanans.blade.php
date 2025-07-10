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
