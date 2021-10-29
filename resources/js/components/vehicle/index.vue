<template>
	<section>
		<div class="my-4 text-right">
			<button class="btn btn-primary" @click="addVehicle">Agregar Vehiculo</button>
		</div>
		<div class="table-responsive">
			<table id="table" class="table table-bordered table-hover table-wrap table-sm">
				<thead class="text-center">
					<tr>
						<th>Modelo</th>
						<th>Año</th>
						<th>Color Del Vehiculo</th>
						<th>Placa</th>
						<th>Conductor</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(vehicle, index) in vehicles" :key="index">
						<td>{{ vehicle.model }}</td>
						<td>{{ vehicle.year }}</td>
						<td>{{ vehicle.vehicle_color }}</td>
						<td>{{ vehicle.license_plate }}</td>
						<td>
							<span v-if="vehicle.user != null">{{ vehicle.user.name }}</span>
							<span v-else>Sin Conductor</span>
						</td>
						<td>
							<div class="actions">
								<a href='#' role='edit'><i role='edit' @click.prevent="edit(vehicle)">Edit</i></a>
								<button class="btn btn-danger btn-sm" @click="deleteUser(vehicle, index)">Eliminar</button>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<form-user :vehicle="vehicle" :type="type" :users="users" />
	</section>
</template>

<script>
	import Form from "./Form";
	import datatables from "datatables";

	export default {
		props: ["vehicles", "users"],
		components: {
			"form-user": Form,
		},
		data() {
			return {
				vehicle: {},
				type: "created",
			};
		},
		mounted() {
			this.mytable();
		},
		methods: {
			mytable() {
				$(document).ready(function () {
					$("#table").DataTable();
				});
			},
			addVehicle() {
				this.type = "created";
				$("#modalEditUser").modal({
					backdrop: "static",
					keyboard: false,
				});
			},
			edit(vehicle) {
				this.vehicle = vehicle;
				this.type = "updated";
				$("#modalEditUser").modal({
					backdrop: "static",
					keyboard: false,
				});
			},
			async deleteUser(vehicle, index) {
				var url = "";
				url = `/vehicle/delete/${vehicle.id}`;

				await axios.post(url, vehicle).then((res) => {
					location.reload();
				});
			},
		},
	};
</script>
