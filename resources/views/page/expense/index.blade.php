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
            <h3 class="heading_b uk-margin-bottom">Registro de gastos</h3>
            <div class="md-card">
                <div class="md-card-content">
                    <form action="/expense" method="get" >
                        <div class="uk-grid" data-uk-grid-margin="">
                            <div class="uk-width-medium-5-10">
                                <label for="product_search_name">Buscador</label>
                                <input type="text" class="md-input" value="{{ $search }}" name="search" id="product_search_name">
                            </div>
                            <div class="uk-width-medium-3-10">
                                <div class="uk-margin-small-top">
                                    <select id="product_search_status" name="type" data-md-selectize >
                                        <option @if ('encargado' == $type) selected @endif value="encargado">Encargado</option>
                                        <option @if ('fecha' == $type) selected @endif value="fecha">Fecha</option>
                                        <option @if ('detalle' == $type) selected @endif value="detalle">Detalle</option>
                                        <option @if ('codigo' == $type) selected @endif value="codigo">Codigo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-width-medium-2-10 uk-text-center">
                                <button type="submit" class="md-btn md-btn-primary uk-margin-small-top">Buscar</button>
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
                                            <th>Codigo</th>
                                            <th>Fecha</th>
                                            <th>Encargado</th>
                                            <th>Detalle General</th>
                                            <th>Cantidad Detalle</th>
                                            <th>Total (Bs)</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contenido_table">
                                        @foreach($expense as $value)
                                        <tr class="prueba">
                                            <td>{{ $value->codigo }}</td>
                                            <td>{{ date("d-m-Y",strtotime($value->fecha)) }}</td>
                                            <td>{{ $value->encargado }}</td>
                                            <td>{{ $value->detalle }}</td>
                                            <td align="center">{{ count($value->detailExpense) }}</td>
                                            <td align="center">{{ $detail->where('expense_id',$value->id)->sum('total') }}</td>
                                            <td>
                                                <a href="/detail-expense/{{ $value->id }}"><i class="md-icon material-icons md-36 uk-text-primary">&#xE89C;</i></a>
                                                <a href="/reporte/expense/{{ $value->id }}" target="_blank"><i class="md-icon material-icons md-36 uk-text-warning">&#xE415;</i></a>
                                                <a href="#" onclick="expense.edit({{ $value->id }})" ><i class="md-icon material-icons md-36 uk-text-success">&#xE254;</i></a> 
                                                <a href="/expense/delete/{{ $value->id }}" class="danger" ><i class="md-icon material-icons md-36 uk-text-danger">&#xE872;</i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Fecha</th>
                                            <th>Encargado</th>
                                            <th>Detalle General</th>
                                            <th>Cantidad Detalle</th>
                                            <th>Total (Bs)</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                <center><div class="loading"> </div></center>
                                <span style="display:none" >
                                    {!! $expense->appends(Request::only(['search','type']))->render() !!}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper">
        <a class="md-fab md-fab-accent" href="#create_register" data-uk-modal="{center:true}">
            <i class="material-icons">&#xE145;</i>
        </a>
    </div>

    <div class="uk-modal" id="create_register">
        <div class="uk-modal-dialog">
            <button class="uk-modal-close uk-close" type="button"></button>
            <form action="/expense" method="post" class="uk-form-stacked">
                <h3 >Registrar Formulario de Gasto</h3>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="date">Fecha<span class="req">*</span></label>
                            <input required class="md-input date" type="text" name="fecha" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="miter_start">Encargado<span class="req number_a">*</span></label>
                            <input type="text" name="encargado" required class="md-input clear"/>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <div class="parsley-row">
                            <label for="miter_end">Detalle<span class="req number_a"> *</span></label>
                            <textarea type="text" name="detalle" required class="md-input clear"></textarea>
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <button type="submit" class="md-btn md-btn-primary">Guardar</button>
                        <button type="reset" class="md-btn md-btn-danger">Limpiar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="uk-modal" id="edit_register">
        <div class="uk-modal-dialog">
            <button class="uk-modal-close uk-close" type="button"></button>
            <form onsubmit="return false;" id="form_edit" class="uk-form-stacked">
                <h3 >Editar Formulario de Gasto - <label id="expense_id"></label></h3>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="date">Fecha<span class="req">*</span></label>
                            <input id="fecha" required class="md-input date label-fixed" type="text" name="fecha" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                        </div>
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label for="miter_start">Encargado<span class="req number_a">*</span></label>
                            <input id="encargado" type="text" name="encargado" required class="md-input label-fixed"/>
                        </div>
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        <div class="parsley-row">
                            <label for="miter_end">Detalle<span class="req number_a"> *</span></label>
                            <textarea id="detalle" type="text" name="detalle" required class="md-input label-fixed"></textarea>
                        </div>
                    </div>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-1-1">
                        <button type="button" onclick="expense.update();" class="md-btn md-btn-primary">Guardar</button>
                        <button type="reset" class="md-btn md-btn-danger">Limpiar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ URL::asset('/scripts/master.js') }}"></script>
    <script src="{{ URL::asset('/scripts/expense.js') }}"></script>
    <!-- page specific plugins -->
    <script src="{{ URL::asset('/scripts/jquery.infinitescroll.min.js') }}"></script>

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
    </script>
@endsection