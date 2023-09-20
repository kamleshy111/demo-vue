<template>
    <div>
        <div class="text-center">
            <button data-bs-toggle="modal" data-bs-target="#addEmployee" class="btn btn-success">Add Employee</button>
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
              <button data-bs-toggle="modal" data-bs-target="#editEmployee" class="btn btn-primary" @click="setEdit(employee.id)">Edit</button>
              <button class="btn btn-danger" @click="deleteEmployee(employee.id)">Delete</button>
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
        <h2>Employee Information</h2>
    <form @submit.prevent="addEmployee">
        <div>
            <label for="first-name">First Name:</label>
            <input type="text" v-model="f_name" id="first-name" name="first-name" required>
        </div>
        <div>
            <label for="last-name">Last Name:</label>
            <input type="text" v-model="l_name" id="last-name" name="last-name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" v-model="email" id="email" name="email" required>
        </div>
        <div>
            <label for="position">Position:</label>
            <input type="text" v-model="profile" id="position" name="position" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="tel" v-model="phone" id="phone" name="phone" pattern="[0-9]{10}" placeholder="1234567890">
            <small>Enter a 10-digit phone number (numeric characters only).</small>
        </div>
        <div>
            <input type="submit" value="Submit">
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
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h2>Employee Information</h2>
    <form @submit.prevent="editEmployee()">
        <div>
            <label for="first-name">First Name:</label>
            <input type="text" v-model="f_name" id="first-name" name="first-name" required>
        </div>
        <div>
            <label for="last-name">Last Name:</label>
            <input type="text" v-model="l_name" id="last-name" name="last-name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" v-model="email" id="email" name="email" required>
        </div>
        <div>
            <label for="position">Position:</label>
            <input type="text" v-model="profile" id="position" name="position" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="tel" v-model="phone" id="phone" name="phone" pattern="[0-9]{10}" placeholder="1234567890">
            <small>Enter a 10-digit phone number (numeric characters only).</small>
        </div>
        <div>
            <input type="submit" value="Submit">
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
        Delete Employee?
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
                    profile: this.profile
                }).then((res) => {
                    alert("Employee information submitted successfully");
                    window.location.reload();
                });
               
            },
            setEdit(id) {
                axios.post('/get-employee-by-id', {id: id}).then((res) => {
                    console.log(res.data)
                    this.storeEdit = res.data;
                    this.f_name = this.storeEdit.first_name;
                    this.l_name = this.storeEdit.last_name;
                    this.email = this.storeEdit.email;
                    this.phone = this.storeEdit.phone;
                    this.profile = this.storeEdit.profile;
                    this.curId = this.storeEdit.id;
                });
            },
            editEmployee() {
                axios.post('/update-employee-by-id', {id: this.curId}).then((res) => {
                    console.log('success', res);
                    alert("Employee information updated successfully");
                    window.location.reload();
                })
            },
            deleteEmployee(employeeid) {
                if(confirm('Delete the Employee?')) {
                    axios.post('/delete-employee-by-id', {id: employeeid}).then((res) => {
                        console.log('success', res);
                        alert("Employee information delete successfully");
                        window.location.reload();
                    })
                }
            },
            showEmpList() {
                axios.get('/employee-list').then((response) => {
                    console.log('chcek: ', response.data);
                    // Assuming the submission was successful, display a success toast
                    this.employees = response.data
                })
            }
        }
    }
</script>
