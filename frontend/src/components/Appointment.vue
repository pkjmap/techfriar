<template>
    <div>
      <div class="table-wrapper">
          <div class="table-title">
              <div class="row">
                  <div class="col-sm-6">
                      <h2>Manage <b>Appointment</b></h2>
                  </div>
                  <div class="col-sm-6">
                      <a href="#addAppointmentModal" class="btn btn-success" data-toggle="modal"><i
                              class="material-icons">&#xE147;</i> <span>Add New Appointment</span></a>
                  </div>
              </div>
          </div>
          <table class="table table-striped table-hover">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>License</th>
                      <th>Start time</th>
                      <th>End time</th>
                      <th>Slot</th>
                      <th>Parking Fee</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="appointment in appointments" v-bind:key="appointment.id">
                      <td>{{appointment.cust_name}}</td>
                      <td>{{appointment.phone}}</td>
                      <td>{{appointment.license_path}}</td>
                      <td>{{appointment.start_date_time}}</td>
                      <td>{{appointment.end_date_time}}</td>
                      <td>{{appointment.slot}}</td>
                      <td>{{appointment.parking_fee}}</td>
                      <td>
                          <a href="#editAppointmentModal" class="edit" data-toggle="modal"><i class="material-icons"
                                  data-toggle="tooltip" title="Edit" @click="edit(appointment)">&#xE254;</i></a>
                          <a href="#deleteAppointmentModal" class="delete" data-toggle="modal"><i
                                  class="material-icons" data-toggle="tooltip" title="Delete" @click="mDelete(appointment)">&#xE872;</i></a>
                          <a href="#checkoutAppointmentModal" class="checkout" data-toggle="modal"><i
                                  class="material-icons" data-toggle="tooltip" title="Checkout" @click="checkout(appointment)">&#xE875;</i></a>
                      </td>
                  </tr>
              </tbody>
          </table>
          <div class="clearfix">
              <pagination :pagination="pagination" :callback="loadAppointments" :options="paginationOptions"></pagination>
          </div>
      </div>

        <!-- Edit Modal HTML -->
        <div id="addAppointmentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="saveAppointment">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Appointment</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" v-model="appointment.cust_name" name="cust_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" v-model="appointment.phone" name="phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>License</label>
                                <input type="text" value="just a string" v-model="appointment.license_path" name="license_path" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Vehicle Number</label>
                                <input type="text" v-model="appointment.vehicle_number" name="vehicle_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Start Date Time</label>
                                <input type="text" value="2026-03-12T15:24:22Z" v-model="appointment.start_date_time" name="start_date_time" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>End Date Time</label>
                                <input type="text" value="2026-03-12T16:24:22Z" v-model="appointment.end_date_time" name="end_date_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal HTML -->
        <div id="editAppointmentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="updateAppointment">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Appointment</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" v-model="appointment.cust_name" name="cust_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" v-model="appointment.phone" name="phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>License</label>
                                <input type="text" v-model="appointment.license_path" name="license_path" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Vehicle Number</label>
                                <input type="text" v-model="appointment.vehicle_number" name="vehicle_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Start Date Time</label>
                                <input type="text" v-model="appointment.start_date_time" name="start_date_time" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>End Date Time</label>
                                <input type="text" v-model="appointment.end_date_time" name="end_date_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-info" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal HTML -->
        <div id="checkoutAppointmentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="">
                        <div class="modal-header">
                            <h4 class="modal-title">Checkout Appointment</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" disabled v-model="checkoutDetails.cust_name" name="cust_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" disabled v-model="checkoutDetails.phone" name="phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>License</label>
                                <input type="text" disabled v-model="checkoutDetails.license_path" name="license_path" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Vehicle Number</label>
                                <input type="text" disabled v-model="checkoutDetails.vehicle_number" name="vehicle_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Start Date Time</label>
                                <input type="text" disabled v-model="checkoutDetails.start_date_time" name="start_date_time" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>End Date Time</label>
                                <input type="text" disabled v-model="checkoutDetails.end_date_time" name="end_date_time" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Slot</label>
                                <input type="text" disabled v-model="checkoutDetails.slot" name="end_date_time" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Checkout Amount</label>
                                <input type="text" disabled v-model="checkoutDetails.parking_fee" name="end_date_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Delete Modal HTML -->
        <div id="deleteAppointmentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="deleteAppointment">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Appointment</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete these Records?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import pagination from 'vue-bootstrap-pagination'
Vue.use(axios)
export default {
  name: 'Appointment',
  components: {
    pagination
  },
  data () {
    return {
      appointments: {},
      appointment: {
        id: '',
        cust_name: 'test',
        phone: '',
        license_path: '',
        vehicle_number: 'test',
        start_date_time: '2023-03-12T16:24:22Z',
        end_date_time: '2023-03-12T17:24:22Z'
      },
      checkoutDetails: {
        id: '',
        cust_name: '',
        phone: '',
        license_path: '',
        vehicle_number: '',
        start_date_time: '',
        end_date_time: '',
        slot: '',
        parking_fee: ''
      },
      pagination: {
        total: 0,
        per_page: 5, // required
        current_page: 1, // required
        last_page: 0, // required
        from: 1,
        to: 12
      },
      paginationOptions: {
        offset: 4,
        previousText: 'Prev',
        nextText: 'Next',
        alwaysShowPrevNext: true
      }
    }
  },
  created () {
    this.loadAppointments()
  },
  methods: {
    loadAppointments () {
      const options = {
        params: {
          paginate: this.pagination.per_page,
          page: this.pagination.current_page
        }
      }
      var url = 'http://localhost/techfriar/api/upcoming'
      axios.get(url, options)
        .then(
          ({data}) => {
            this.appointments = data.data
            this.pagination = {
              total: data.total,
              per_page: data.per_page, // required
              current_page: data.current_page, // required
              last_page: data.last_page, // required
              from: data.from,
              to: data.to
            }
            console.log(JSON.stringify(data))
          }
        )
    },
    checkout (appointment) {
      var url = 'http://localhost/techfriar/api/checkout'
      axios.post(url, appointment)
        .then(
          ({data}) => {
            this.checkoutDetails = data
            console.log(JSON.stringify(data))
            this.loadAppointments()
          }
        )
    },
    saveAppointment () {
      var url = 'http://localhost/techfriar/api/save_appointment'
      this.appointment.id = ''
      axios.post(url, this.appointment)
        .then(
          ({data}) => {
            this.appointments = data
            console.log(JSON.stringify(data))
            this.loadAppointments()
            alert(data.status)
            this.appointment.id = ''
            this.appointment.cust_name = ''
            this.appointment.phone = ''
            this.appointment.license_path = ''
            this.appointment.vehicle_number = ''
            this.appointment.start_date_time = ''
            this.appointment.end_date_time = ''
          }
        )
    },
    updateAppointment () {
      var url = 'http://localhost/techfriar/api/save_appointment'
      axios.post(url, this.appointment)
        .then(
          ({data}) => {
            this.appointments = data
            console.log(JSON.stringify(data))
            this.loadAppointments()
            alert(data.status)
            this.appointment.id = ''
            this.appointment.cust_name = ''
            this.appointment.phone = ''
            this.appointment.license_path = ''
            this.appointment.vehicle_number = ''
            this.appointment.start_date_time = ''
            this.appointment.end_date_time = ''
          }
        )
    },
    edit (appointment) {
      this.appointment = appointment
    },
    mDelete (appointment) {
      this.appointment = appointment
    },
    deleteAppointment () {
      var url = 'http://localhost/techfriar/api/delete_appointment'
      axios.post(url, this.appointment)
        .then(
          ({data}) => {
            this.appointments = data
            console.log(JSON.stringify(data))
            this.loadAppointments()
          }
        )
    }
  }
}
</script>
