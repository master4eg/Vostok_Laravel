@extends('layout.layout')
@section('title', isset($user) ? 'Update '. $user->firstName . ' ' . $user->secondName[0] . '. ' . $user->middleName[0] . '.' : 'Create user')


@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-primary">Back to Users</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="@if(isset($user)) {{ route('users.update', $user) }} @else {{ route('users.store') }} @endif">
                @csrf
                @isset($user)
                    @method('PUT')
                @endisset
                <div class="mb-3">
                    <label for="FirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="firstName"
                           value="{{ isset($user) ? $user->firstName : null }}">
                </div>
                <div class="mb-3">
                    <label for="SecondName" class="form-label">Second Name</label>
                    <input type="text" class="form-control" id="SecondName" name="secondName"
                           value="{{ isset($user) ? $user->secondName : null }}">
                </div>
                <div class="mb-3">
                    <label for="MiddleName" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="MiddleName" name="middleName"
                           value="{{ isset($user) ? $user->middleName : null }}">
                </div>
                <div class="mb-3">
                    <label for="Debt" class="form-label">Debt</label>
                    <input type="number" step="0.01" max="999999" class="form-control" id="Debt" name="debt"
                           value="{{ isset($user) ? $user->debt : null }}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
