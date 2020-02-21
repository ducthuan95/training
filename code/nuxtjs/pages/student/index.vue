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
        <b-alert v-if="message.length" show variant="success">{{message}}</b-alert>
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
          <tr v-for="(item, index) in students">
            <td>{{(currentPage - 1) * perPage + index + 1}}</td>
            <td>
              <NLink :to="{name:'student-edit-id', params: {id:item.id}}">{{item.code}}</NLink>
            </td>
            <td>{{item.name}}</td>
            <td>{{item.age}}</td>
            <td>
              <i v-if="item.gender === 1" class="fa fa-mars"></i>
              <i v-if="item.gender === 0" class="fa fa-venus"></i>
            </td>
            <td>{{item.email}}</td>
            <td>{{item.address}}</td>
            <td>
              <NLink :to="{name: 'student-edit-id', params: {id: item.id}}"><i class="fa fa-edit text-dark"></i></NLink>
              <a @click="deleteS(item.id)"><i class="fa fa-trash text-danger"></i></a>
            </td>
          </tr>
          </tbody>
        </table>
        <div class="text-center">
          <div class="pr-3 d-inline">
            Page: <strong>{{currentPage}}</strong>/{{totalPage}}
          </div>
          <button
            :class="{'disabled': currentPage <= 1}"
            class="btn btn-outline-info mr-3"
            @click="prevPage"
          >
            Prev
          </button>
          <button
            :class="{'disabled': currentPage >= totalPage}"
            class="btn btn-outline-info"
            @click="nextPage"
          >
            Next
          </button>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
  export default {
    name: "index",
    data() {
      return {
        students: [],
        currentPage: 1,
        totalPage: 1,
        perPage: 10,
        tmpPage: 0,
        //loadDataDone: false,
        message: ''
      }
    },
    async asyncData({$axios, route }) {
      let page = route.query.page == undefined ? 1 : route.query.page
      let message = route.params.message == undefined ? '' : route.params.message
      const data = await $axios.$get(`api/student?page=${page}`)
      return {
        students: data.data,
        currentPage: data.current_page,
        tmpPage: data.current_page,
        totalPage: data.last_page,
        perPage: data.per_page,
        message: message
      }
    },
    methods: {
      async loadData(page) {
        const data = await this.$axios.$get(`api/student?page=${this.tmpPage}`)
        this.students = data.data
        if (this.students.length == 0) {
          return this.$router.push({name: 'student'})
        }
        this.currentPage = data.current_page,
          this.tmpPage = data.current_page
        this.totalPage = data.last_page
        this.perPage = data.per_page
        await this.$router.push({name: 'student', query: {page: this.tmpPage}})
      },
      nextPage() {
        if (this.currentPage >= this.totalPage) {
          return;
        }
        this.tmpPage++;
        this.loadData(this.tmpPage);
      },
      prevPage() {
        if (this.currentPage <= 1) {
          return;
        }
        this.tmpPage--;
        this.loadData(this.tmpPage);
      },
      deleteS(id) {
        this.$bvModal.msgBoxConfirm('Are you sure?')
          .then(value => {
            if (value) {
              this.deleteStudent(id)
            }
          })
      },
      async deleteStudent(id) {
        await this.$axios.$delete(`api/student/${id}`)
        this.message = 'Delete student success.';
        location.reload()
      },
    }
  }

</script>

<style scoped>

</style>
