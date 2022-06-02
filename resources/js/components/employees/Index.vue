<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-5">
            <h1 class="h3 mb-0 text-gray-800">Employees</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div v-if="showMessage" class="alert alert-success text-center fw-bold">
                    {{ message }}
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-8">
                                <form class="form-row align-items-center">
                                    <div class="col-5">
                                        <input type="search" v-model="search" class="form-control" placeholder="john doe" id="search">
                                    </div>
                                    <div class="col-5">
                                        <select v-model="selectedDepartment" name="department" class="form-control" id="department">
                                            <option value="" selected>Select Department</option>
                                            <option v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4">
                                <router-link :to="{name: 'EmployeesCreate'}" class="btn btn-primary mb-3 float-right">
                                    Create New Employee
                                </router-link>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered text-center align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>Department</th>
                                        <th>City</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="employee in employees" :key="employee.id">
                                        <td>{{ employee.id }}</td>
                                        <td>{{ employee.firstname }}</td>
                                        <td>{{ employee.lastname }}</td>
                                        <td>{{ employee.address }}</td>
                                        <td>{{ employee.country.name }}</td>
                                        <td>{{ employee.state.name }}</td>
                                        <td>{{ employee.department.name }}</td>
                                        <td>{{ employee.city.name }}</td>
                                        <td>
                                            <router-link :to="{name: 'EmployeesEdit', params: {id: employee.id}}" class="btn btn-success">Edit</router-link>
                                            <button type="button" @click="deleteEmployee(employee.id)" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            showMessage: false,
            message: '',
            employees: [],
            departments: [],
            search: '',
            selectedDepartment: null,
        }
    },
    created() {
        this.getEmployees();
        this.getDepartments();
    },
    watch: {
        // nama function sesuai nama properti yang di watch
        search() {
            this.getEmployees()
        },
        selectedDepartment() {
            this.getEmployees()
        }
    },
    methods: {
        getEmployees() {
            axios.get(`/api/employees`, {
                params: {
                    search: this.search,
                    department_id: this.selectedDepartment,
                }
            }).then(response => {
                this.employees = response.data;
            }).catch(error => console.log(error));
        },
        getDepartments() {
            axios.get('/api/employees/departments')
                .then(response => this.departments = response.data)
                .catch(error => console.log(error));
        },
        deleteEmployee(id) {
            axios.delete(`/api/employees/${id}`)
                .then(response => {
                    this.getEmployees();
                    this.showMessage = true;
                    this.message = response.data.message;
                }).catch(error => console.log(error));
        }
    }
}
</script>

<style>

</style>