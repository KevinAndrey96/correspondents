@extends('layouts.dashboard')
    <form action="{{ url('/profit') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('profit.form', ['mode'=>'Crear'])
    </form>

