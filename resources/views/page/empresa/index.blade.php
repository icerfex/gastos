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
            <div class="md-card md-card-hover">
                <div class="md-card-head md-bg-blue-600">
                    <div class="uk-text-center">
                        <img class="md-card-head-avatar" src="image/nextsofts.jpg" alt="">
                    </div>
                    <h3 class="md-card-head-text uk-text-center md-color-white">
                        NEXSOFTS GLOBAL CORPORATION                                
                    </h3>
                </div>
                <div class="md-card-content">
                    <ul class="md-list">
                        <li>
                            <div class="md-list-content">
                                <span class="md-list-heading">Detalle de la empresa</span>
                                <span class="uk-text-small uk-text-muted">Desarrollo de Software</span>
                                <span class="uk-text-small uk-text-muted">Gerente General: C. Giovanni Cespedes Alcocer</span>
                                <span class="uk-text-small uk-text-muted">Teléfono: 70354495</span>
                                <span class="uk-text-small uk-text-muted">Dirección: Av. Chapare Nro. SN Barrio Chacacollo</span>
                            </div>
                        </li>
                        
                        <li>
                            <div class="md-list-content">
                                <span class="md-list-heading">Descripción</span>
                                <span class="uk-text-small uk-text-muted">Empresa de software dedicada a la gestión economica y monetaria de la empresas, creando un sistema de mejora continua y de calidad para la toma de decisiones seguras que lleve a su empresa a lograr sus objetivos.</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
                      