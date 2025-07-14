<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JenisLayanan;
class IndexLayanans extends Component
{
    public function render()
    {
        return view('livewire.index-layanans', [
            'jenisLayanans' => JenisLayanan::where('is_aktif', 1)->where('parent_id', 0)->get()
        ]);
    }
}
