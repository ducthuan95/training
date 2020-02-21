<template>
  <div>
    <h2>Create Student</h2>
    <div>
      <form>
        <div class="form-group">
          <label>Student code <small class="text-danger">*</small></label>
          <input :class="{'is-invalid': checkError(errors.code)}" v-model="student.code"
                 type="text" class="form-control">
          <span style="color: red" v-if="errors.code "> {{errors.code}} </span>
        </div>
        <div class="form-group">
          <label>Name <small class="text-danger">*</small></label>
          <input v-model="student.name" :class="{'is-invalid': checkError(errors.name)}" type="text" class="form-control">
          <span style="color: red" v-if="errors.name "> {{errors.name}} </span>
        </div>
        <div class="form-group">
          <label>Age <small class="text-danger">*</small></label>
          <input v-model="student.age" :class="{'is-invalid': checkError(errors.age)}" type="number" class="form-control">
          <span style="color: red" v-if="errors.age "> {{errors.age}} </span>
        </div>
        <div class="form-group">
          <label>Gender <small class="text-danger">*</small></label>
          <select v-model="student.gender" :class="{'is-invalid': checkError(errors.gender)}" class="form-control">
            <option value="">-- Select --</option>
            <option value="1">Male</option>
            <option value="0">Female</option>
          </select>
          <span style="color: red" v-if="errors.gender.length "> {{errors.gender}} </span>

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
        <button type="button" class="btn btn-primary" @click="addStudent">
          <i class="fa fa-save"></i> Save
        </button>
      </form>
    </div>
  </div>
</template>

<script>

  export default {
    layout: 'default',
    data() {
      return {
        student:{
          type: Object,
          code: '',
          name: '',
          age: '',
          gender: '',
          email: '',
          address: ''
        },
        errors: {
          code: '',
          name: '',
          age: '',
          gender: '',
          email: '',
          address: '',
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
        });
        //check student code
        if (this.student.code.length == 0) {
          this.errors.code = 'The code field is required.'
        }else if (this.student.code.length >= 255) {
          this.errors.code = 'The code filed max 255'
        }
        if (this.student.code.indexOf(' ') != -1) {
          this.errors.code = 'Student code must not contain spaces.'
        }
        //console.log(this.student.code.indexOf(' ') == 2)

        if (this.student.name.length == 0) {
          this.errors.name = 'The name field is required'
        }else if (this.student.name.length >= 255) {
          this.errors.name = 'The name filed max 255'
        }

        if (this.student.email.length == 0) {
          this.errors.email = 'The email field is required'
        }else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.student.email) == false) {
          this.errors.email = 'The email must be a valid email address.'
        }else if (this.student.email.length >= 255) {
          this.errors.email = 'The email filed max 255'
        }

        if (this.student.address.length == 0) {
          this.errors.address = 'The address field is required'
        }else if (this.student.address.length >= 255) {
          this.errors.address = 'The address filed max 255'
        }
        const age = this.student.age
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


        this.isError = false;
        Object.keys(this.errors).forEach(key => {
          if (this.errors[key].length > 0) {
            this.isError = true;
          }
        })
      },
      async addStudent() {
        this.validateForm();
        if (this.isError) {
          return
        }
        await this.$axios.$post('api/student', this.student)
        .then((response) => {
          this.$router.push({name: 'student'})
        }).catch((error) => {
        });
      },
    }
  }
</script>

<style scoped>
</style>
