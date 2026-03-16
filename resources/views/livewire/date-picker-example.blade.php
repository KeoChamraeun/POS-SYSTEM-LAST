<div>
    <input x-data x-init="flatpickr($refs.input, {
        dateFormat: 'Y-m-d',
        onChange: function(selectedDates, dateStr) {
            $wire.set('date', dateStr)
        }
    })" x-ref="input" type="text" class="form-control" placeholder="Select date" />

    <div class="mt-2">
        Selected date: {{ $date }}
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
