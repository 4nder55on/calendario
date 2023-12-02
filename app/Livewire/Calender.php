<?php

namespace App\Livewire;

use Livewire\Component;

class Calender extends Component
{
    public $year;
    public $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
                            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    public $month;
    public $days;
    public $days_of_week_array = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
    public $weeks_for_month = [];
    public $primer_dia;

    public $events = [];

    public $openModal = false;

    public function mount()
    {
        $this->year = date('Y');
        $this->month = date('m');

        $this->loadWeeksMonth();

        $this->events = auth()->user()->events;

    }

    public function create()
    {
        return $this->redirect(route('new-event'), navigate: true);
    }

    public $day_selected;
    public $month_selected;
    public $year_selected;

    public function showDay($day, $week_number){
        $this->day_selected = $day;
        if ($day > 15 && $week_number == 0) {
            $key = $this->month - 2;
        }elseif ($day < 15 && $week_number > 3) {
            $key = $this->month;
        }
        else{
            $key = $this->month - 1;
        }

        if ($key < 0) {
            $key = 11;
            $this->year_selected = $this->year - 1;
        }
        else{
            $this->year_selected = $this->year;
        }

        $this->month_selected = $this->months[$key];

        $this->openModal = true;
    }

    public function openListPersonas(){
        dd('openListPersonas');
    }

    public function loadWeeksMonth(){
//        $this->weeks_for_month = [];
        $this->reset('weeks_for_month');

        $days_month = $this->loadDays();
        $day_start_mont = $this->getFirstDay();
        if ($day_start_mont > 0 && $day_start_mont < 6) {
            $days_last_mont = $this->getDayLastMonth();
        }
        else{
            $days_last_mont = 0;
        }

        $weeks = ($days_month + $day_start_mont) / 7;
        $weeks = ceil($weeks);

        for ($i=0; $i < $weeks; $i++) {
            for ($j=0; $j < 7; $j++) {
                if ($i == 0 && $j < $day_start_mont) {
                    $this->weeks_for_month[$i][$j] = $days_last_mont - ($day_start_mont - ($j + 1));
                }else{
                    if ((($i * 7) + ($j + 1) - $day_start_mont) <= $days_month) {
                        $this->weeks_for_month[$i][$j] = (($i * 7) + ($j + 1) - $day_start_mont);
                    }else{
                        $this->weeks_for_month[$i][$j] = (($i * 7) + ($j + 1) - $day_start_mont) - $days_month;
                    }
                }
                $this->weeks_for_month[$i][$j] = str_pad($this->weeks_for_month[$i][$j], 2, "0", STR_PAD_LEFT);
            }
        }
        if ($this->lastDayMonth($days_month) == 6 || $this->lastDayMonth($days_month) == 7) {
            array_pop($this->weeks_for_month);
        }
    }

    public function loadDays() : int
    {
        $this->days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        return $this->days;
    }

    private function getFirstDay() : int
    {
        $first_day = date('N', strtotime("{$this->year}-{$this->month}-01"));

        return intval($first_day);
    }

    private function lastDayMonth(int $day) : int
    {
        $last_day = date('N', strtotime("{$this->year}-{$this->month}-{$day}"));

        return intval($last_day);
    }

    private function getDayLastMonth() : int
    {
        if ($this->month == 1) {
            $monthTemp = 12;
            $yearTemp = $this->year - 1;
        }else{
            $monthTemp = $this->month - 1;
            $yearTemp = $this->year;
        }
        $this->primer_dia = $monthTemp - 1;
        $this->days = cal_days_in_month(CAL_GREGORIAN, ($monthTemp), $yearTemp);
        return $this->days;

    }

    public function render()
    {
        return view('livewire.calender');
    }
}
