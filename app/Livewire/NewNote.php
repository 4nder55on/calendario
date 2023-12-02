<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewNote extends Component
{
    #[Rule('required')]
    public $title;
    #[Rule('required')]
    public $description;
    #[Rule('required|date')]
    public $date;

    public function save()
    {
        $this->validate();

        Event::create([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'user_id' => auth()->id(),
        ]);

        $this->reset();

        $this->redirect(route('calender'), navigate: true);

    }

    public function render()
    {
        return view('livewire.new-note');
    }
}
