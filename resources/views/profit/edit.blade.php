@extends('layouts.dashboard')
    <form action="{{ url('/profit/'.$profit->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @include('profit.form', ['mode'=>'Editar'])
    </form>

