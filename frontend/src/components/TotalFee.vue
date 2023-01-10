<template>
    <div>
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b>Total Fee Collected</b></h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><h1>Rs. {{total}} Collected</h1></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'

Vue.use(axios)
export default {
  name: 'TotalFee',
  data () {
    return {
      total: 0
    }
  },
  created () {
    this.loadTotalList()
  },
  methods: {
    loadTotalList () {
      var url = 'http://localhost/techfriar/api/total_list'
      axios.get(url)
        .then(
          ({data}) => {
            this.total = data.total
          }
        )
    }
  }
}
</script>
