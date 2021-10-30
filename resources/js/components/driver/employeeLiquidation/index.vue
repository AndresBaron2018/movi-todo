<template>
	<section>
		<span>
			<tr v-for="(user, index) in users" :key="index">
				<div class="alert alert-info" role="alert">
					{{ "Nombre del empleado:    "+ user.name + "  &&   Numero de celular:    " + user.cell_phone_number }}
				</div>
			</tr>
		</span>
		<div class="form-group row">
			<div class="col-md-6">
				<label>Identification card</label>
				<input type="id" class="form-control" placeholder="document" v-model="id" maxlength="20" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122)  || (event.charCode >= 48 && event.charCode <= 57))" required>
				<span class="badge badge-danger" v-if="this.users == 'Usuario no encontrado'">{{ this.users }}</span>
			</div>
			<div class="col-md-6">
				<div>
					<vue-date-picker :value="this.minimum_date" :min-date="this.minimum_date" :max-date="this.maximum_date"></vue-date-picker>
				</div>
				<button class="btn btn-primary" type="submit" v-on:click="bringUserByDocumentNumber()">Buscar al usuario</button>
			</div>
			<div class="col-md-6">
				<label class="font__helvetica--light title_label">Gasto total en alimentación</label>
				<input type="email" name="email" class="form-control" placeholder="total_feeding" v-model="this.total_feeding" required>
			</div>
			<div class="col-md-6">
				<label class="font__helvetica--light title_label">Gasto total en peajes</label>
				<input type="email" name="email" class="form-control" placeholder="total_toll" v-model="this.total_toll" required>
			</div>
			<div class="col-md-6">
				<label class="font__helvetica--light title_label">Gasto total en combustible</label>
				<input type="email" name="email" class="form-control" placeholder="total_fuel" v-model="this.total_fuel" required>
			</div>
			<div class="col-md-6">
				<label class="font__helvetica--light title_label">Otros gastos</label>
				<input type="email" name="email" class="form-control" placeholder="total_other" v-model="this.total_other" required>
			</div>
			<div class="col-md-6">
				<label class="font__helvetica--light title_label">Total adelanto de dinero</label>
				<input type="email" name="email" class="form-control" placeholder="total_money_advance" v-model="this.total_money_advance" required>
			</div>
			<div class="col-md-6">
				<label class="font__helvetica--light title_label">Total gastos</label>
				<input type="email" name="email" class="form-control" placeholder="total_expenses" v-model="this.total_expenses" required>
			</div>
			<div class="col-md-6">
				<label class="font__helvetica--light title_label">La empresa debe al empleado</label>
				<input type="email" name="email" class="form-control" placeholder="owes_the_employee" v-model="this.owes_the_employee" required>
			</div>
			<div class="col-md-6">
				<label class="font__helvetica--light title_label">El empleado debe a la empresa</label>
				<input type="email" name="email" class="form-control" placeholder="owes_the_company" v-model="this.owes_the_company" required>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		data() {
			return {
				date: Date(),
				minimum_date: "",
				maximum_date: "",
				id: "",
				users: "",
				person: [],
				total_feeding: null,
				total_toll: null,
				total_fuel: null,
				total_other: null,
				total_money_advance: null,
				total_expenses: null,
				liquidation: null,
				owes_the_company: null,
				owes_the_employee: null,
			};
		},
		mounted() {
			this.limitedDate();
		},
		methods: {
			bringUserByDocumentNumber() {
				let url = "employeeLiquidation/bringUserByDocumentNumber/" + this.id;
				axios.get(url).then((response) => {
					this.users = response.data;
					this.person = this.users;
					this.employeeLiquidation();
				});
			},
			limitedDate() {
				this.maximum_date = new Date();
				this.minimum_date =
					this.maximum_date.getFullYear() +
					"-" +
					(this.maximum_date.getMonth() + 1) +
					"-" +
					(this.maximum_date.getDate() - 7);
				console.log(this.minimum_date);
			},
			employeeLiquidation() {
				this.person.forEach((item) => {
					item.trip.forEach((travel) => {
						// conditional of date
						if (travel.created_at >= this.minimum_date) {
							// Total
							this.total_feeding = this.total_feeding + travel.feeding;
							// Total
							this.total_toll = this.total_toll + travel.Toll;
							// Total
							this.total_fuel = this.total_fuel + travel.fuel;
							// Total
							this.total_other = this.total_other + travel.other;

							// Total money advance
							this.total_money_advance =
								this.total_money_advance + travel.money_advance;

							// total expenses
							this.total_expenses =
								this.total_expenses +
								travel.feeding +
								travel.Toll +
								travel.fuel +
								travel.other;
						}
					});
				});
				if (this.total_money_advance > this.total_expenses) {
					this.owes_the_company = this.total_money_advance - this.total_expenses;
				} else {
					this.owes_the_employee = this.total_expenses - this.total_money_advance;
				}
				console.log(this.total_money_advance);
				console.log(this.total_expenses);
				console.log(this.liquidation);
			},
		},
	};
</script>
