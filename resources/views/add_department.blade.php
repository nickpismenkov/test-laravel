@extends('layouts.app')

@section('content')
<div class="card mr-2 ml-2">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-11 mt-2">
                Section
            </div>
        </div>
    </div>
    <div class="card-body">
        <span><b>Все поля обязательны</b></span><hr>
        <form action="/add_department" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter name" name="name">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="3" name="description" placeholder="Enter description"></textarea>
            </div>
            <div class="form-group">
                <label>Logo</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="image">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <h4>Users</h4>
                @foreach($users as $user)
                    <input type="checkbox" name="checkbox[]" value="{{ $user->id }}">{{ $user->name }}(<a href="mailto:{{ $user->email }}">{{ $user->email }}</a>)<br>
                @endforeach
            </div>
            <input type="submit" name="submit" value="Send" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection
