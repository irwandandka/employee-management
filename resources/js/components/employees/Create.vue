<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-5">
            <h1 class="h3 mb-0 text-gray-800">Create New Employee</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                            <router-link :to="{name: 'EmployeesIndex'}" class="btn btn-primary float-right">Back</router-link>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="storeEmployee()">
                            <div class="row mb-3">
                                <label for="firstname" class="col-md-4 col-form-label text-md-end">First Name</label>

                                <div class="col-md-6">
                                    <input id="firstname" v-model="form.firstname" type="text" class="form-control" name="firstname" value="" autocomplete="firstname" autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="middlename" class="col-md-4 col-form-label text-md-end">Middle Name</label>
                                <div class="col-md-6">
                                    <input id="middlename" v-model="form.middlename" type="text" class="form-control" name="middlename" value="" autocomplete="middlename" autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="lastname" class="col-md-4 col-form-label text-md-end">Last Name</label>
                                <div class="col-md-6">
                                    <input id="name" v-model="form.lastname" type="text" class="form-control" name="lastname" value="" autocomplete="lastname" autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                                <div class="col-md-6">
                                    <input id="address" v-model="form.address" type="text" class="form-control" name="address" value="" autocomplete="address" autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="country" class="col-md-4 col-form-label text-md-end">Country</label>

                                <div class="col-md-6">
                                    <select v-model="form.country_id" @change="getStates()" name="country" class="form-control" id="country">
                                        <option value="" selected>Open this select menu</option>
                                        <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="state" class="col-md-4 col-form-label text-md-end">State</label>

                                <div class="col-md-6">
                                    <select v-model="form.state_id" @change="getCities()" name="state" class="form-control" id="state">
                                            <option value="" selected>Open this select menu</option>
                                            <option v-for="state in states" :key="state.id" :value="state.id">{{ state.name }}</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="department" class="col-md-4 col-form-label text-md-end">Department</label>

                                <div class="col-md-6">
                                    <select v-model="form.department_id" name="department" class="form-control" id="department">
                                            <option value="" selected>Open this select menu</option>
                                            <option v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="city" class="col-md-4 col-form-label text-md-end">City</label>

                                <div class="col-md-6">
                                    <select v-model="form.city_id" name="city" class="form-control" id="city">
                                            <option value="" selected>Open this select menu</option>
                                            <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="zipcode" class="col-md-4 col-form-label text-md-end">Zip Code</label>
                                <div class="col-md-6">
                                    <input id="zipcode" v-model="form.zip_code" type="text" class="form-control" name="zipcode" value="" autocomplete="zipcode" autofocus>
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birthdate" class="col-md-4 col-form-label text-md-end">Birthdate</label>
                                <div class="col-md-6">
                                    <datepicker v-model="form.birthdate" input-class="form-control"></datepicker>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="hiredate" class="col-md-4 col-form-label text-md-end">Date Hired</label>
                                <div class="col-md-6">
                                    <datepicker v-model="form.hiredate" input-class="form-control"></datepicker>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import axios from 'axios';
import moment from 'moment';

export default {
    components: {
        Datepicker
    },
    data() {
        return {
            countries: [],
            states: [],
            departments: [],
            cities: [],
            form: {
                firstname: '',
                middlename: '',
                lastname: '',
                address: '',
                country_id: '',
                state_id: '',
                department_id: '',
                city_id: '',
                zip_code: '',
                birthdate: null,
                hiredate: null,
            }
        }
    }, 
    created() {
        this.getCountries();
        this.getDepartments();
    },
    methods: {
        getCountries() {
            axios.get("/api/employees/countries")
                .then(response => {
                    this.countries = response.data;
                }).catch(error => console.log(error));
        },
        getStates() {
            axios.get(`/api/employees/${this.form.country_id}/states`)
                .then(response => {
                    this.states = response.data;
                }).catch(error => console.log(error));
        },
        getDepartments() {
            axios.get(`/api/employees/departments`)
                .then(response => {
                    this.departments = response.data;
                }).catch(error => console.log(error));
        },
        getCities() {
            axios.get(`/api/employees/${this.form.state_id}/cities`)
                .then(response => {
                    this.cities = response.data;
                }).catch(error => console.log(error));
        },
        storeEmployee() {
            axios.post(`/api/employees`, {
                firstname: this.form.firstname,
                middlename: this.form.middlename,
                lastname: this.form.lastname,
                address: this.form.address,
                country_id: this.form.country_id,
                state_id: this.form.state_id,
                department_id: this.form.department_id,
                city_id: this.form.city_id,
                zipcode: this.form.zip_code,
                birthdate: this.formatDate(this.form.birthdate),
                date_hired: this.formatDate(this.form.hiredate),
            }).then(response => {
                this.$router.push({ name: "EmployeesIndex" });
            })
            .catch(error => console.log(error));
        },
        formatDate(value) {
            if(value) {
                return moment(String(value)).format('YYYYMMDD');
            }
        }
    }
}
</script>

<style>

</style>