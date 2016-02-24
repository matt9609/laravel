@extends('baseLayout')

@section('title')
        Nueva Solicitud
@stop

@section('content')

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Nueva Solicitud</h1>
                <small id="dateWeek" style="text-align: center; color: rgb(91, 155, 209);"></small>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div id="selectconstr" class="row step">
            <div class="col-xs-12" style="text-align:center;">
                <h1>Seleccione la planta:</h1>
                <div id="error-select"></div>
                <br>
                <form autocomplete="off">
                    <select id="selectConstruct" class="image-picker show-html">
                        <option value=""></option>
                        <option id="options-con" data-img-src="http://www.marketingdirecto.com/wp-content/uploads/2011/08/construccion.jpg" value="1">  Construcción 1  </option>
                        <option id="options-con" data-img-src="http://www.marketingdirecto.com/wp-content/uploads/2011/08/construccion.jpg" value="2">  Construcción 2  </option>
                        <option id="options-con" data-img-src="http://www.marketingdirecto.com/wp-content/uploads/2011/08/construccion.jpg" value="3">  Construcción 3  </option>
                        <option id="options-con" data-img-src="http://www.marketingdirecto.com/wp-content/uploads/2011/08/construccion.jpg" value="4">  Construcción 4  </option>
                    </select>
                </form>
            </div>
        </div>
        <div id="calendarioUI" class="row step">
            <div class="col-md-12">
                <div id="success_pr"></div>
                <div class="portlet light portlet-fit bordered calendar">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">Calendario</span>
                        </div>
                        <div id="VolverConstruccion" class="btn blue pull-right">Volver a Seleccionar construcción.</div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div id="calendar" class="has-toolbar"> </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div id="Addelementmodal" class="modal fade bs-modal-lg in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                             <h3 id="myModalLabel1">Añadir elemento</h3>
                    </div>
            <div class="modal-body">
            <div class="row">
                <form action="#" id="AddElemento" class="form-horizontal" role="form" autocomplete="off">
                    <div class="form-group col-md-4">
                        <div class="col-md-12">
                            <div class="btn-group bootstrap-select bs-select form-control">
                                <select tabindex="-98" id="selectElement" class="bs-select form-control">
                                    <option selected value="base">Por favor seleccione</option>
                                    <option value="2">Agregados Petreos</option>
                                    <option value="1">Mezclas</option>
                                    <option value="3">Fresado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="col-md-12">
                            <div class="btn-group bootstrap-select bs-select form-control">
                                <select id="Referencess" tabindex="-98" class="bs-select form-control">
                                    <option selected value="base">Selecciona una referencia </option>
                                </select>
                            </div>
                            <div id="ErrorRe"></div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="CantidadElemento" id="CantidadElemento" placeholder="Cantidad en m3">
                        <div id="ErrorCa"></div>
                    </div>

                </form>
                    <div class="form-group">
                        <div class="controls">
                            <input type="hidden" name="patientName" id="patientName" style="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Value 1&quot;,&quot;Value 2&quot;,&quot;Value 3&quot;]">
                            <input type="hidden" id="apptStartTime"/>
                            <input type="hidden" id="apptEndTime"/>
                            <input type="hidden" id="apptAllDay" />
                            <input type="hidden" id="dayofWeek" />
                            <input type="hidden" id="NumeroSolicitud" value=""/>
                            <input type="hidden" id="ElementoID" value=""/>
                            <input type="hidden" id="ElementoIdent" value="" />
                        </div>
                    </div>
            </div>
            </div>
            <div class="modal-footer">
                <button id="Cancelar" class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                <button type="submit" class="btn green" id="BotonEnvio">Guardar</button>
            </div>
        </div>
        </div>
        </div>
        <div id="Editelementmodal" class="modal fade bs-modal-lg in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 id="myModalLabel1">Editar elemento</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="#" id="EditElemento" class="form-horizontal" role="form" autocomplete="off">
                                <div class="form-group col-md-4">
                                    <div class="col-md-12">
                                        <div class="btn-group bootstrap-select bs-select form-control">
                                            <select tabindex="-98" id="selectElement1" name="selectElement1" class="bs-select form-control">
                                                <option selected value="base">Por favor seleccione</option>
                                                <option value="2">Agregados Petreos</option>
                                                <option value="1">Mezclas</option>
                                                <option value="3">Fresado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="col-md-12">
                                        <div class="btn-group bootstrap-select bs-select form-control">
                                            <select id="Referencess1" name="Referencess1" tabindex="-98" class="bs-select form-control">
                                                <option>Seleccione una referencia</option>
                                            </select>
                                        </div>
                                        <div id="ErrorRe1"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="CantidadElemento1" id="CantidadElemento1" placeholder="Cantidad en m3">
                                    <div id="ErrorCa1"></div>
                                </div>
                           </form>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button aria-hidden="true" class="btn btn-danger pull-left" id="DeleteButton" data-dismiss="modal">Eliminar</button>
                       <button id="Cancelar" class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                       <button type="submit" class="btn green" id="BotonEditar">Actualizar</button>
                   </div>
               </div>
           </div>
       </div>
        <div id="SeleccionarConstruccion" class="modal fade bs-modal-lg in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 id="myModalLabel1">Seleccionar Construcción</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form action="#" class="form-horizontal" role="form" autocomplete="off">
                                <select id="selectConstruct1" class="image-picker show-html">
                                    <option value=""></option>
                                    <option id="options-con" data-img-src="http://www.marketingdirecto.com/wp-content/uploads/2011/08/construccion.jpg" value="1">  Construcción 1  </option>
                                    <option id="options-con" data-img-src="http://www.marketingdirecto.com/wp-content/uploads/2011/08/construccion.jpg" value="2">  Construcción 2  </option>
                                    <option id="options-con" data-img-src="http://www.marketingdirecto.com/wp-content/uploads/2011/08/construccion.jpg" value="3">  Construcción 3  </option>
                                    <option id="options-con" data-img-src="http://www.marketingdirecto.com/wp-content/uploads/2011/08/construccion.jpg" value="4">  Construcción 4  </option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                        <button type="submit" class="btn green" id="BotonConstruccion">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

       <!-- END PAGE BASE CONTENT -->
   </div>
   <!-- END CONTENT BODY -->
        <!-- END CONTENT -->
@stop


