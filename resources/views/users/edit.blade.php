@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <a href="{{route('users.index')}}" class="btn btn-dark">Назад</a>
        </div>
        <div class="col-12 mt-5">
            <h2>Редактирование пользователя</h2>
        </div>

        <div class="col-12 p-0">
            @include('users._form', ['formType' => 'edit'])
        </div>
    </div>

@endsection