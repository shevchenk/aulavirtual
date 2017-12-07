<div class="modal" id="ModalMasivo" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Masivo</h4>
            </div>
            <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <form id="ModalMasivoForm" name="ModalMasivoForm" action="" enctype="multipart/form-data" method="post">
                                <div class="col-sm-12">
                                    <div class="col-sm-9">
                                        <input type="file" class="filestyle" data-buttonText="&nbsp;Archivo .TXT (Programación)" id="carga" name="carga" data-buttonName="btn-info">
                                    </div>
                                    <div class="col-sm-3 ">
                                        <button type="button" id="btn_cargar" class="btn btn-info">
                                            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="col-sm-12">&nbsp;</div>
                            <hr>
                            <br><br>
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    &nbsp;
                                </div>
                                <div class="col-sm-4">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <th style="text-align:center">No pasaron</th>
                                        </head>
                                        <tbody id="resultado">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            </body>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-12" id="log_fallas">
                                <div class="col-sm-1">
                                    &nbsp;
                                </div>
                                <div class="col-sm-10">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <th style="text-align:center">DATOS NO PROCESADOS</th>
                                        </head>
                                        <tbody id="resultado_log">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            </body>
                                    </table>
                                </div>
                            </div>

                        </div><!-- /.box -->
                    </div>
                    <div class="form-group">
                        <label></label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default active pull-left" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
