@extends('dashboard.layout')
 
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert m-0 p-0 mb-3 alert-dismissible" role="alert">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body alert-success">
                        @if (Auth::user()->roles == 0)
                            Selamat Datang, {{ Auth::user()->name }}<br>
                            Kamu berhasil login sebagai User
                        @elseif (Auth::user()->roles == 1)
                            Selamat Datang, {{ Auth::user()->name }}<br>
                            Kamu berhasil login sebagai Admin
                        @endif
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Daftar Artikel</div>
                <div class="card-body">
                    @if(session()->get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Selamat!</strong> {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <a class="btn btn-success mb-2" href="{{ route('dashboard.create') }}">+ Tambah Artikel</a>
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Status</th>
                            <th scope="col">Dibuat</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                            @php
                                $name = DB::table('users')->where('id', $post->users_id)->value('name');
                            @endphp
                            @if (Auth::user()->roles == 0)
                                @if (Auth::user()->id == $post->users_id)
                                    <tr>
                                        <th scope="row">{{ $post->id }}</th>
                                        <td>{{ $post->title }}</td>
                                        <td><span class="{{ $post->status == 0 ? 'bg-danger' : 'bg-success' }} rounded p-1 text-white">{{ $post->status == 0 ? 'Draft' : 'Published' }}</span></td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle p-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('dashboard.edit', $post->id) }}">Edit</a>
                                                    @if ($post->status == 0)
                                                    <form action="{{ route('dashboard.destroy', $post->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @elseif (Auth::user()->roles == 1)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td><span class="{{ $post->status == 0 ? 'bg-danger' : 'bg-success' }} rounded p-1 text-white">{{ $post->status == 0 ? 'Draft' : 'Published' }}</span></td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle p-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route('dashboard.edit', $post->id) }}">Edit</a>
                                                <form action="{{ route('dashboard.destroy', $post->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form>
                                                @if ($post->status == 0)
                                                    <a class="dropdown-item" href="{{ URL::to('/update/'.$post->id) }}">Publish</a>
                                                @elseif ($post->status == 1)
                                                    <a class="dropdown-item" href="{{ URL::to('/update/'.$post->id) }}">Draft</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <div class="row justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection