<label class="form-switch">
    <input class="form-check-input check_status" type="checkbox" data-id="{{ $data->id }}"
        {{ $data->status ? 'checked' : '' }} onchange="toggleActive(this)">
    <span class="form-check-label"></span>
</label>
