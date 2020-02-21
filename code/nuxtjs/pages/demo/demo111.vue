<template>
  <div class="">
    <h1 @click="method1">Demo 11111</h1>
    <NLink :to="{name: 'index'}">
      Home {{bgColor}}
    </NLink>


    <input type="text" v-model="student.name">

    <input type="text" v-model="student.address">

    <pre>
      {{student}}
    </pre>

  </div>
</template>

<script>
  export default {
    data() {
      return {
        bgColor: 'red',
        student: {
          name: '',
          address: ''
        }
      }
    },

    beforeCreate() {
      console.log('----> beforeCreate');
    },
    created() {
      console.log('----> created');
    },
    beforeMount() {
      console.log('----> beforeMount');
    },
    mounted() {
      console.log('----> mounted');
    },
    beforeDestroy() {
      console.log('----> beforeDestroy');
    },
    destroyed() {
      console.log('----> destroyed');
    },

    methods: {
      method1() {
        this.bgColor
      },
      method2() {
        this.method1();
      }
    }
  }
</script>

<style scoped>

</style>
