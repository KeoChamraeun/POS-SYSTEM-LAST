<?php

namespace App\Livewire\Setting;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Language extends Component
{
    public $lang;

    public function switchLanguage($lang)
    {
        Session::put('locale', $lang);
        App::setLocale($lang);
        $currentUrl = url()->previous();
        $this->redirect($currentUrl, navigate: false);
        $this->dispatch('languageChanged');
    }

    public function render()
    {
        $this->lang = session('locale');

        // App::setLocale($this->lang);
        return view('livewire.setting.language');
    }
}
