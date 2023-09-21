<template>
    <div>
        <div class="row p-2">
          <div class="col">
            <h3>Employee Manager</h3>
          </div>
          <div class="col">
            <button data-bs-toggle="modal" data-bs-target="#addEmployee" class="btn btn-success" style="margin-left: 60%;">Add Employee</button>
          </div>  
        </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Salary</th>
            <th>Phone</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="employee in employees" :key="employee.id">
            <td>{{ employee.id }}</td>
            <td>{{ employee.first_name }} {{ employee.last_name }}</td>
            <td>{{ employee.email }}</td>
            <td>{{ employee.profile }}</td>
            <td>{{ employee.salary }}</td>
            <td>{{ employee.phone }}</td>
            <td>
              <button data-bs-toggle="modal" data-bs-target="#editEmployee" class="me-2 btn btn-primary" @click="setEdit(employee.id)">Edit</button>
              <button data-bs-toggle="modal" data-bs-target="#deleteEmployee" class="btn btn-danger" @click="curId=employee.id">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>

<!-- add Modal -->
<div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="addEmployeeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addEmployeeLabel">Add Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <form @submit.prevent="addEmployee">
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="first-name">First Name:</label>
            <input class="m-2" type="text" v-model="f_name" id="first-name" name="first-name" required>
        </div>
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="last-name">Last Name:</label>
            <input class="m-2" type="text" v-model="l_name" id="last-name" name="last-name" required>
        </div>
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="email">Email:</label>
            <input class="m-2" type="email" v-model="email" id="email" name="email" required>
        </div>
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="position">Position:</label>
            <input class="m-2" type="text" v-model="profile" id="position" name="position" required>
        </div>
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="salary">salary:</label>
            <input class="m-2" type="text" v-model="salary" id="salary" name="salary" required>
        </div>
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="phone">Phone:</label>
            <input class="m-2" type="tel" v-model="phone" id="phone" name="phone" pattern="[0-9]{10}">
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <input class="m-2" type="submit" value="Submit">
        </div>
    </form>
      </div>
    </div>
  </div>
</div>

<!-- edit Modal -->
<div class="modal fade" id="editEmployee" tabindex="-1" aria-labelledby="editEmployeeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editEmployeeLabel">Edit Employee</h1>
        <button type="button" @click="resetForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="editEmployee">
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="first-name">First Name:</label>
            <input class="m-2" type="text" v-model="f_name" id="first-name" name="first-name" required>
        </div>
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="last-name">Last Name:</label>
            <input class="m-2" type="text" v-model="l_name" id="last-name" name="last-name" required>
        </div>
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="email">Email:</label>
            <input class="m-2" type="email" v-model="email" id="email" name="email" required>
        </div>
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="position">Position:</label>
            <input class="m-2" type="text" v-model="profile" id="position" name="position" required>
        </div>
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="salary">salary:</label>
            <input class="m-2" type="text" v-model="salary" id="salary" name="salary" required>
        </div>
        <div class="d-flex justify-content-center align-items-center label-parent">
            <label class="m-2" for="phone">Phone:</label>
            <input class="m-2" type="tel" v-model="phone" id="phone" name="phone" pattern="[0-9]{10}">
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <input class="m-2" type="submit" value="Submit">
        </div>
    </form>
      </div>
    </div>
  </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteEmployee" tabindex="-1" aria-labelledby="deleteEmployeeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteEmployeeLabel">Are you sure?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        This Action will delete Employee!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" @click="deleteEmployee">Delete</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
                employees: [],
                storeEdit: [],
                f_name: '',
                l_name: '',
                email: '',
                phone: '',
                profile: '',
                salary: '',
                curId: ''
            }
        },
        mounted() {
            this.showEmpList();
        },
        methods: {
            addEmployee() {
                axios.post('/employee-add', {
                    first_name: this.f_name,
                    last_name: this.l_name,
                    email: this.email,
                    phone: this.phone,
                    profile: this.profile,
                    salary:this.salary
                }).then((res) => {
                  $('#addEmployee').modal('hide');
                  this.$toast.open({
                        message: 'Employee Added Successfully!',
                        type: 'success',
                        position: 'top'
                    });
                    this.showEmpList();
                });
               
            },
            setEdit(id) {
                axios.post('/get-employee-by-id', {id: id}).then((res) => {
                    this.storeEdit = res.data;
                    this.f_name = this.storeEdit.first_name;
                    this.l_name = this.storeEdit.last_name;
                    this.email = this.storeEdit.email;
                    this.phone = this.storeEdit.phone;
                    this.profile = this.storeEdit.profile;
                    this.salary = this.storeEdit.salary;
                    this.curId = this.storeEdit.id;
                });
            },
            editEmployee() {
                axios.post('/update-employee-by-id', {
                    id: this.curId,
                    first_name: this.f_name,
                    last_name: this.l_name,
                    email: this.email,
                    phone: this.phone,
                    profile: this.profile,
                    salary:this.salary
                }).then((res) => {
                    $('#editEmployee').modal('hide');
                    this.$toast.open({
                        message: 'Employee Data Updated Successfully!',
                        type: 'success',
                        position: 'top'
                    });
                    this.showEmpList();
                    this.resetForm();
                })
            },
            deleteEmployee() {
              axios.post('/delete-employee-by-id', {id: this.curId}).then((res) => {
                  $('#deleteEmployee').modal('hide');
                  this.$toast.open({
                  message: 'Employee Removed Successfully!',
                  type: 'success',
                  position: 'top'
              });
              this.showEmpList();
              })
            },
            showEmpList() {
                axios.get('/employee-list').then((response) => {
                    this.employees = response.data;
                })
            },
            resetForm() {
              this.f_name = '';
              this.l_name = '';
              this.email = '';
              this.phone = '';
              this.profile = '';
              this.salary = '';
              this.curId = '';
            }
        }
    }
</script>

<style scoped>
.label-parent label {
  display: inline-block;
  width: 100px;
}
</style>
