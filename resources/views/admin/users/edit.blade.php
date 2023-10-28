@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class=="col">
                    <h4 class="m-0 text-dark">{{$judulhalaman}}</h4>
                </div>
            </div>
        </div>
        <form action="{{ asset('update-users/'.$users->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="card">
                <div class="card-header bg-primary">
                        <h5 class="text-white py-2">
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                        </h5>
                </div> 
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="">Role</label>
                            <div class="p-3 border">{{$users->role_as == '0' ? 'User':'Admin'}}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Nama Depan</label>
                            <input type="text" class="form-control" id="name" value="{{$users->name }}" name="name">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Nama Belakang</label>
                            <input type="text" class="form-control" id="last_name" value="{{$users->last_name }}" name="last_name">
                            
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Email</label>
                            <div class="p-3 border">{{$users->email}}</div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telp" value="{{$users->no_telp }}" name="no_telp">
                            
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Alamat</label>
                            <textarea name="alamat" id="alamat" value="" class="form-control" rows="1">{{$users->alamat }}</textarea>
                            
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Posisi</label>
                            <input type="text" class="form-control" id="posisi" value="{{$users->posisi }}" name="posisi">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Akun Dibuat</label>
                            <div class="p-3 border">{{ date('D-M-Y', strtotime($users->created_at)) }}</div>
                        </div>
                    </div>
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
                text: "Untuk Menghapus Product "+nama+"..! ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location ="/destroy-product/"+itemid+""
                swal("Terhapus! Kamu Berhasil Menghapus Data Product "+nama+"!", {
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