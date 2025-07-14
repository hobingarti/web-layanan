<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\JenisLayanan;
use App\Models\Layanan;

class LayanansByJenis extends Component
{
    use WithPagination;
    public $jenisLayananId;
    public $jenisLayanan;

    public $showForm = false;
    public $isEditing = false;

    public $alertTitle = '';
    public $alertMessage = '';
    public $number = 0;

    // untuk wadah form data
    public $jenisLayanans;
    public $selectedJenisLayanan = null;
    public $nikWarga;
    public $namaWarga;
    public $alamatDomisili;
    public $lingkunganDomisili;
    
    protected $rules = [
        'nikWarga' => 'required|string|max:16',
        'namaWarga' => 'required|string|max:255',
        'alamatDomisili' => 'required|string|max:255',
        'lingkunganDomisili' => 'required|string|max:255',
    ];
    
    public function mount($jenisLayananId)
    {
        $this->jenisLayananId = $jenisLayananId;
        $this->jenisLayanan = JenisLayanan::find($jenisLayananId);
        if (!$this->jenisLayanan) {
            abort(404, 'Jenis Layanan not found');
        }
    }

    public function render()
    {
        return view('livewire.layanans-by-jenis', [
            'jenisLayanan' => $this->jenisLayanan,
            'layanans' => Layanan::where('jenis_layanan_id', $this->jenisLayananId)->paginate(10)
        ]);
    }
}
