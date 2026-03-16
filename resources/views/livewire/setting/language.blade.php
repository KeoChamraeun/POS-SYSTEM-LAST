<div>
    <a class="dropdown-item" wire:click="switchLanguage('kh')" wire:navigate.prevent style="cursor: pointer">
        <img src="{{asset('assets/images/flags/kh_flag.png')}}" alt="" height="15"  width="25px" class="me-2">
        {{__("Khmer")}}
    </a>
    <a class="dropdown-item" wire:click="switchLanguage('en')" wire:navigate.prevent style="cursor: pointer">
        <img src="{{asset('assets/images/flags/us_flag.png')}}" alt="" height="15" width="25px" class="me-2">
        {{__("English")}}
    </a>
</div>
