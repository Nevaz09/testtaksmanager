@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 >{{$judulhalaman}}</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body">
            <form action="{{ url('insert-taks') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="">Name Project</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="">Nama Karyawan</label>
                        <select class="form-select" name="id_user" >
                            <option value="">Pilih Karyawan</option>
                            @foreach($user as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control"  rows="3"></textarea>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="">Soal (JPG, PNG)</label>
                        <input type="file" name="photo" id="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection