<template>
  <div>
    <div class="container">
      <div class="row">
        <form>
          <div class="form-group">
            <label>Student code</label>
            <input type="text" class="form-control" v-model="student.code">

            <label>Name</label>
            <input type="text" class="form-control" v-model="student.name">

            <label>Age </label>
            <input type="text" class="form-control" v-model="student.age">

            <lable>Gender</lable>
            <select name="" id="">
              <option value="">--Select--</option>
              <option value="1">Nam</option>
              <option value="0">Nữ</option>
            </select>

            <label>Email </label>
            <input type="text" class="form-control" v-model="student.email">

            <label>Address </label>
            <input type="text" class="form-control" v-model="student.address">
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        student: {
          code: '',
          name: '',
          age: '',
          email: '',
          address: ''
        }
      }
    }
  }
</script>

<style scoped>

</style>
