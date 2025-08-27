@extends('admin.layouts.master')

@section('title', __('label.medical_test_list'))
@section('toolbarSubTitle', __('label.medical_test_list'))
@section('toolbarPage', __('label.dispaly_all_medical_test_list'))

@section('content')


    @include('components.medicalTests.table')


@endsection
