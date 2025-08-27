@extends('admin.layouts.master')

@section('title', __('label.appointments'))
@section('toolbarSubTitle', __('label.appointment_list'))
@section('toolbarPage', __('label.dispaly_all_appointment_list'))

@section('content')


    @include('components.appointments.table')


@endsection
