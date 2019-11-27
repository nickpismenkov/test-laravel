@extends('layouts.app')

@section('content')
<div class="card mr-2 ml-2">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-11 mt-2">
                Section
            </div>
            <div class="col-sm-1">
                <a href="/add_department"><input type="submit" class="btn btn-primary" value="Add"></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @foreach($departments as $item)
            <hr>
            <div class="row">
                <div class="col-sm-2">
                    <img src="{{ $item->logo }}" alt="Image" class="img-thumbnail">
                </div>
                <div class="col-sm-5">
                    <b class="card-title">{{ $item->name }}</b>
                    <p class="card-text">{{ $item->description }}</p>
                </div>
                <div class="col-sm-3">
                    <b class="card-title">Users</b>
                        <ol data-spy="scroll" data-offset="0">
                            @foreach($data as $user)
                                @if($item->id == $user['id'])
                                    @foreach($user['users'] as $one)
                                        @if($one != null)
                                            <li>{{ $one }}</li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </ol>
                    </div>
                <div class="col-sm-2">
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
    {{ $departments->render() }}
</div>
@endsection
