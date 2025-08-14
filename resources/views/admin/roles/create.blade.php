@extends('admin.layouts.master')
@section('title', __('label.add_new_role'))
@section('toolbarSubTitle', __('label.role_list'))
@section('toolbarPage', __('label.add_new_role'))


@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ __('label.add_new_role') }}</h3>
        </div>

        <div class="card-body">
            <form id="form" class="form" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">{{ __('label.name') }}</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>
                @foreach (config('global.permissions') as $group => $permissions)
                    <div class="mb-3 border-bottom pb-2">
                        <label class="fw-bold mb-2">{{ $group }}</label>
                        <div class="row">
                            @foreach ($permissions as $key => $value)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="permissions_{{ $key }}"
                                            name="permissions[]" value="{{ $key }}">
                                        <label class="form-check-label"
                                            for="permissions_{{ $key }}">{{ $value }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
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
