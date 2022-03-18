@extends('layouts.admin')
@section('user','active')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User</h1>
      </div>
    </div>
  </div>
</div>

<section class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-success" id="createUser" data-href="{{ route('user.store') }}" role="button" data-toggle="modal" data-target="#modalAddUser"><i class="fa fa-plus" aria-hidden="true"></i>
                    Tambah User</button>
                <table class="table table-search table-striped table-inverse">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $user)
                            <tr>
                                <td>
                                    {{ $no=(isset($no)?$no:0)+1 }}
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->level==1?"Administrator":"Visitor" }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
{{-- Modal --}}
<div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="modalAddLabel">Tambah User</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-light">&times;</span>
                </button>
            </div>
            <form action="#" id="formAddUser" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="email@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" value="" class="form-control" placeholder="" required>
                        <div class="password invalid-feedback">
                            The password confirmation does not match.
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmPass" value="" class="form-control" placeholder="" required>
                        <div class="invalid-feedback">
                            The password confirmation does not match.
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select class="custom-select" name="level" required>
                            <option name="" value="" disabled selected>--PILIH--</option>
                                <option value="1">Administrator</option>
                                <option value="0">Visitor</option>
                        </select>
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle pr-1" aria-hidden="true"></i>Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#createUser').click(function () {
                var url = $(this).data('href');
                var idModal = $(this).data('target');
                $(idModal+' form').attr('action',url);
            })
            var jmlAksi = 0;
            $('#formAddUser').submit(function(e){
                var nama = $('#formAddUser [name=nama]').val();
                var email = $('#formAddUser [name=email]').val();
                var pass = $('#formAddUser [name=password]').val();
                var confirmPass = $('#formAddUser [name=confirmPass]').val();
                var level = $('#formAddUser [name=level]').val();
                if (pass.length>=8) {
                    if(jmlAksi>5){
                        jmlAksi = 0;
                    }
                    $('#formAddUser [name=password]').removeClass('is-invalid')
                    if ((pass!=confirmPass)) {
                        $('#formAddUser [name=confirmPass]').addClass('is-invalid');
                        $('#formAddUser [name=confirmPass]').focus();
                        e.preventDefault();
                        jmlAksi++;
                    }else{
                        $('#formAddUser [name=confirmPass]').removeClass('is-invalid');
                        $('#formAddUser [name=confirmPass]').addClass('is-valid');
                        jmlAksi = 0;
                    }
                    if(jmlAksi>2){
                        alert("The password confirmation does not match.");
                    }
                } else {
                    $('#formAddUser [name=password]').addClass('is-invalid');
                    $('#formAddUser [name=password]').focus();
                    $('#formAddUser div.password').html('please length then this text to 8 characters or more (you are currently using '+pass.length+' characters).');
                    e.preventDefault();
                    jmlAksi++;
                    if(jmlAksi>2){
                        jmlAksi = 6;
                        alert("Password must be 8 characters.");
                    }
                }

            })
        });
    </script>
@endsection