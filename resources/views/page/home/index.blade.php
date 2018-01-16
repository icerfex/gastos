@extends('layouts.app')
@section('body')
top_menu
@stop
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <h3 class="heading_b uk-margin-bottom">Opciones</h3>
            <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-5 uk-text-center " id="dashboard_sortable_cards" data-uk-grid-margin>
                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <a href="/expense"> 
                            <div class="md-card-content">
                                <div class="epc_chart">
                                    <span class="epc_chart_icon"><i class="material-icons uk-text-success">&#xE870;</i></span>
                                </div>
                            </div>
                        </a>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                            <i class="md-icon material-iconsmd-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Gastos
                                </h3>
                            </div>
                            Aplicación para el control de los gastos por actividades o mensuales.
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <a href="/business"> 
                            <div class="md-card-content">
                                <div class="epc_chart">
                                    <span class="epc_chart_icon"><i class="material-icons uk-text-primary">&#xE0AF;</i></span>
                                </div>
                            </div>
                        </a>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Empresas
                                </h3>
                            </div>
                            Datos de la empresa.
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <a href="/policies"> 
                            <div class="md-card-content">
                                <div class="epc_chart">
                                    <span class="epc_chart_icon"><i class="material-icons">&#xE86D;</i></span>
                                </div>
                            </div>
                        </a>
                        <div class="md-card-overlay-content">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Políticas
                                </h3>
                            </div>
                            Condiciones y politicas de uso del software.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{ URL::asset('/scripts/master.js') }}"></script>
    <script src="{{ URL::asset('/scripts/expense.js') }}"></script>
@stop