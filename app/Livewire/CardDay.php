<?php

namespace App\Livewire;

use Livewire\Component;

class CardDay extends Component
{
    public $day;
    public $month;
    public $year;
    public $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
        'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    public $openModal = false;

    public function mount($day = null, $month = null, $year = null)
    {
        $this->day = $day;
        $this->year = $year;
        $this->month = $month;
    }

    public function render()
    {
        return view('livewire.card-day');
    }
}
