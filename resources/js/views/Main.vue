<template>
  <div>
    <div>
      <add-form @reloadList="getList()" @remove-item="getList()" :vendors="vendors"/>
    </div>
  </div>
</template>

<script>
  import AddForm from './AddForm.vue'
  export default {
    name: "Main",
    components: {
      AddForm
    },
    data () {
      return {
        vendors: [],
      }
    },
    methods: {
      getList() {
        axios.get('api/vendor/')
        .then(response => {
          this.vendors = response.data.data
          console.log(this.vendors)
        })
        .catch(error => {
          console.log(error.data)
        })
      },
      getItem(id) {
        axios.get(`api/vendor/item/${id}`)
        .then(response => {
          if(response.status == 200) {
            console.log(response.data)
            this.item = response.data
          }
        })
        .catch(error => {
          console.log(error.data)
        })
      }
    },
    created() {
      this.getList()
    }
  }
</script>

