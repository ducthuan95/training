<template>
  <div class="row">
    <div class="col-md-12">
      <div class="grid simple">
        <div class="grid-title no-border">
          <h2>Student list</h2>
        </div>
        <div>
          <NLink :to="{name: 'index'}">
            <button class="btn btn-outline-primary"><i class="fa fa-home"></i>Home Page</button>
          </NLink>
          <NLink :to="{name: 'student-create'}">
            <button class="btn btn-outline-primary"><i class="fa fa-plus"></i>Add new student</button>
          </NLink>
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
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(item, index) in response">
            <td>{{index+1}}</td>
            <td><NLink :to="{name:'student-edit-id', param: {id:item.id}}">{{item.code}}</NLink></td>
            <td>{{item.name}}</td>
            <td>{{item.age}}</td>
            <td>
              <i v-if="item.gender === 1" class="fa fa-mars"></i>
              <i v-if="item.gender === 0" class="fa fa-venus"></i>
            </td>
            <td>{{item.email}}</td>
            <td>{{item.address}}</td>
            <td>
              <NLink :to="{name: 'student-edit-id', param:{id: item.id}}"><i class="fa fa-edit text-dark"></i></NLink>
              <a><i class="fa fa-trash text-danger"></i></a>
            </td>
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
