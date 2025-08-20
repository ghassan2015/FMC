<label class="form-switch">
    <input class="form-check-input check_status" type="checkbox" data-id="{{ $data->id }}"
        {{ $data->admin?->is_active ? 'checked' : '' }} >
    <span class="form-check-label"></span>
</label>
