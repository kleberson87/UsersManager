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
    <div class="col-sm-6">

        <form class="form-horizontal" action="{{ $action }}" method="post">
            <input type = "hidden" name = "_token" value = "{{ csrf_token() }}">
            <input type = "hidden" name = "id_user" value = "{{ $id_user }}">

            <div class="form-group">
                <label class="control-label col-sm-2" for="City">City:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="City" name="City"
                        value="{{ isset($address) ? $address->city : '' }}"
                        placeholder="Enter city">
                    <span class="label label-danger">{{ isset($errors['city']) ? $errors['city'] : '' }}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="Street">Street:</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="Street" name="Street"
                        value="{{ isset($address) ? $address->street : '' }}"
                        placeholder="Enter street">
                    <span class="label label-danger">{{ isset($errors['street']) ? $errors['street'] : '' }}</span>
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