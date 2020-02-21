<template>
  <div>
    <h2>Edit student </h2>
    <form>
      <div class="form-group">
        <label>Student code <small class="text-danger">*</small></label>
        <input v-model="student.code" :class="{'is-invalid': checkError(errors.code)}" type="text" class="form-control" :readonly="student.code" >
        <span style="color: red" v-if="errors.code.length > 0 "> {{errors.code}} </span>
      </div>
      <div class="form-group">
        <label>Name <small class="text-danger">*</small></label>
        <input v-model="student.name" :class="{'is-invalid': checkError(errors.name)}" type="text" class="form-control">
        <span style="color: red" v-if="errors.name "> {{errors.name}} </span>

      </div>
      <div class="form-group">
        <label>Age <small class="text-danger">*</small></label>
        <input :class="{'is-invalid': checkError(errors.age)}" v-model="student.age" type="number" class="form-control">
        <span style="color: red" v-if="errors.age "> {{errors.age}} </span>

      </div>
      <div class="form-group">
        <label>Gender <small class="text-danger">*</small></label>
        <select v-model="student.gender" :class="{'is-invalid': checkError(errors.gender)}" class="form-control">
          <option value="">-- Select --</option>
          <option value="1">Male</option>
          <option value="0">Female</option>
        </select>
        <span style="color: red" v-if="errors.gender "> {{errors.gender}} </span>
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
        console.log(this.student.code.indexOf( ''))
        if (this.student.code.length == 0) {
          this.errors.code = 'The code field is required.'
        }else if (this.student.code.length >= 255) {
          this.errors.code = 'The code may not be greater than 255 characters.'
        }if (this.student.code.indexOf('') != 0) {
          this.errors.code = 'Student code must not contain spaces.'
        }

        if (this.student.name.length == 0) {
          this.errors.name = 'The name field is required'
        }else if (this.student.name.length >= 255) {
          this.errors.name = 'The name may not be greater than 255 characters.'
        }

        if (this.student.email.length == 0) {
          this.errors.email = 'The email field is required'
        }else if (this.student.email.length >= 255) {
          this.errors.email = 'The email may not be greater than 255 characters.'
        }else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.student.email) == false) {
          this.errors.email = 'The email must be a valid email address.'
        }

        if (this.student.address.length == 0) {
          this.errors.address = 'The address field is required'
        }else if (this.student.email.length >= 255) {
          this.errors.address = 'The address may not be greater than 255 characters.'
        }


        if (this.student.age.length == 0) {
          this.errors.age = 'The age field is required'
        }else if(this.student.age > 50) {
          this.errors.age = 'The age field max 50'
        }else if (this.student.age < 18) {
          this.errors.age = 'The age field min 18'
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
        console.log(this.isError)
        if (this.isError) {
          return
        }
        await this.$axios.$put(`api/student/${this.student.id}`, this.student)
          .then((data) => {
          this.$router.push({name: 'student'})
        }).catch((error) => {
        });
      }
    }
  }
</script>

<style scoped>

</style>
