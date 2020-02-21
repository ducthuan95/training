<template>
  <div>
    <div v-for="item in response">
      <div>Name: {{item.name}}</div>
      <div>Age: {{item['age']}}</div>
      <hr>
    </div>
    <pre>
      {{response}}
    </pre>
  </div>
</template>

<script>
  export default {
    async asyncData({$axios}) {
      const response = await $axios.$get('v2/student')
      return {response}
    },
    data() {
      return {
        response: {},
        items: [
          {name: 'ten', age: 111},
          {name: 'ten 22222', age: 111}
        ]
      }
    }
  }
</script>

<style scoped>

</style>
