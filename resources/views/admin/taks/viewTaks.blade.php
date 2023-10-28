@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="cad">
            <div class="card-header">
                <div class=="col">
                    <h4 class="m-0 text-dark">{{$judulhalaman}}</h4>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->role_as == 1)
    <form action="" method="POST" enctype="multipart/form-data">
    @csrf    
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="text-white py-2">Tugas {{$taks->name}}
                            <a href="{{asset('taks')}}" class="btn btn-light float-end">Kembali</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details" >
                                <h5 class="py-2">Tugas</h5>
                                <hr>
                                <label for="" class="text-center my-2">Soal</label>
                                <div class="border ">{{$taks->name}}</div>
                                <label for="" class="text-center my-2">Soal</label>
                                <div class="border ">
                                    @if($taks->photo)
                                        <img src="{{ asset('assets/uploads/tugas/'.$taks->photo) }}" alt="karyawan photo"  style="width: 400px;">
                                    @endif
                                </div>
                                <label for="" class="text-center my-2">Deskripsi Soal</label>
                                <div class="border ">{{$taks->description}}</div> 
                            </div>
                            <div class="col-md-6 order-details">
                                <h5 class="py-2">Jawaban</h5>
                                <hr>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Answer (File Docx, PDF)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">{{$taks->user->name}}</td>
                                            <td>{{ $taks->document }}</td>
                                            <td><a href="{{url('assets/uploads/tugas/'.$taks->document)}}" class="btn btn-secondary float-end"><i class="fa-solid fa-file-arrow-down"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                    <hr> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Status</label>
                                        <div class="border bg-success">{{$taks->status  == '0' ? 'Belum selesai' :'Selesai'}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="text-white py-2">Tugas {{$taks->name}}
                            <a href="{{asset('taks')}}" class="btn btn-light float-end">Kembali</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details" >
                                <h5 class="py-2">Tugas</h5>
                                <hr>
                                <label for="" class="text-center my-2">Soal</label>
                                <div class="border ">{{$taks->name}}</div>
                                <label for="" class="text-center my-2">Soal</label>
                                <div class="border ">
                                    @if($taks->photo)
                                        <img src="{{ asset('assets/uploads/tugas/'.$taks->photo) }}" alt="karyawan photo"  style="width: 400px;">
                                    @endif
                                </div>
                                <label for="" class="text-center my-2">Deskripsi Soal</label>
                                <div class="border ">{{$taks->description}}</div>
                                
                                
                            </div>
                            <div class="col-md-6 order-details">
                                <h5 class="py-2">Jawaban</h5>
                                <hr>
                                <form action="{{ url('isnsertanswer-taks/'.$taks->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Answer (File Docx, PDF)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="file" name="document" id="form-control">{{$taks->document}} </td>
                                            <td>
                                                <select class="form-select float-end" name="status">
                                                    <option {{$taks->status == '0'?'selected':''}} value="0">Belum Selesai</option>
                                                    <option {{$taks->status == '1'?'selected':''}} value="1">Selesai</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                                    </div>
                                </div>
                                </form>
                                    <hr> 
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
     
    @endif  
</div>
@endsection
@section('js')
@endscction
