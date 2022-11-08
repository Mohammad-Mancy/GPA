@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Prize Management</h2>
            </div>
            <div class="pull-right">
                @can('prize-create')
                <a class="btn btn-success" href="{{ route('prizes.create') }}"> Create New Prize</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($prizes as $prize)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $prize->name }}</td>
	        <td>{{ $prize->detail }}</td>
	        <td>
                <form action="{{ route('prizes.destroy',$prize->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('prizes.show',$prize->id) }}">Show</a>
                    @can('prize-edit')
                    <a class="btn btn-primary" href="{{ route('prizes.edit',$prize->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('prize-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $prizes->links() !!}
    
@endsection