@extends('layouts.app')

@section('content')

    <div class="row mt-5">
        <div class="col-12">
            <h1>Пользователи</h1>
        </div>

        @if (session()->has('status'))
            <div class="col-12 mt-3 status status--success">
                {{ session('status') }}
            </div>
        @endif

        <div class="col-12 mt-3">
            <div class="table-responsive-sm">
                <table class="table table-dark">
                    <thead >
                    <tr>
                        <td>Имя</td>
                        <td>Фамилия</td>
                        <td>E-Mail</td>
                        <td>Роль</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="bg-light text-dark">
                            <td>{{$user->name}}</td>
                            <td>{{$user->lastname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role_name}}</td>
                            <td>
                                <a href="/users/{{$user->id}}/edit" class="text-dark">Редактировать</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{route('users.create')}}" class="btn btn-success mt-3">Добавить</a>
        </div>
    </div>

@endsection