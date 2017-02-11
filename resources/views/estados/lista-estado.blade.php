@extends('welcome')

@section('content')
    <section class="content">
        <div class="row">

            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Estados</h3>
                    </div>
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            @foreach($estado as $d)
                            <li class="item">
                                <div class="product-img">
                                    <img src="{{asset("/images/". $d->bandeira )}}" alt="Product Image">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">{{ $d->nome }} - {{ $d->sigla }}
                                        <span class="product-description">
                                            <?php echo htmlspecialchars_decode(stripslashes($d->descricao)); ?>
                                        </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{ url('estado/') }}" class="uppercase">Ver todos</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Usuários</h3>
                        <div class="box-tools pull-right">
                            <span class="label label-danger">{{ $user->count() }} Total</span>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            @foreach($user as $u)
                                <li>
                                    <a class="users-list-name" href="#">{{ $u->name }}</a>
                                    <span class="users-list-date">{{ $u->perfil }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{ url('usuario/') }}" class="uppercase">Ver todos</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>

        </div>
    </section>
@endsection

<script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>

    function deleteEstado(id){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:'DELETE',
            url:'deleteEstado/'+id,
            data: {
                _token: CSRF_TOKEN,
                id: id
            },
            success: function (data) {
                console.log('deletado: ',data);
                location.reload();
            },
            error: function (data) {
                console.log('Falha: ', data);
            }
        });
    }

</script>