
<label class="form-switch">
    <input class="form-check-input onchange" type="checkbox"
        data-id="{{ $data->id }}"
        {{ $data->is_active ? 'checked' : '' }}
        onchange="toggleActive(this)">
    <span class="form-check-label"></span>
</label>
