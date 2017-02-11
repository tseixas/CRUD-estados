@extends('welcome')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box-body">
                <form role="form" method="post" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{ $data->nome }}">
                            </div>
                        </div>

                        <div class="col-xs-1">
                            <div class="form-group">
                                <label>Sigla</label>
                                <input type="text" class="form-control" id="sigla" name="sigla" maxlength="2" value="{{ $data->sigla }}">
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="form-group">
                                <label>Capital</label>
                                <input type="text" class="form-control" id="capital" name="capital"  value="{{ $data->capital }}">
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
                                        <option selected="{{ $data->regiao }}">
                                            {{ $data->regiao }}
                                        </option>
                                        <?php
                                        foreach($regiao as $r){
                                            if($data->regiao != $r){
                                        ?>
                                        <option><?php echo $r; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- editor -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="box-title">Histórico</h3>
                            </div>
                            <div class="box-body pad">
                                <textarea id="editor1" name="editor1" rows="10" cols="80">{{ $data->historico }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- button -->
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <button type="reset" class="btn btn-default">
                                <i class="fa fa-times margin-r-5"></i>
                                CANCELAR
                            </button>
                        </div>
                        <div class="col-xs-6 text-center">
                            <button type="button" class="btn btn-primary" id="cadastrar" name="cadastrar" onclick="editarEstado()">
                                <i class="fa fa-plus margin-r-5"></i>
                                ATUALIZAR
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection

<script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    function editarEstado() {
        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:'POST',
            url:{{$data->id}},
            data: {
                _token: CSRF_TOKEN,
                nome: $('#nome').val(),
                sigla: $('#sigla').val(),
                capital: $('#capital').val(),
                bandeira: $('#bandeira').val(),
                regiao: $('#regiao').val(),
                historico: $('#editor1').val()
            },
            success: function (data) {
                console.log('Atualizado: ',data);
                location.reload();
            },
            error: function (data) {
                console.log('Falha ao atualizar: ', data);
            }
        });
    }
</script>