@extends('welcome')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box-body">
                <!--
                <form role="form" action="" method="post" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome">
                            </div>
                        </div>

                        <div class="col-xs-1">
                            <div class="form-group">
                                <label>Sigla</label>
                                <input type="text" class="form-control" id="sigla" name="sigla" maxlength="2">
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Capital</label>
                                <input type="text" class="form-control" id="capital" name="capital">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xs-5">
                            <div class="form-group">
                                <label>Bandeira</label>
                                <input type="file" class="form-control" id="bandeira" name="bandeira" accept="image/*">
                            </div>
                        </div>


                        <div class="col-xs-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Região</label>
                                    <select class="form-control" id="regiao" name="regiao">
                                        <option>--</option>
                                        <option>Norte</option>
                                        <option>Nordeste</option>
                                        <option>Centro-Oeste</option>
                                        <option>Sudeste</option>
                                        <option>Sul</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="box-title">Histórico</h3>
                            </div>
                            <div class="box-body pad">
                                <textarea id="editor1" name="editor1" rows="10" cols="80"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <button type="reset" class="btn btn-default">
                                <i class="fa fa-times margin-r-5"></i>
                                CANCELAR
                            </button>
                        </div>
                        <div class="col-xs-6 text-center">
                            <button type="button" class="btn btn-primary" id="cadastrar" name="cadastrar" onclick="send()">
                                <i class="fa fa-plus margin-r-5"></i>
                                CADASTRAR
                            </button>
                        </div>
                    </div>

                </form>
                -->
                 <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Estados</h3>
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
                                <th>Estado</th>
                                <th>Sigla</th>
                                <th>Capital</th>
                                <th>Região</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($estado as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->nome }}</td>
                                    <td>{{ $d->sigla }}</td>
                                    <td>{{ $d->capital }}</td>
                                    <td>{{ $d->regiao }}</td>
                                    <td>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="fun_view('{{$d -> id}}')">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        @if(Auth::user()->perfil == 'user_admin' )
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-backdrop="static" data-keyboard="false" onclick="fun_edit('{{$d -> id}}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" onclick="fun_delete('{{$d -> id}}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                         @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('estado/view')}}">
                        <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{url('estado/delete')}}">

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
                                    <h4 class="modal-title">Adicionar Estado</h4>
                                </div>
                                <form action="{{ url('estado') }}" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="nome">Nome:</label>
                                                    <input type="text" class="form-control" id="nome" name="nome">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="sigla">Sigla:</label>
                                                    <input type="text" class="form-control" id="sigla" name="sigla" maxlength="2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="capital">Capital:</label>
                                            <input type="text" class="form-control" id="capital" name="capital">
                                        </div>
                                        <div class="form-group">
                                            <label for="bandeira">Bandeira:</label>
                                            <input type="file" class="form-control" id="bandeira" name="bandeira">
                                        </div>
                                        <div class="form-group">
                                            <label for="regiao">Região:</label>
                                            <!--<input type="text" class="form-control" id="regiao" name="regiao">-->
                                            <select class="form-control" id="regiao" name="regiao">
                                                <option>--</option>
                                                <option>Norte</option>
                                                <option>Nordeste</option>
                                                <option>Centro-Oeste</option>
                                                <option>Sudeste</option>
                                                <option>Sul</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="descricao">Descrição:</label>
                                            <!--<input type="text" class="form-control" id="descricao" name="descricao">-->
                                            <textarea id="descricao" name="descricao" rows="10" cols="80"></textarea>
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

                    <!-- View Modal start -->
                    <div class="modal fade" id="viewModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Visualizar</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p><b>Estado : </b><span id="view_nome" class="text-success"></span></p>
                                        </div>
                                        <div class="col-sm-3">
                                            <p><b>Capital : </b><span id="view_capital" class="text-success"></span></p>
                                        </div>
                                        <div class="col-sm-2">
                                            <p><b>Sigla : </b><span id="view_sigla" class="text-success"></span></p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p><b>Região : </b><span id="view_regiao" class="text-success"></span></p>
                                        </div>
                                    </div>
                                    <p><b>Bandeira : </b><img src="" id="view_bandeira" class="img-responsive pad"></p>
                                    <p><b>Descricao : </b><span id="view_descricao" class="text-success"></span></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info pull-left" data-dismiss="modal">FECHAR</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- view modal ends -->

                    <!-- Edit Modal start -->
                    <div class="modal fade" id="editModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar</h4>
                                </div>
                                <form action="{{ url('estado/update') }}" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        <div class="form-group">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="edit_nome">Nome:</label>
                                                        <input type="text" class="form-control" id="edit_nome" name="edit_nome">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="edit_sigla">Sigla:</label>
                                                        <input type="text" class="form-control" id="edit_sigla" name="edit_sigla" maxlength="2">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="edit_capital">Capital:</label>
                                                <input type="text" class="form-control" id="edit_capital" name="edit_capital">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_bandeira">Bandeira:</label>
                                                <img src="" id="edit_bandeira" class="img-responsive pad">
                                                <input type="file" class="form-control" id="edit_bandeira" name="edit_bandeira">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_regiao">Região:</label>
                                                <input type="hidden" class="form-control" id="edit_regiao" name="edit_regiao">
                                                <select class="form-control" id="edit_regiao" name="edit_regiao">
                                                    <option>--</option>
                                                    <option name="sel" id="sel" selected="sel"></option>
                                                    <option name="opt1" id="opt1"></option>
                                                    <option name="opt2" id="opt2"></option>
                                                    <option name="opt3" id="opt3"></option>
                                                    <option name="opt4" id="opt4"></option>
                                                    <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
                                                    <script>
                                                        function check() {
                                                            var valor = $('#edit_regiao').val();
                                                            if (!valor) {
                                                                return setTimeout(check, 1000);
                                                            }
                                                            $('#sel').text(valor);
                                                            var regiao = ['Norte','Nordeste', 'Centro-Oeste', 'Sudeste', 'Sul'];
                                                            var selec = [];
                                                            for (var i=0; i<=regiao.length; i++) {
                                                                if(regiao[i] != valor){
                                                                    selec.push(regiao[i]);
                                                                }
                                                            }
                                                            $('#opt1').text(selec[0]);
                                                            $('#opt2').text(selec[1]);
                                                            $('#opt3').text(selec[2]);
                                                            $('#opt4').text(selec[3]);
                                                        }

                                                        check();
                                                    </script>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_descricao">Descrição:</label>
                                                <textarea id="edit_descricao" name="edit_descricao" rows="10" cols="80"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <button type="button" class="btn btn-info pull-left" data-dismiss="modal" onclick="location.reload();">FECHAR</button>
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
    function fun_view(id) {
        var view_url = $("#hidden_view").val();
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                $("#view_nome").text(result.nome);
                $("#view_capital").text(result.capital);
                $("#view_sigla").text(result.sigla);
                $("#view_regiao").text(result.regiao);
                document.getElementById("view_bandeira").src = result.bandeira;
                //$("#view_bandeira").text(result.bandeira);
                $("#view_descricao").html(result.descricao).text();
            }
        });
    }

    function fun_edit(id) {
        var view_url = $("#hidden_view").val();
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                console.log(result);
                $("#edit_id").val(result.id);
                $("#edit_nome").val(result.nome);
                $("#edit_capital").val(result.capital);
                $("#edit_sigla").val(result.sigla);
                $("#edit_regiao").val(result.regiao);
                document.getElementById("edit_bandeira").src = result.bandeira;
                $("#edit_descricao").val(result.descricao);
            }
        });
    }

    function fun_delete(id) {
        var conf = confirm("Deseja remover?");
        if(conf){
            var delete_url = $("#hidden_delete").val();
            console.log(delete_url, id);
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