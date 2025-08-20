@extends('admin.layouts.master')
@section('title', __('label.edit_role'))
@section('toolbarSubTitle', __('label.role_list'))
@section('toolbarPage', __('label.edit_role'))


@section('content')
    <div class="card">
        +

        <div class="card-body">
            <form id="my-form" action="{{ route('admin.roles.update') }}" class="my-form" name="my-form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <div class="row">

                        <input type="hidden" name="role_id" value="{{$role->id}}" >
                        <div class="col-md-6 mb-2">

                            <label for="name_ar" class="form-label">{{ __('label.name') }} (AR)</label>
                            <input type="text" id="name_ar" name="name_ar" class="form-control"
                                value="{{ $role->getTranslation('name','ar') }}"

                                >

                            <div class="name error"></div>
                        </div>


                        <div class="col-md-6 mb-2">

                            <label for="name_en" class="form-label">{{ __('label.name') }}(EN)</label>
                            <input type="text" id="name_en" name="name_en" class="form-control"

                                                                value="{{ $role->getTranslation('name','en') }}"

                                >

                            <div class="name_en error"></div>
                        </div>


                    </div>
                    @foreach (config('global.permissions') as $group => $permissions)
                        <div class="mb-3 border-bottom pb-2">
                            <label class="fw-bold mb-2">{{ $group }}</label>
                            <div class="row">
                                @foreach ($permissions as $key => $value)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                id="permissions_{{ $key }}" name="permissions[]"
                                                value="{{ $key }}"

                                                @if(in_array($value,$role->permission)) checked @endif
                                                >
                                            <label class="form-check-label"
                                                for="permissions_{{ $key }}">{{ $value }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endforeach
                    <div class="permissions error"></div>

                    @error('categories.0')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane me-1"></i> {{ __('label.submit') }}
                    </button>
                    <div id="spinner" class="mt-3" style="display: none;">
                        <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                    </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @include('admin.roles.js.create')
@endpush
