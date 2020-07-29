@extends('dashboard.layout')
   
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nama:</strong>
                                    <input type="text" name="nama" value="{{ Auth::user()->name }}" class="form-control" placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Password Lama *:</strong>
                                    <input type="password" name="passwordlama" class="form-control" placeholder="Password Lama">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Password Baru:</strong>
                                    <input type="password" name="passwordbaru" class="form-control" placeholder="Password Baru">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Ulangi Password Baru:</strong>
                                    <input type="password" name="ulangipasswordbaru" class="form-control" placeholder="Ulangi Password Baru">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                    @if(session()->get('status'))
                        @if (session()->get('status') != '')
                            <div class="alert {{ session()->get('bool') == 0 ? 'alert-danger' : 'alert-success' }} alert-dismissible fade show m-3" role="alert">
                                Keterangan:
                                <ul>
                                    {!! session()->get('status') !!}
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger p-3 m-3">
                            Ada beberapa masalah dengan input anda:<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
