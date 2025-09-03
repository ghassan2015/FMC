@extends('admin.layouts.master')

@section('title', __('label.drug_user_list'))
@section('toolbarSubTitle', __('label.drug_user_list'))
@section('toolbarPage', __('label.dispaly_all_drug_user_list'))

@section('content')


    @include('components.drugUsers.table')


@endsection
