<template>
  <div>
      <div class="mx-auto">
        <div class="card">
          <div v-if="showAlert" class="alert alert-success text-center">{{message}}</div>
          <div class="card-header">
            <h2 v-if="showAddFormHeader">Add Item</h2>
            <h2 v-if="showUpdateFormHeader">Update Item</h2>
          </div>
          <div class="card-body">
            <form @submit="onSubmit">
                <input type="hidden" name="id" v-model="id" class="form-control">
              <div class="form-group mt-2">
                <label for="">Name</label>
                <input type="text" name="name" v-model="name" class="form-control">
              </div>
              <div class="form-group mt-3">
                <label for="">Category</label>
                <input type="text" name="category" v-model="category" class="form-control">
              </div>
              <div class="form-group mt-3">
                <input type="submit" id="submitBtn" value="Save" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- View vendors list -->
      <div  class="mt-4">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Category</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(vendor, index) in vendors" :key="index">
              <td scope="row">{{vendor.id}}</td>
              <td>{{vendor.name}}</td>
              <td>{{vendor.category}}</td>
              <td>
                <div class="text-center" @click="editVendor(vendor.id, vendor.name, vendor.category)">
                  <span class="fa fa-pen"></span>
                </div>
              </td>
              <td>
                <div class="text-center" @click="deleteVendor(vendor.id)">
                  <span class="fa fa-trash"></span>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</template>

<script>
  export default {
    name: "AddForm",
    props: {
      vendors: Array,
    },
    data () {
      return {
        "id": "",
        "name" : "",
        "category" : "",
        "message": "",
        showAlert: false,
        showAddFormHeader: true,
        showUpdateFormHeader: false
      }
    },
    methods: {
      onSubmit(e) {
        e.preventDefault()
        if(this.name == "" || this.category == "") {
          alert('Input field is required')
        }
        if(this.id == ""){
          // Store new vendor
          axios.post('api/vendor/store', {
            name: this.name,
            category: this.category
          })
          .then(response => {
            if(response.status = 201) {
              this.name = '',
              this.category = ''
              this.$emit('reloadList')
            }
          })
          .catch(error => {
            console.log(error.data)
          })
        }else{
          // Update vendor
          axios.put('api/vendor/' + this.id, {
            name: this.name,
            category: this.category
          })
          .then(response => {
            if(response.status = 200) {
              this.name = '',
              this.category = ''
              this.$emit('reloadList')
              this.message = response.data.Message
              this.showAlert = !this.showAlert
              setTimeout(() => {
                this.showAlert = !this.showAlert
              }, 5000);
              this.showAddFormHeader =true
              this.showUpdateFormHeader =false
            }
          })
          .catch(error => {
            console.log(error.data)
          })
        } 
      },
      // Edit Vendor
      editVendor(id, name, category){
        this.id = id
        this.name = name
        this.category = category
        this.showAddFormHeader = false
        this.showUpdateFormHeader = true
      },
      // Delete vendor
      deleteVendor(id) {
        if(confirm("Are you sure")) {
          axios.delete(`api/vendor/${id}`) 
          .then(Response => {
              if(Response.status == 200) {
                this.$emit('remove-item')
              }
          })
        }
      }
    }
  }
</script>

