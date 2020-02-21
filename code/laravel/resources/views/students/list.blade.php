@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Student code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                </tr>
                </thead>
                <tbody>
                @php $i=1; @endphp
                @foreach($list as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->age}}</td>
                        @if ($item->gender == 1)
                            <td><i class="fa fa-mars"></i></td>
                        @else
                            <td><i class="fa fa-venus"></i></td>
                        @endif
                        <td>{{$item->email}}</td>
                        <td>{{$item->address}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <p>{{$list->links()}}</p>
        </div>
    </div>
    @endsection
