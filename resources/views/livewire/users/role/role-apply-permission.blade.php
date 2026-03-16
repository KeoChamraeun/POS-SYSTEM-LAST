<div>
    <section class="section">
        <form wire:submit.prevent="setPermission">  
            <div class="card mb-3 sticky-permission-header">
                <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-2 mb-md-0">
                        {{ __('Apply Permission For') }}
                        <span class="fw-bold text-primary">{{ $role->name }}</span>
                    </h6>

                    <button type="submit" class="btn btn-primary">
                    <span><i class="fas fa-file-medical-alt me-2"></i></span>
                        {{__('New Role')}}
                    </button>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ __($error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
            @foreach ($get_departments as $depart)
                <div class="card mb-4 shadow-sm"> 
                    <div class="card-header bg-light fw-semibold">
                        <div class="form-check">
                            <input class="form-check-input"
                                type="checkbox"
                                wire:click="handle_main_department({{ $depart->id }})"
                                wire:model="main_department.{{ $depart->id }}"
                                id="main-{{ $depart->id }}">

                            <label class="form-check-label text-uppercase"
                                for="main-{{ $depart->id }}">
                                {{ get_translation($depart) }}
                            </label>
                        </div>
                    </div> 
                    <div class="card-body">
                        @foreach ($depart->children as $item)
                            <div class="border rounded p-3 mb-3"> 
                                <div class="form-check mb-2">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        wire:click="handle_sub_department({{ $item->id }})"
                                        wire:model="sub_department.{{ $item->id }}"
                                        id="sub-{{ $item->id }}">

                                    <label class="form-check-label fw-semibold"
                                        for="sub-{{ $item->id }}">
                                        {{ get_translation($item) }}
                                    </label>
                                </div>

                                {{-- Actions --}}
                                <div class="row ms-3">
                                    @foreach ($item->permission as $action)
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    wire:click="handle_sub_department_action({{ $item->id }}, {{ $action->id }})"
                                                    wire:model="sub_department_action.{{ $item->id }}.{{ $action->id }}"
                                                    id="action-{{ $item->id }}-{{ $action->id }}">

                                                <label class="form-check-label"
                                                    for="action-{{ $item->id }}-{{ $action->id }}">
                                                    {{ __($action->action) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        @endforeach
                    </div>

                </div>
            @endforeach

        </form>
    </section>
    <style>
        .card-header {
            border-bottom: 1px solid var(--bs-border-color);
        }

        .form-check-label {
            cursor: pointer;
        }

        .border {
            background-color: var(--bs-body-bg);
        } 
        .sticky-permission-header {
            position: sticky;
            top: 0; /* or 70px if you have navbar */
            z-index: 1020; /* above cards */
            background-color: var(--bs-body-bg);
        }

        /* Nice shadow when scrolling */
        .sticky-permission-header::after {
            content: "";
            position: absolute;
            inset: auto 0 0 0;
            height: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,.08);
            pointer-events: none;
        }


    </style>
</div>
