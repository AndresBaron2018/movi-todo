<template>
	<div class="modal fade" id="modalEditUser">
		<div class="modal-dialog modal-xl modal-primary" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Viaje</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form @submit.prevent="store" autocomplete="off">
						<div class="form-group row">
							<div class="col-md-6">
								<label>Carga General</label>
								<input type="text" class="form-control" placeholder="general_load" v-model="trip.general_load" required>
							</div>
							<div class="col-md-6">
								<label>Toneladas</label>
								<input type="number" class="form-control" placeholder="tons" v-model="trip.tons" required>
							</div>
							<div class="col-md-6">
								<label>Fecha</label>
								<input type="date" class="form-control" placeholder="date" v-model="trip.date" required>
							</div>
							<div class="col-md-6">
								<label>Adelanto De Dinero</label>
								<input type="number" class="form-control" placeholder="money_advance" v-model="trip.money_advance">
							</div>
							<div class="col-md-6">
								<label>Alimentación</label>
								<input type="number" class="form-control" placeholder="feeding" v-model="trip.feeding" required>
							</div>
							<div class="col-md-6">
								<label>Peajes</label>
								<input type="number" class="form-control" placeholder="Toll" v-model="trip.Toll" required>
							</div>
							<div class="col-md-6">
								<label>Combustible</label>
								<input type="number" class="form-control" placeholder="fuel" v-model="trip.fuel">
							</div>
							<div class="col-md-6">
								<label>Otros</label>
								<input type="number" class="form-control" placeholder="others" v-model="trip.other" required>
							</div>
							<div class="col-md-6" style="top: 1rem;">
								<label>Vehicles</label>
								<select class="form-select" aria-label="Default select example" v-model="trip.vehicle">
									<option v-for="vehicle in vehicles" :key="vehicle.id">{{vehicle.license_plate}}</option>
								</select>
							</div>
							<div class="col-md-6" style="top: 1rem;">
								<label>Conductor</label>
								<select class="form-select" aria-label="Default select example" v-model="trip.tour_driver">
									<option v-for="person in persons" :key="person.id">{{person.name}}</option>
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
		props: ["trip", "type", "vehicles", "persons"],
		methods: {
			async store() {
				var url = "";
				if (this.type == "created") url = `/trip/store`;
				if (this.type == "updated") url = `/trip/update/${this.trip.id}`;

				await axios.post(url, this.trip).then((res) => {
					if (res.data.saved) {
						location.reload();
					}
				});
			},
		},
	};
</script>
