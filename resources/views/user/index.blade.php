@extends('layouts.master')

@section('title', $page_title)
@endsection

@section('navigation')

<div class="row">
    <ul class="breadcrumb">
        <li><a href="/user">Users</a></li>
    </ul>
</div>

@endsection

@section('content')

<div class="row">
    <div class="col-sm-8 col-md-6 col-lg-4">

        @if (isset($errors['db_connection']))
            <span class="label label-danger">{{ $errors['db_connection'] }}</span>
            <span class="label label-danger">{{ $errors['db_create'] }}</span>
        @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-xs-5 col-sm-6">User name</th>
                    <th class="col-xs-7 col-sm-6">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>
                        <button type="button" class="btn btn-success btn-xs"
                            onclick="window.location.href='/user/{{ $user->id }}'">Show</button>
                        <button type="button" class="btn btn-warning btn-xs"
                            onclick="window.location.href='/user/{{ $user->id }}/edit'">Edit</button>
                        <button type="button" class="btn btn-danger btn-xs"
                            onclick="window.location.href='/user/{{ $user->id }}/delete'">Delete</button>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-success btn-xs"
                            onclick="window.location.href='/user/create'">Add</button>
                    </td>
                </tr>
            </tbody>
        </table>
        @endif

    </div>
</div>

@endsection