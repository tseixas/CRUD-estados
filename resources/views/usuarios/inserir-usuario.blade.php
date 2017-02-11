@extends('welcome')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box-body">
                 <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Usuário</h3>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('fail'))
                            <div class="alert alert-warning alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        @if(Auth::user()->perfil == 'user_admin')
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">
                            <i class="fa fa-plus"></i>
                        </button>
                        @endif

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Perfil</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usuario as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>{{ $d->perfil }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="fun_edit('{{$d -> id}}')">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        @if(Auth::user()->perfil == 'user_admin')
                                        <button class="btn btn-danger" onclick="fun_delete('{{$d -> id}}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('usuario/view')}}">
                        <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{url('usuario/delete')}}">

                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="container">
                    <!-- Add Modal start -->
                    <div class="modal fade" id="addModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Adicionar Usuário</h4>
                                </div>

                                <form action="{{ url('usuario/register') }}" method="post">
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Nome:</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">E-mail:</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Senha:</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirmar Senha:</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirma_senha">Perfil:</label>
                                            <div class="form-group">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadios" id="user_normal" value="user_normal" checked="">
                                                        Normal
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadios" id="user_admin" value="user_admin">
                                                        Administrador
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-info pull-left" data-dismiss="modal">FECHAR</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-primary">ADICIONAR</button>
                                        </div>
                                    </div>
                                </div>
                                </form>

                            </div>

                        </div>
                    </div>
                    <!-- add code ends -->

                    <!-- Edit Modal start -->
                    <div class="modal fade" id="editModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar</h4>
                                </div>
                                <form action="{{ url('usuario/update') }}" method="post">
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        <div class="form-group">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="edit_name">Nome:</label>
                                                        <input type="text" class="form-control" id="edit_name" name="edit_name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="edit_email">E-mail:</label>
                                                        <input type="email" class="form-control" id="edit_email" name="edit_email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_perfil">Perfil:</label>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="edit_perfil" name="edit_perfil">
                                                    <select class="form-control" id="edit_perfil" name="edit_perfil">
                                                        <option>--</option>
                                                        <option name="sel" id="sel" selected="sel"></option>
                                                        <option name="opt1" id="opt1"></option>
                                                        <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
                                                        <script>
                                                            function check() {
                                                                var valor = $('#edit_perfil').val();
                                                                if (!valor) {
                                                                    return setTimeout(check, 1000);
                                                                }
                                                                $('#sel').text(valor);
                                                                var regiao = ['user_normal', 'user_admin'];
                                                                var selec = [];
                                                                for (var i=0; i<=regiao.length; i++) {
                                                                    if(regiao[i] != valor){
                                                                        selec.push(regiao[i]);
                                                                    }
                                                                }
                                                                $('#opt1').text(selec[0]);
                                                            }

                                                            check();
                                                        </script>
                                                    </select>
                                                    <!--
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="edit_perfil" id="edit_perfil" data-val="user_normal" value="user_normal">
                                                            Normal
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="edit_perfil" id="edit_perfil" data-val="user_admin" value="user_admin">
                                                            Administrador
                                                        </label>
                                                    </div>
                                                    -->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <button type="button" class="btn btn-info pull-left" data-dismiss="modal">FECHAR</button>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="hidden" id="edit_id" name="edit_id">
                                                <button type="submit" class="btn btn-primary">ATUALIZAR</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit code ends -->
                </div>

            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection

<script type="text/javascript">
    function fun_edit(id) {
        var view_url = $("#hidden_view").val();
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                $("#edit_id").val(result.id);
                $("#edit_name").val(result.name);
                $("#edit_email").val(result.email);
                $("#edit_perfil").val(result.perfil);

                /*$("input[data-val]").val(function(){
                    if($(this).data('val') == result.perfil){
                        $(this).prop("checked", true);
                    }
                });*/

            }
        });
    }

    function fun_delete(id) {
        var conf = confirm("Deseja remover?");
        if(conf){
            var delete_url = $("#hidden_delete").val();
            $.ajax({
                url: delete_url,
                type:"POST",
                data: {"id":id,_token: "{{ csrf_token() }}"},
                success: function(response){
                    alert(response);
                    location.reload();
                }
            });
        }
        else{
            return false;
        }
    }
</script>