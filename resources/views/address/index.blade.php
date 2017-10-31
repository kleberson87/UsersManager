@extends('layouts.master')

@section('title', $page_title)
@endsection

@section('navigation')

<div class="row">
    <ul class="breadcrumb">
        <li><a href="/user">Users</a></li>
        <li><a href="/address/index/{{ $id_user }}">Addresses</a></li>
    </ul>
</div>

@endsection

@section('content')

<div class="row">
    <div class="col-md-8 col-lg-6">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-xs-4">City</th>
                    <th class="col-xs-5">Street</th>
                    <th class="col-xs-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($addresses as $address)
                <tr>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->street }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-xs"
                            onclick="window.location.href='/address/{{ $address->id }}/edit'">Edit</button>
                        <button type="button" class="btn btn-danger btn-xs"
                            onclick="window.location.href='/address/{{ $address->id }}/delete'">Delete</button>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <button type="button" class="btn btn-success btn-xs"
                            onclick="window.location.href='/address/create/{{ $id_user }}'">Add</button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

@endsection