@extends('layouts.app')
@section('title')
    Fumigaciones
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar Servicio de Fumigación</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-danger" href="{{ route('fumigaciones.show', $unidad) }}">Regresar</a>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{ route('fumigaciones.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    {{-- ================ DATOS OCULTOS ================ --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12" hidden>
                                        <div class="form-group">
                                            <label for="proxima_fumigacion">Proxima Fumigación</label>
                                            <input type="text" name="proxima_fumigacion" class="form-control"
                                                value="0">
                                        </div>
                                    </div>
                                    {{-- ================================================ --}}
                                    <h4 class="form-check-label">Tipo de Folio</h4>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo" id="manual"
                                                value="">
                                            <label class="form-check-label" for="manual">
                                                Folio Manual
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo" id="automatico"
                                                value="">
                                            <label class="form-check-label" for="automatico">
                                                Folio Automatico
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form no_mostrar" id="MostrarManual">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="numerofumigacion">Folio De Fumigación</label>
                                                <select id="FolioA" name="numerofumigacion" class="form-select form-select-sm mb-3"
                                                    aria-label=".form-select-sm example" onchange="toggleButton_2()">
                                                    <option disabled selected value="">SELECCIONA UN FOLIO</option>
                                                    @foreach ($folios as $folio)
                                                        @php
                                                            $string = $folio->folio;
                                                            $inicio = preg_replace('/[^0-9]/', '', $string);
                                                            $string_2 = $folio->rango;
                                                            $final = preg_replace('/[^0-9]/', '', $string_2);
                                                            $fin = (int) $final;
                                                            $numeros = (int) $inicio + (int) $folio->contador;
                                                        @endphp
                                                        @if ($fin == $numeros)
                                                        @else
                                                            @if ($fin >= $numeros)
                                                                <option value="{{ $folio->id }}">{{ $numeros }}
                                                                </option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form no_mostrar" id="MostrarAutomatico">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="numerofumigacion">Folio De Fumigación</label>
                                                <input id="FolioM" type="text" name="numerofumigacion"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- MOSTRAR SI ES V O H --}}
                                    @if ($tipo == 'Unidad Habitacional o Comercial')
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="unidad">Unidad Habitacional</label>
                                                <input type="text" name="unidad" class="form-control"
                                                    value="{{ $unidad }}" readonly="readonly">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($tipo == 'Unidad Vehicular')
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="unidad">Unidad Vehicular</label>
                                                <input type="text" name="unidad" class="form-control"
                                                    value="{{ $unidad }}" readonly="readonly">
                                            </div>
                                        </div>
                                    @endif
                                    {{--  --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Unidad Perteneciente al Cliente:</label>
                                            <input type="text" class="form-control" value="{{ $pcliente }}"
                                                readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Cliente Con Domicilio de:</label>
                                            <input type="text" class="form-control" value="{{ $direccion }}"
                                                readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechaultimafumigacion">Fecha ultima fumigacion</label>
                                            <input type="text" name="fechaultimafumigacion" class="form-control"
                                                value="{{ $fumigacion }}" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="id_fumigador">Fumigador</label>
                                            <select name="id_fumigador" id="id_fumigador" class=" selectsearch">
                                                <option disabled selected value="">Selecciona el Fumigador</option>
                                                @foreach ($fumigadores as $fumigadore)
                                                    <option value="{{ $fumigadore->nombrecompleto }}">
                                                        {{ $fumigadore->nombrecompleto }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @php
                                        /* FECHA ACTUAL */
                                        $fecha_actual = date('Y-n-d');
                                    @endphp
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechaprogramada">Fecha de Servicio</label>
                                            <input type="datetime-local" name="fechaprogramada" class="form-control"
                                                min="{{ date('Y-n-d') }}">
                                        </div>
                                    </div>
                                    {{-- MOSTRAR SI ES V O H --}}
                                    @if ($tipo == 'Unidad Habitacional o Comercial')
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="lugardelservicio">Lugar de Servicio</label>
                                                <input type="text" name="lugardelservicio" class="form-control"
                                                    readonly="readonly" value='{{ $lugar }}'>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($tipo == 'Unidad Vehicular')
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label for="lugardelservicio">Lugar de Servicio</label>
                                                <input type="text" name="lugardelservicio" class="form-control"
                                                    readonly="readonly" value='Centro Fumigador'>
                                            </div>
                                        </div>
                                    @endif
                                    {{--  --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="tipo">Tipo</label>
                                            <input type="text" name="tipo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="numerodevisitas">Numero de Visitas</label>
                                            <input type="text" name="numerodevisitas" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="costo">Costo</label>
                                            <input type="text" name="costo" class="form-control" value="$">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="producto">Producto Utilizado</label>
                                            <select name="producto" id="producto" class=" selectsearch">
                                                <option disabled selected value="">SELECCIONA UN PRODUCTO</option>
                                                <option value="CYNOFF 40 PH">CYNOFF 40 PH</option>
                                                <option value="BIOTRINE FLOW">BIOTRINE FLOW</option>
                                                <option value="BIOTRINE C.E.">BIOTRINE C.E.</option>
                                                <option value="ELEGY">ELEGY</option>
                                                <option value="TERMIDOR">TERMIDOR</option>
                                                <option value="TEMRPID SC">TEMRPID SC</option>
                                                <option value="TYSON2E">TYSON2E</option>
                                                <option value="DDVP 500">DDVP 500</option>
                                                <option value="SIEGE">SIEGE</option>
                                                <option value="MAXFORCE">MAXFORCE</option>
                                                <option value="TALÓN BLOQUE">TALÓN BLOQUE</option>
                                                <option value="STORM">STORM</option>
                                                <option value="ARMA">ARMA</option>
                                                <option value="RODILON BLOQUE">RODILON BLOQUE</option>
                                                <option value="DIFARAT">DIFARAT</option>
                                                <option value="C-REALB">C-REALB</option>
                                                <option value="BETA QUAT 4">BETA QUAT 4</option>
                                                <option value="VIRTUAL">VIRTUAL</option>
                                                <option value="SAVAGE">SAVAGE</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- \\\\\\\\\\\ valor no PLAGAS \\\\\\\\\\\ --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12 card-deck" hidden>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="insectosvoladores" name="insectosvoladores">
                                                <label class="form-check-label" for="insectosvoladores">
                                                    Insectos Voladores
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="insectosrastreros" name="insectosrastreros">
                                                <label class="form-check-label" for="insectosrastreros">
                                                    Insectos Rastreros
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="cucaracha" name="cucaracha">
                                                <label class="form-check-label" for="cucaracha">
                                                    Cucaracha (Ger/Ori/Ame)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="pulgas" name="pulgas">
                                                <label class="form-check-label" for="pulgas">
                                                    Pulgas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="mosca" name="mosca">
                                                <label class="form-check-label" for="mosca">
                                                    Mosca
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="chinches" name="chinches">
                                                <label class="form-check-label" for="chinches">
                                                    Chinches
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="aracnidos" name="aracnidos">
                                                <label class="form-check-label" for="aracnidos">
                                                    Aracnidos
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="hormigas" name="hormigas">
                                                <label class="form-check-label" for="hormigas">
                                                    Hormigas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="termitas" name="termitas">
                                                <label class="form-check-label" for="termitas">
                                                    Termitas
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="roedores" name="roedores">
                                                <label class="form-check-label" for="roedores">
                                                    Roedores
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="alacranes" name="alacranes">
                                                <label class="form-check-label" for="alacranes">
                                                    Alacranes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    id="carcamo" name="carcamo">
                                                <label class="form-check-label" for="carcamo">
                                                    Carcamo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  --}}
                                    {{-- \\\\\\\\\\\ PLAGAS \\\\\\\\\\\ --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12 card-deck">
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="insectosvoladores" name="insectosvoladores">
                                                <label class="form-check-label" for="insectosvoladores">
                                                    Insectos Voladores
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="insectosrastreros" name="insectosrastreros">
                                                <label class="form-check-label" for="insectosrastreros">
                                                    Insectos Rastreros
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="cucaracha" name="cucaracha">
                                                <label class="form-check-label" for="cucaracha">
                                                    Cucaracha (Ger/Ori/Ame)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="pulgas" name="pulgas">
                                                <label class="form-check-label" for="pulgas">
                                                    Pulgas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="mosca" name="mosca">
                                                <label class="form-check-label" for="mosca">
                                                    Mosca
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="chinches" name="chinches">
                                                <label class="form-check-label" for="chinches">
                                                    Chinches
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="aracnidos" name="aracnidos">
                                                <label class="form-check-label" for="aracnidos">
                                                    Aracnidos
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="hormigas" name="hormigas">
                                                <label class="form-check-label" for="hormigas">
                                                    Hormigas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="termitas" name="termitas">
                                                <label class="form-check-label" for="termitas">
                                                    Termitas
                                                </label>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="roedores" name="roedores">
                                                <label class="form-check-label" for="roedores">
                                                    Roedores
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="alacranes" name="alacranes">
                                                <label class="form-check-label" for="alacranes">
                                                    Alacranes
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Si"
                                                    id="carcamo" name="carcamo">
                                                <label class="form-check-label" for="carcamo">
                                                    Carcamo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  --}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class=" selectsearch">
                                                <option disabled value="" selected>Selecciona un Status</option>
                                                <option value="Realizado">Realizado</option>
                                                <option value="Cancelado">Cancelado</option>
                                                <option value="Reprogramado">Reprogramado</option>
                                                <option value="Pendiente">Pendiente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea name="observaciones" id="observaciones" class="form-control" rows="7"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        //----------------------------------------- MOSTRAR TIPO DE UNIDAD -----------------------------------------
        var manual = document.getElementById('MostrarManual');
        document.getElementById('manual').addEventListener('click', function(e) {
            manual.style.display = 'none';
        });
        document.getElementById('automatico').addEventListener('click', function(e) {
            manual.style.display = 'inline';
        });
        /* llllllllllllllllllllllllllllllllllllllllllllllllllll */
        var automatico = document.getElementById('MostrarAutomatico');
        document.getElementById('manual').addEventListener('click', function(e) {
            automatico.style.display = 'inline';
        });
        document.getElementById('automatico').addEventListener('click', function(e) {
            automatico.style.display = 'none';
        });
        //----------------------------------------- MOSTRAR TIPO DE UNIDAD -----------------------------------------
        $(function() {
            $(document).on('change', '#FolioA', function() {
                var value = $(this).val();
                $('#FolioM').val(value);
            });
        });
        /* llllllllllllllllllllllllllllllllllllllllllllllllllll */
    </script>
@endsection
