<img
data-category_id="{{ $data->id }}"
data-name="{{ $data->users?->name }}"
data-logo="{{$data->users ? $data->users?->photo:asset('images/default.png') }}"



    class="edit" src="{{$data->users ? $data->users?->photo:asset('images/default.png') }}" alt="{{ $data->users?->name }}"
    style="width: 50px; height: 50px; border-radius: 50%;" />
