<img
    data-category_id="{{ $data->id }}"
    data-name_ar="{{ $data->getTranslation('name', 'ar') }}"
    data-name_en="{{ $data->getTranslation('name', 'en') }}"
    data-font_hex_code="{{ $data->font_hex_code }}"
    data-background_hex_code="{{ $data->background_hex_code }}"
    data-logo="{{ $data->getImageUrl('logo') }}"
    data-is_parent_category="{{ $data->is_parent_category }}"
    data-parent_category_id="{{ $data->parent_category_id }}"



    class="view" src="{{ $data->getImageUrl('logo') }}" alt="{{ $data->name }}"
    style="width: 50px; height: 50px; border-radius: 50%;" />
