<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Layanan;
use App\Models\JenisLayanan;

class ShowLayanans extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.show-layanans',[
            'layanans' => Layanan::paginate(10),
        ]);
    }
}
