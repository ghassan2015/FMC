@if($data->thumbnail) <!-- أو $data->cover إذا اسم العمود مختلف -->
    <img src="{{  $data->thumbnail }}" alt="Cover Image"
        class="img-thumbnail rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
@else
    <img src="{{ asset('assets/default.png') }}" alt="No Image"
        class="img-thumbnail rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
@endif
