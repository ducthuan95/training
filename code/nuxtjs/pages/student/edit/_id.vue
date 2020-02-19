<template>
  <div>
    <h2>Edit student </h2>
    <form>
      <div class="form-group">
        <label>Student code <small class="text-danger">*</small></label>
        <input v-model="student.code" :class="{'is-invalid': checkError(errors.code)}" type="text" class="form-control" :readonly="student.code" >
        <span style="color: red" v-if="errors.code "> {{errors.code}} </span>
      </div>
      <div class="form-group">
        <label>Name <small class="text-danger">*</small></label>
        <input v-model="student.name" :class="{'is-invalid': checkError(errors.name)}" type="text" class="form-control">
        <span style="color: red" v-if="errors.name "> {{errors.name}} </span>

      </div>
      <div class="form-group">
        <label>Age <small class="text-danger">*</small></label>
        <input :class="{'is-invalid': checkError(errors.age)}" v-model="student.age" type="text" class="form-control">
        <span style="color: red" v-if="errors.age "> {{errors.age}} </span>

      </div>
      <div class="form-group">
        <label>Gender <small class="text-danger">*</small></label>
        <span style="color: red" v-if="errors.gender "> {{errors.gender}} </span>
        <select v-model="student.gender" :class="{'is-invalid': checkError(errors.gender)}" class="form-control">
          <option value="">-- Select --</option>
          <option value="1">Male</option>
          <option value="0">Female</option>
        </select>

      </div>
      <div class="form-group">
        <label>Email <small class="text-danger">*</small></label>
        <input v-model="student.email" :class="{'is-invalid': checkError(errors.email)}" type="text" class="form-control">
        <span style="color: red" v-if="errors.email "> {{errors.email}} </span>
      </div>
      <div class="form-group">
        <label>Address <small class="text-danger">*</small></label>
        <input v-model="student.address" :class="{'is-invalid': checkError(errors.address)}" type="text"
               class="form-control">
        <span style="color: red" v-if="errors.address "> {{errors.address}} </span>
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
    async asyncData({$axios, route}) {
      let id = route.params.id == 0 ? '' : route.params.id
      const student = await $axios.$get(`api/student/${id}`)
      return {student}
    },
    data() {
      return {
        errors: {
          code: '',
          name: '',
          age: '',
          gender: '',
          email: '',
          address: '',
        },
        student: {
          type: Object,
          code: '',
          name: '',
          age: '',
          gender: '',
          address: '',
          email: ''
        },
      }
    },

    methods: {
      checkError(message) {
        return message.length > 0
      },
      validateForm() {
        Object.keys(this.errors).forEach(key => {
          this.$set(this.errors, key, '')
        })
        Object.keys(this.student).forEach(key => {
          this.$set(this.student, key, this.student[key].toString().trim())
        })
        //check student code
        if (this.student.code.length == 0) {
          this.errors.code = 'The code field is required.'
        }

        if (this.student.name.length == 0) {
          this.errors.name = 'The name field is required'
        }
        if (this.student.email.length == 0) {
          this.errors.email = 'The email field is required'
        }
        if (this.student.address.length == 0) {
          this.errors.address = 'The address field is required'
        }
        if (this.student.age.length == 0) {
          this.errors.age = 'The age field is required'
        }

        if (this.student.gender.length == 0) {
          this.errors.gender = 'The gender field is required'
        }


        this.isError = false
        Object.keys(this.errors).forEach(key => {
          if (this.errors[key].length > 0) {
            this.isError = true;
          }
        })
      },
      async editStudent({$axios, route}) {
        this.validateForm()
        if (this.isError) {
          return
        }
        await this.$axios.$put(`api/student/${this.student.id}`, this.student)
          .then((data) => {
          this.$router.push({name: 'student'})
        }).catch((error) => {
            if (error.status === 422) {
              this.errorInputs = error.body
            }
        });
      }
    }
  }
</script>

<style scoped>

</style>
