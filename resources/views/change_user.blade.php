@extends('layouts.app')

@section('content')
<div class="card mr-2 ml-2">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-11 mt-2">
                Users
            </div>
        </div>
    </div>
    <div class="card-body">
        <span><b>Все поля обязательны</b></span><hr>
        <form action="/save_user" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ $item->name }}">
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{ $item->email }}">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter new password" name="password">
            </div>
            <input type="submit" name="submit" value="Send" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection
