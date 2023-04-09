@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : "Authors")
@section('content')

@livewire('authors')

@endsection