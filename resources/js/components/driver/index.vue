<template>
	<section>
		<div class="my-4 text-right">
			<button class="btn btn-primary" @click="addTrip">Agregar Viaje</button>
		</div>
		<div class="table-responsive">
			<table id="table" class="table table-bordered table-hover table-wrap table-sm" style="width:100%">
				<thead class="text-center">
					<tr>
						<th>Carga General</th>
						<th>Fecha</th>
						<th>Conductor</th>
						<th>Vehiculo</th>
						<th>Adelanto De Dinero</th>
						<th>Toneladas</th>
						<th>Alimentación</th>
						<th>Peajes</th>
						<th>Combustible</th>
						<th>Otros</th>
						<th>Debe A La Empresa</th>
						<th>Debe Al Conductor</th>
						<th>Acciones</th>

					</tr>
				</thead>
				<tbody>
					<tr v-for="(trip, index) in trips" :key="index">
						<td>{{ trip.general_load }}</td>
						<td>{{ trip.date }}</td>
						<td>
							<span v-if="trip.tour_driver !== null">{{ trip.tour_driver}}</span>
							<span v-else>Sin Conductor</span>
						</td>
						<td>{{ trip.vehicle }}</td>
						<td>{{ trip.money_advance }}</td>
						<td>{{ trip.tons }}</td>
						<td>{{ trip.feeding }}</td>
						<td>{{ trip.Toll }}</td>
						<td>{{ trip.fuel }}</td>
						<td>{{ trip.other }}</td>
						<td>
							<span v-if="trip.money_advance > trip.feeding + trip.Toll + trip.fuel + trip.other">
								{{ trip.money_advance - (trip.feeding + trip.Toll + trip.fuel + trip.other) }}
							</span>
							<span v-else>
								No Debe A La Empresa
							</span>
						</td>
						<td>
							<span v-if="trip.money_advance < trip.feeding + trip.Toll + trip.fuel + trip.other">
								{{ trip.feeding + trip.Toll + trip.fuel + trip.other - (trip.money_advance) }}
							</span>
							<span v-else>
								No Debe Al Conductor
							</span>
						</td>
						<td>
							<div class=" actions">
								<a href='#' role='edit'><i role='edit' @click.prevent="edit(trip)">Edit</i></a>
								<button class="btn btn-danger btn-sm" @click="deleteUser(trip, index)">Eliminar</button>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<form-user :trip="trip" :type="type" :vehicles="vehicles" :persons="persons" />
	</section>
</template>

<script>
	import Form from "./Form";
	import datatables from "datatables";

	export default {
		props: ["trips", "vehicles", "persons"],
		components: {
			"form-user": Form,
		},
		data() {
			return {
				trip: {},
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
			addTrip() {
				this.type = "created";
				$("#modalEditUser").modal({
					backdrop: "static",
					keyboard: false,
				});
			},
			edit(trip) {
				this.trip = trip;
				this.type = "updated";
				$("#modalEditUser").modal({
					backdrop: "static",
					keyboard: false,
				});
			},
			async deleteUser(trip, index) {
				var url = "";
				url = `/trip/delete/${trip.id}`;

				await axios.post(url, trip).then((res) => {
					location.reload();
				});
			},
		},
	};
</script>
