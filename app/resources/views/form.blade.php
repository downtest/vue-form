@extends('layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="/clients">Список клиентов</a>
    </li>
@endsection

@section('content')
    <order-form></order-form>
@endsection
