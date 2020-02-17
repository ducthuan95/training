<template>
  <div>
    <div class="container">
      <form>
        <div class="form-group">
          <label>Student code <small class="text-danger">*</small></label>
          <input v-model="student.code"
                 type="text" class="form-control">
        </div>
        <div class="form-group">
          <label>Name <small class="text-danger">*</small></label>
          <input v-model="student.name" :rules="rules.nameRules" type="text" class="form-control">

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
          <input v-model="student.email" :rules="rules.emailRules" type="text" class="form-control">
          <lable :message="rules.emailRules"></lable>
        </div>
        <div class="form-group">
          <label>Address <small class="text-danger">*</small></label>
          <input v-model="student.address" type="text"
                 class="form-control">

        </div>

        <NLink class="btn btn-outline-primary" :to="{name: 'student'}">
          <i class="fa fa-chevron-left"></i> Back
        </NLink>
        <button type="button" class="btn btn-primary" @click="addStudent">
          <i class="fa fa-save"></i> Save
        </button>
      </form>
    </div>
  </div>
</template>

<script>

  export default {
    data() {
      return {
        student: {},
        rules: {
          nameRules:[
            v => !!v || 'Name is required',
            v => (v && v.length <= 20) || 'Name must be less than 20 characters',
            v => (v && v.length >= 3) || 'Name must be at least 3 characters',
          ],
          emailRules:[
            v => !!v || 'Email is required',
            v => /.+@.+/.test(v) || 'E-mail must be valid'
          ]
        },
        valid:false
      }
    },
    methods: {
      async addStudent() {
        await this.$axios.$post(`api/student`, this.student).then((data) => {
          this.$router.push({name: 'student', params: {message: 'Create student success.'}})
        }).catch((error) => {

        });
      }
    }
  }
</script>

<style scoped>
</style>
