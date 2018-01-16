@extends('layouts.app')
@section('body')
top_menu
@stop
@section('content')
    <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-width-medium-8-10 uk-container-center">
                <div class="md-card md-card-single">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="md-icon material-icons" id="toggleAll">&#xe8f2;</i>
                        </div>
                        <h3 class="md-card-toolbar-heading-text large">
                            Política de Privacidad y terminos NextSofts
                        </h3>
                    </div>
                    <div class="md-card-content padding-reset">
                        <h4 class="heading_c full_width_in_card">Política de Privacidad</h4>
                        <div class="uk-accordion uk-accordion-alt hierarchical_slide help_accordion" data-slide-children="h3" data-slide-context=".md-card-content">
                            <h3 class="uk-accordion-title">Privacidad.</h3>
                            <div class="uk-accordion-content">
                                <p>La privacidad de los usuarios es muy importante para NextSofts Global Corporation. Estamos comprometidos a salvaguardar la información que los Usuarios que confían a Nextsofts.</p>
                            </div>
                        </div>
                        <h4 class="heading_c full_width_in_card">Términos del Servicio y Política de Uso Aceptable de Hostinger.es</h4>
                        <div class="uk-accordion uk-accordion-alt hierarchical_slide help_accordion" data-slide-children="h3" data-slide-context=".md-card-content">
                            <h3 class="uk-accordion-title">Las reglas más importantes son:</h3>
                            <div class="uk-accordion-content">
                                <p>
                                    <ol>
                                        <li>
                                            No está permitido realizar modificaciones en la aplicación.
                                        </li>
                                        <li>
                                            No está permitido negociar la aplicación.
                                        </li>
                                        <li>
                                            Prohibido la reproducción de la aplicación.
                                        </li>
                                    </ol>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@stop
@section('scripts')
    <script src="{{ URL::asset('/assets/js/page_help.min.js') }}"></script>
@endsection