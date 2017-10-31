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
    <div class="col-sm-6">

        <form class="form-horizontal" action="{{ $action }}" method="post">
            <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">

            <div class="form-group">
                <label class="control-label col-sm-2" for="Name">Name:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="Name" name="Name"
                        value="{{ isset($user) ? $user->name : '' }}"
                        placeholder="Enter user name">
                    <span class="label label-danger">{{ isset($errors['name']) ? $errors['name'] : '' }}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection