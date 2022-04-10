<div class="container">
    <div class="row mt-5">
        <div class="col-xl-4 col-lg-4 col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <form id="form_articulos" >
                        <label>Nombre</label>
                        <input type="number" hidden name="id_articulo">
                        <input type="text"  name="nombre_articulo" class="form-control form-control-sm"/>

                        <label>Referencia</label>
                        <input type="text"  name="referencia_articulo" class="form-control form-control-sm"/>

                        <label>Precio</label>
                        <input type="number"  name="precio_articulo" class="form-control form-control-sm"/>

                        <label>Peso</label>
                        <input type="number"  name="peso_articulo" class="form-control form-control-sm"/>
                
                        <label>Categoria</label>
                        <select class="form-control form-control-sm select2 categoria" name="categoria" id="categoria" style="width:100%">
                            <option  disabled>Selecciona una Categoria</option>
                        </select>

                        <label>Stock</label>
                        <input type="number"  name="stock_articulo" class="form-control form-control-sm"/>
                    
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success btn-sm" id="btnSaveArticulo">Guardar</button>
                            <button type="button" class="btn btn-danger btn-sm d-none" id="btnEditArticulo">Atualizar</button>
                            <button type="button" class="btn btn-secondary btn-sm d-none" id="btnCancelEdit">Cancelar</button>
                        </div>
        
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8">
            <div class="card bg-light">
                <div class="card-body">
                    <table class="table" id="articulos">
                        <thead>
                            <tr>
                                <td>NOMBRE</td>
                                <td>REFERENCIA</td>
                                <td>PRECIO</td>
                                <td>PESO</td>
                                <td>CATEGORIA</td>
                                <td>STOCK</td>
                                <td>OPCIONES</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>









