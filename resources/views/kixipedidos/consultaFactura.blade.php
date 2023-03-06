
@extends('layouts.inicio')
@section('content1')
    <section class="section dashboard" style="margin-top:100px">
        <div class="row" style="margin-left:15%; margin-top: 50px">
            <div class="col-lg-12" style="padding-left: 50px; padding-right: 50px">
                <div class="card">
                    <div class="card"  style="background:#005c3c;  color:#fff; font-weight: bold;" aria-current="true">
                        <div ><h2>Geracção de Hash/Factura</h2></div>
                    </div>
                        <div class="col-lg-12">
                            <form id="formFiltroPeriodo" >
                                <div class="row">
                                    <div class="col-2" style="padding-left: 30px">
                                        <label for="sector" class="label mr-1">Data Inicial</label>
                                        <input name="dataInicio" value="{{ date('Y') . '-' . date('m') . '-' . date('d') }}"
                                            id="dataInicio" type="date" class="form-control" required>
                                    </div>
                                    <div class="col-2">
                                        <label class="label mr-1" for="ano">Data Final</label>
                                        <input name="dataFim" value="{{ date('Y') . '-' . date('m') . '-' . date('d') }}"
                                            id="dataFim" type="date" class="form-control" required>
                                    </div>
                                    <div class="col-2" style="margin-top: 27px;">
                                        <button type="submit" class="btn btn-primary mb-2" id="btnSubmeterFiltro" onclick="processarFactura()"><i class="bi bi-search"></i> Submeter</button>
                                    </div>
                                </div>
                               
                            </form>
                            <div id="loadinDiv"></div>
                            <div id="message" class="d-none">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Holy guacamole!</strong> As datas que inseriu não estão como esperado. A data
                                    inicio deve sempre ser menor que a data de Fim.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div id="resumoFiltro" class="d-none">
                                <table class="table table-sm">
                                    <tr>
                                        <th>Total de Registos:</th>
                                        <td id="totalRegistos"></td>
                                    </tr>
                                    <tr>
                                        <th>Data Inicio:</th>
                                        <td id="dataInicioResultado"></td>
                                    </tr>
                                    <tr>
                                        <th>Data Fim:</th>
                                        <td id="dataFimResultado"></td>
                                    </tr>
                                </table>
                                <div class="text-center">
                                    <button class="btn btn-primary" id="btnGerarHash">Gerar Hash</button>
                                </div>
                            </div>
                        </div>
                  
                </div>

            </div>
        </div>
    </section>
@stop
<script type="text/javascript" src="{{ asset('js/jquery-3.6.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery12.js') }}"></script>
<script>
   $(document).ready(function () {
    function processarFactura(){
        var data1 = document.getElementById("dataInicio").value;
        var data2 = document.getElementById("dataFim").value;
        console.log(data1);
        $.ajax({
                url: 'quantFactura/'+data1'/'+data2
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var resultado = data
                    console.log(url);  
                        
                }
            });
    }

   });
</script>
