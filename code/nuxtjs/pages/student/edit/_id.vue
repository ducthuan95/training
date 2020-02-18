<template>
  <div>
    <h2>Edit student </h2>
      <form>
        <div class="form-group">
          <label>Student code <small class="text-danger">*</small></label>
          <input v-model="student.code" readonly type="text" class="form-control">
        </div>
        <div class="form-group">
          <label>Name <small class="text-danger">*</small></label>
          <input v-model="student.name" type="text" class="form-control">

        </div>
        <div class="form-group">
          <label>Age <small class="text-danger">*</small></label>
          <input v-model="student.age" type="text" class="form-control">

        </div>
        <div class="form-group">
          <label>Gender <small class="text-danger">*</small></label>
          <select v-model="student.gender" class="form-control">
            <option value="">-- Select --</option>
            <option value="1">Male</option>
            <option value="0">Female</option>
          </select>

        </div>
        <div class="form-group">
          <label>Email <small class="text-danger">*</small></label>
          <input v-model="student.email" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label>Address <small class="text-danger">*</small></label>
          <input v-model="student.address" type="text"
                 class="form-control">

        </div>

        <NLink class="btn btn-outline-primary" :to="{name: 'student'}">
          <i class="fa fa-chevron-left"></i> Back
        </NLink>
        <button type="button" class="btn btn-primary" @click="editStudent">
          <i class="fa fa-save"></i> Save
        </button>
      </form>
  </div>
</template>

<script>
    export default {
      data() {
        return {
          student: {
            code: '',
            name: '',
            email: '',
            address: '',
            age: '',
            gender: ''
          },
        }
      },
      methods: {
        async editStudent() {
          await this.$axios.$put('api/student/${this.student.id}', this.student).then((data) => {
            this.$router.push({name: 'student', params: {message: 'Edit student success.'}})
          }).catch((error) => {

          });
        }
      },
      name: "_id",

    }
</script>

<style scoped>

</style>
