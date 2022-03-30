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
                            {{-- <th></th> --}}
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
                                {{-- <td>
                                    <button name="editUser" class="btn btn-info editUser"role="button" data-href="{{ route('user.update',$user->id) }}" role="button" data-toggle="modal" data-id="{{ $idUser =$user->id }}"data-target="#modalAddUser"><i class="fas fa-pencil-alt"></i></button>

                                    <button name="hapusUser" class="btn btn-danger hapusUser" role="button" data-href="{{ route('user.destroy',$user->id) }}" role="button" data-toggle="modal" data-id="{{ $idUser =$user->id }}"data-target="#modalAddUser"><i class="fas fa-trash-alt"></i></button>
                                </td> --}}
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
                        <label class="email">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="email@gmail.com" required>
                        <div class="email invalid-feedback">
                            The password confirmation does not match.
                        </div>
                        <div class="email valid-feedback">
                            Looks good!
                        </div>
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
            var jmlAksi = 0;
            var submitForm = true;
            var cekEmail = false;
            var msgError = "";
            var modalBody = $('#modalAddUser .modal-body').html();
            $('#createUser').click(function () {
                $(idModal+' .modal-body').html(modalBody);
                var url = $(this).data('href');
                var idModal = $(this).data('target');
                var token = $(idModal+' form [name=_token]').val();;
                $(idModal+' .modal-body').html(modalBody);
                $(idModal+' .modal-body').append('@method("POST")');
                $(idModal+' form').attr('action',url);
                $(idModal+' button[type=submit]').html('<i class="fa fa-plus-circle pr-1" aria-hidden="true"></i>Tambah');
                $(idModal+' button[type=submit]').removeClass('btn-info');
                $(idModal+' .modal-header').removeClass('bg-info');
                $(idModal+' button[type=submit]').removeClass('btn-danger');
                $(idModal+' .modal-header').removeClass('bg-danger');
                $(idModal+' #modalAddLabel').text('Tambah User');
                $(idModal+' button[type=submit]').attr('disabled', false);
                validasiEmail(token,idModal);
            });
            $('.hapusUser').click(function () {
                var url = $(this).data('href');
                var iduser = $(this).data('id');
                var idModal = $(this).data('target');
                var userName =[];
                var token =$(idModal+' form [name=_token]').val();
                @foreach ($data as $user)
                    userName[{{ $user->id }}] = "{{ $user->name }}";
                @endforeach
                $(idModal+' form').attr('action',url);
                $(idModal+' button[type=submit]').html('<i class="fas fa-trash-alt pr-1"></i>hapus');
                $(idModal+' button[type=submit]').addClass('btn-danger');
                $(idModal+' .modal-header').addClass('bg-danger');
                $(idModal+' .modal-body').html('<input type="hidden" name="id" value="'+iduser+'"><p>Anda yakin ingin menghapus <b>'+userName[iduser]+'</b> dengan id user <b>'+iduser+'</b></p>');
                $(idModal+' .modal-body').append('@method("DELETE")');
                $(idModal+' #modalAddLabel').text('Hapus User');
                $(idModal+' button[type=submit]').attr('disabled', false);
            });
            $('.editUser').click(function () {
                var url = $(this).data('href');
                var idModal = $(this).data('target');
                var iduser = $(this).data('id');
                var userName =[];
                var userEmail =[];
                var userPass =[];
                var userLevel =[];
                var token =$(idModal+' form [name=_token]').val();;
                @foreach ($data as $user)
                    userName[{{ $user->id }}] = "{{ $user->name }}";
                    userEmail[{{ $user->id }}] = "{{ $user->email }}";
                    userPass[{{ $user->id }}] = "{{ $user->password }}";
                    userLevel[{{ $user->id }}] = "{{ $user->level }}";
                @endforeach
                $(idModal+' .modal-body').html(modalBody);
                $(idModal+' .modal-body').append('@method("PUT")');
                $(idModal+' form').attr('action',url);
                $(idModal+' form').attr('method',"POST");
                $(idModal+' button[type=submit]').html('<i class="fas fa-pencil-alt pr-1"></i>Edit');
                $(idModal+' button[type=submit]').addClass('btn-info');
                $(idModal+' .modal-header').addClass('bg-info');
                $(idModal+' button[type=submit]').removeClass('btn-danger');
                $(idModal+' .modal-header').removeClass('bg-danger');
                $(idModal+' #modalAddLabel').text('Edit User');

                $(idModal+' form [name=nama]').val(userName[iduser]);
                $(idModal+' form [name=email]').val(userEmail[iduser]);
                $(idModal+' form [name=confirmPass]').attr("required",false);
                $(idModal+' form [name=confirmPass]').attr("disabled",true);
                $(idModal+' form [name=password]').val("passwordtetep");
                $(idModal+' form [name=confirmPass]').val("passwordtetep");
                $(idModal+' form [name=level] option[value='+userLevel[iduser]+']').attr("selected",true);
                $(idModal+' form [name=password]').keyup(function(){
                    var valPass = $(this).val();
                    if (valPass=="passwordtetep") {
                        $(idModal+' form [name=confirmPass]').attr("required",false);
                        $(idModal+' form [name=confirmPass]').attr("disabled",true);
                        $(idModal+' form [name=confirmPass]').val("passwordtetep");
                    }else{
                        $(idModal+' form [name=confirmPass]').attr("required",true);
                        $(idModal+' form [name=confirmPass]').val("");
                        $(idModal+' form [name=confirmPass]').attr("disabled",false);
                    }
                });
                $(idModal+' form [name=email]').keyup(function(){
                    var valemail = $(this).val();
                    if (userEmail[iduser]==valemail) {
                        submitForm = true;
                        $(idModal+' form [name=email]').removeClass('is-invalid');
                        $(idModal+' form [name=email]').removeClass('is-valid');
                        msgError = '';
                        $(idModal+' form label.email').text('Email');
                        $(idModal+' button[type=submit]').attr('disabled', false);
                        cekEmail = true;
                    }else{
                        cekEmail = false;
                    }
                });
                $(idModal+' button[type=submit]').attr('disabled', false);
                validasiEmail(token,idModal);
            });
            
            function validasiEmail(token,idModal){
                $(idModal+' form [name=email]').blur(function(){
                    var valemail = $(this).val();
                    if(!cekEmail){
                        $.ajax({
                            type: 'POST',
                            url: '{{ route("cek_emailUser") }}',
                            data: {
                                '_token': token,
                                'email': valemail
                            },
                            dataType: 'json',
                            beforeSend: function() {
                                $(idModal+' button[type=submit]').attr('disabled', true);
                            },
                            success: function(r) {
                                if(r.sts){
                                    $(idModal+' form [name=email]').addClass('is-valid');
                                    $(idModal+' form [name=email]').removeClass('is-invalid');
                                    $(idModal+' div.email.valid-feedback').text(r.msg);
                                    msgError = r.msg;
                                    $(idModal+' button[type=submit]').attr('disabled', false);
                                    submitForm = true;
                                }else{
                                    $(idModal+' form [name=email]').addClass('is-invalid');
                                    $(idModal+' form [name=email]').removeClass('is-valid');
                                    $(idModal+' div.email.invalid-feedback').text(r.msg);
                                    submitForm = false;
                                    msgError = r.msg;
                                }
                            },
                            error:function(e){
                                $(idModal+' button[type=submit]').attr('disabled', false);
                                $(idModal+' form [name=email]').addClass('is-invalid');
                                $(idModal+' div.email.invalid-feedback').text(e.statusText);
                                msgError = 'Maaf server error';
                                console.log(e.statusText);
                            }
                        });
                    }
                });
            }
            
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
                        if(submitForm==false){
                            e.preventDefault();
                            alert(msgError);
                        }
                        jmlAksi=0;
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