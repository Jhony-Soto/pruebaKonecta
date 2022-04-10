<div class="container">
    <div class="row mt-5">
        <div class="col-xl-4 col-lg-4 col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <form id="form_save_categoria">
                        <label for="">Nombre</label>
                        <input type="number" hidden name="id_categoria">
                        <input type="text" class="form-control form-control-sm" name="name_categoria">
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success btn-sm" id="btnSaveCategoria">Guardar</button>
                            <button type="button" class="btn btn-danger btn-sm d-none" id="btnEditCategoria">Atualizar</button>
                            <button type="button" class="btn btn-secondary btn-sm d-none" id="btnCancelEdit">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8">
            <div class="card bg-light">
                <div class="card-body">
                    <table class="table" id="table_categoria">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>CATEGORIA</td>
                                <td>OPCIONES</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>