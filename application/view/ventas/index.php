<div class="container">
	<div class="row">
		<div class="col-xl-6 col-lg-6 col-md-6 mt-5">
			<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
				<div class="card-body" id="topVenta">
					
				</div>
			</div>
		</div>
		<div class="col-xl-6 col-lg-6 col-md-6 mt-5">
			<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
				<div class="card-body" id="topStock">
					
				</div>
			</div>
		</div>
	</div>

    <div class="row mt-5">
        <div class="col-xl-4 col-lg-4 col-md-4">
			<div class="card bg-light">
				<div class="card-body">
					<form id="compra">
						<label>Articulo</label>
						<select class="form-control form-control-sm selectProducto" name="producto" id="select_producto"  required style="width:100%">
							<option value="" disabled selected> Seleccione un producto</option>
						</select>
						<label >Stock</label>
						<input type="number" class="form-control form-control-sm" name="stock" disabled>

						<label>Cantidad</label>
						<input type="number" name="cantidad"class="form-control form-control-sm" id="cantidad" required>

						<div class="mt-2 text-center">
							<button type="submit" class="btn btn-success btn-sm"><span class="icon-circle-with-plus"></span> Agregar</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-xl-8 col-lg-8 col-md-8">
			<div class="card bg-light">
				<div class="card-body">
					<div class="d-flex justify-content-around">
						<button class="limpiarTabla btn btn-danger btn-sm">Limpiar tabla</button>
						<button class="btn btn-primary btn-sm" id="comprar">Generar compra</button>

					</div>
					<div id="tabla"></div><BR>

					<table class="table" id='tabla_compra'>
						<thead >
							<tr>
								<th scope="col">ARTICULO</th>
								<th scope="col">CANTIDAD</th>
								<th scope="col">VALOR UNIDAD</th>
								<th scope="col">SUBTOTAL</th>
								</tr>
						</thead>
						
						<form id="form_venta">
							<tbody id='tbody'>
								
							</tbody>
						</form>
					</table>
				</div>
			</div>
		</div>
	</div>







