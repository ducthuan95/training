<template>
  <div class="row">
    <div class="col-md-12">
      <div class="grid simple">
        <div  class="grid-title no-border">
          <h2>Student list</h2>
        </div>
        <div>
          <NLink :to="{name: 'index'}"><button class="btn btn-outline-primary">Home Page</button></NLink>
          <NLink :to="{name: 'student-create'}">
            <button class="btn btn-outline-primary">Add new student</button></NLink>
        </div>
      </div>
      <div>
        <table class="table table-striped dataTable">
          <thead>
          <tr>
            <th>No</th>
            <th>Code</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Address</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="item in response">
            <td>{{item.id}}</td>
            <td>{{item.code}}</td>
            <td>{{item.name}}</td>
            <td>{{item.age}}</td>
            <td>{{item.gender}}</td>
            <td>{{item.email}}</td>
            <td>{{item.address}}</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</template>

<script>
  export default {
    async asyncData({$axios}) {
      const response = await $axios.$get('api/student')
      return {response}
    },
    data() {
      return {
        response: {},
      }
    }
  }
</script>

<style scoped>

</style>
