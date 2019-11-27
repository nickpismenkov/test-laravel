@extends('layouts.app')

@section('content')
<div class="card mr-2 ml-2">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-11 mt-2">
                Users
            </div>
            <div class="col-sm-1">
                <a href="/add_user"><input type="submit" class="btn btn-primary" value="Add"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @foreach($users as $item)
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <p class="card-text">{{ $item->name }}</p>
                </div>
                <div class="col-sm-3">
                    <p class="card-text">{{ $item->email }}</p>
                </div>
                <div class="col-sm-3">
                    @if($item->created_at != null)
                        <p class="card-text">{{ $item->created_at }}</p>  
                    @else
                        <p class="card-text">{{ 'NULL' }}</p>  
                    @endif  
                </div>
                <div class="col-sm-3">
                    <form action="" class="inline-form" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <input type="submit" name="edit" class="btn btn-secondary" value="Edit">
                        <input type="submit" name="delete" class="btn btn-danger" value="Delete">
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="ml-2 mt-2">
    {{ $users->render() }}
</div>
@endsection
