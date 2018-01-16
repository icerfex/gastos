@extends('layouts.app')
@section('body')
top_menu
@stop
@section('styles')
    <style type="text/css">
        .selectize-dropdown {z-index: 1305;}
        .uk-dropdown{ z-index:2000; }
        $('a.media').media({width:500, height:400});
    </style>
@endsection
@section('content') 
    <div id="page_content">
        <div id="page_content_inner">
            <h3 class="heading_b uk-margin-bottom">Detalle de gasto, Codigo: {{ $expense->codigo }}</h3>
            <p>Detalle general: {{ $expense->detalle }}</p>
            <p>Fecha: {{ date("d-m-Y",strtotime($expense->fecha)) }}</p>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <form action="/detail-expense/{{ $id }}" method="post" class="uk-form-stacked">
                        <h3 >Registrar detalle de Gastos</h3>
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="date">Cuenta<span class="req"> *</span></label>
                                    <input type="text" name="cuenta" required class="md-input date" autofocus>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <label for="miter_start">Total<span class="req"> *</span></label>
                                    <input type="text" name="total" required class="md-input total"/>
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-1">
                                <div class="parsley-row">
                                    <label for="miter_end">Detalle<span class="req"> *</span></label>
                                    <textarea type="text" name="detalle" required class="md-input clear"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                <button type="submit" class="md-btn md-btn-primary">Guardar</button>
                                <button type="reset" class="md-btn md-btn-danger">Limpiar</button>
                                <a href="/reporte/expense/{{ $expense->id }}" target="_blank" ><i class="md-icon material-icons md-36 uk-text-warning">&#xE415;</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-grid uk-grid-width-medium-1-1" >
                        <div class="uk-width-1-1">
                        @if (count($errors) > 0)
                            <div class="uk-alert uk-alert-danger" data-uk-alert>
                                <a href="#" class="uk-alert-close uk-close"></a>
                                @foreach ($errors->all() as $error)
                                 {{ $error }}
                                @endforeach
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.
                            </div>
                        @endif
                        @if (session()->has('message'))
                            <div class="uk-alert uk-alert-success" data-uk-alert>
                                <a href="#" class="uk-alert-close uk-close"></a>
                                {!! session('message') !!}
                            </div>
                        @endif
                            <div>
                                <table id="register_table" class="uk-table demo_table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nro</th>
                                            <th>Cuenta</th>
                                            <th>Detalle</th>
                                            <th>Total (Bs)</th>
                                            <th>Acumulado (Bs)</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contenido_table">
                                        <div style="display: none;">{{ $total=0 }}</div>
                                        @foreach($detail as $value)
                                        <tr class="prueba">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->cuenta }}</td>
                                            <td>{{ $value->detalle }}</td>
                                            <td>{{ $value->total }}</td>
                                            <td>{{ $total = $value->total + $total }}</td>
                                            <td>
                                                <a href="#" onclick="detail.edit({{ $id }},{{ $value->id }})" ><i class="md-icon material-icons md-36 uk-text-primary">&#xE254;</i></a> 
                                                <a href="{{ action('DetailExpenseController@destroy', ['expense_id'=>$id,'id' => $value->id]) }}" ><i class="md-icon material-icons md-36 uk-text-danger">&#xE872;</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nro</th>
                                            <th>Cuenta</th>
                                            <th>Detalle</th>
                                            <th>{{ $total }}</th>
                                            <th>{{ $total }}</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <center><div class="loading"> </div></center>
                                <span style="display:none" >
                                    
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-accent" href="/expense">
            <i class="material-icons">&#xE166;</i>
        </a>
    </div>

    <div class="uk-modal" id="edit_register">
        <div class="uk-modal-dialog">
            <button class="uk-modal-close uk-close" type="button"></button>
            <form onsubmit="return false;" id="form_edit" class="uk-form-stacked">
                <h3 >Editar Formulario Detalle Gasto - <label id="detail_id"></label></h3>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="cuenta">Cuenta<span class="req">*</span></label>
                            <input id="cuenta" type="text" name="cuenta" required class="md-input date label-fixed" >
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="total">Total<span class="req">*</span></label>
                            <input id="total" type="text" name="total" required class="md-input label-fixed"/>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <div class="parsley-row">
                            <label for="detalle">Detalle<span class="req"> *</span></label>
                            <textarea id="detalle" type="text" name="detalle" required class="md-input label-fixed"></textarea>
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <button type="button" onclick="detail.update({{ $id }});" class="md-btn md-btn-primary">Guardar</button>
                        <button type="reset" class="md-btn md-btn-danger">Limpiar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ URL::asset('/scripts/master.js') }}"></script>
    <script src="{{ URL::asset('/scripts/detail.js') }}"></script>
    <!-- page specific plugins -->
    <script src="{{ URL::asset('/scripts/jquery.infinitescroll.min.js') }}"></script>

    <script src="{{ URL::asset('/bower_components/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>

    <script>
        $('#contenido_table').infinitescroll({
            navSelector  : "ul.pagination",
            nextSelector : "ul.pagination li:last-child a",
            itemSelector : "#contenido_table tr.prueba",
            loading: {
                finished: undefined,
                finishedMsg: "No se encontraron mas mensajes para mostrar",
                img: "/assets/img/spinners/spinner_medium.gif",
                msg: null,
                msgText: "Cargando...",
                selector: ".loading",
                speed: 'slow',//'fast',
                start: undefined
            }
        });

        $(".total").inputmask("decimal",{
            radixPoint:".", 
            digits: 2,
            autoUnmask: true,
            rightAlign: false
            //rightAlignNumerics: false
        });    
    </script>
@endsection