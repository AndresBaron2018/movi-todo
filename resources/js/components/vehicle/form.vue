<template>
	<div class="modal fade" id="modalEditUser">
		<div class="modal-dialog modal-xl modal-primary" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Agregar Vehiculo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form @submit.prevent="store" autocomplete="off">
						<div class="form-group row">
							<div class="col-md-6">
								<label>Modelo</label>
								<input type="text" class="form-control" placeholder="model" v-model="vehicle.model" required>
							</div>
							<div class="col-md-6">
								<label>Año</label>
								<input type="number" class="form-control" placeholder="year" v-model="vehicle.year" required>
							</div>
							<div class="col-md-6">
								<label>Color Del Vehiculo</label>
								<input type="text" class="form-control" placeholder="vehicle_color" v-model="vehicle.vehicle_color" required>
							</div>
							<div class="col-md-6">
								<label>Placa</label>
								<input type="text" class="form-control" placeholder="license_plate" v-model="vehicle.license_plate" required>
							</div>
							<div class="col-md-6" style="top: 1rem;">
								<label>Conductor</label>
								<select class="form-select" aria-label="Default select example" v-model="vehicle.driver" required>
									<option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-primary" type="submit">Save</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ["vehicle", "type", "users"],
		methods: {
			async store() {
				var url = "";
				if (this.type == "created") url = `/vehicle/store`;
				if (this.type == "updated") url = `/vehicle/update/${this.vehicle.id}`;

				await axios.post(url, this.vehicle).then((res) => {
					if (res.data.saved) {
						location.reload();
					}
				});
			},
		},
	};
</script>
