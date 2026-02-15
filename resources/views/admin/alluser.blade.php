@extends('layouts.admin')


@section('content')


<div class="container ">
    <div class="row">
        @if (session('success'))
    <div class="alert alert-sucess" role="alert">
        {{ session('success') }}
    </div>
@endif

        <div class="col-md-12 text-center">

            <table class="table">
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>

            @foreach ($alluser as $user)
            <tr>
                <td> {{$user->id}} </td>
                <td> {{$user->name}} </td>
                <td> {{$user->email}} </td>
                <td> {{$user->role}} </td>
                <td>
    <!-- Edit Button -->
        <button type="button" class="btn btn-warning"
    onclick="window.location='{{ route('useredit', $user->id) }}'">
    Edit
</button>


        <!-- Delete Button -->

    <button type="button" class="btn btn-danger"
        onclick="confirmDelete({{ $user->id }})">
    Delete
</button>

</td>
            </tr>

            @endforeach

            </table>
        </div>

    </div>
</div>


@endsection


