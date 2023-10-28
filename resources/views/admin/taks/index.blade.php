@extends('layouts.admin')

@section('content')

<div class="container-fluid shadow">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class=="col">
                    <h4 class="m-0 text-dark">{{$judulhalaman}}</h4>
                </div>
            </div>
        </div>
        <form action="{{ route('destroyalltaks')}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="justify-content-end">
                        <div class=="col">
                            <!-- <input placeholder="Search" type="search" name="search" class="form-control" > -->
                        </div>
                        <div class="float-right">
                            @if(Auth::user()->role_as == 1)
                            <a href="{{route('add-taks')}}" class="btn btn-primary">Create</a>
                            <button type="submit" class="btn btn-danger">Delete All</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="chkpilihsemua"></th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Tanggal Dibuat</th>
                                <th>Action</th>
                            </tr>
                    </thead>
                        <tbody> 
                            @php
                                $no =1;
                            @endphp
                            @foreach($taks as $index => $item)
                            <tr>
                                <td><input type="checkbox" name="itemsid[]" value="{{$item->id}}"></td>
                                <td scope="row">{{$index + $taks->firstItem()}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->status == '0' ? 'Belum selesai' :'Selesai'}}</td>
                                <td>{{date('d/M/Y', strtotime($item->created_at))}}</td>
                                <td>
                                    <a href="{{asset('taksView-taks/'.$item->id)}}" class="btn  btn-info">View</a>                                      
                                    @if(Auth::user()->role_as == 1)
                                    <a href="#" class="btn btn-danger delete" data-id="{{$item->id}}" data-nama="{{$item->name}}">Delete</a>
                                    @endif                                      
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                    {{$taks->links()}}
                    
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
    <script>
        $('.delete').click(function(){
            var itemid=$(this).attr('data-id');
            var nama = $(this).attr('data-nama');
            swal({
                title: "Apakah kamu yakin?",
                text: "Untuk Menghapus Tugas "+nama+"..! ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location ="/destroy-taks/"+itemid+""
                swal("Terhapus! Kamu Berhasil Menghapus Tugas "+nama+"!", {
                icon: "success",
                });
            } else {
                swal("Data Tidak Jadi Dihapus!");
            }
            }); 
        });
    </script>
    <script>
    @if (Session::has('success'))
        toastr.success("{{Session::get('success')}}")
    @endif
    @if(Session::has('error'))
        toastr.error("{{Session::get('error')}}")
    @endif
    @if(Session::has('warning'))
        toastr.warning("{{Session::get('warning')}}")
    @endif
    </script>
@endsection()