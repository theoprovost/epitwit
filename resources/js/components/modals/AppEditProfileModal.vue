<template>
    <div>
        <form @submit.prevent="submit">
            <div class="flex justify-between p-2 text-gray-300 text-xl mr-12 ml-12">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" v-model="fields.name" class="rounded-md text-gray-800">
            </div>
            <div v-if="errors && errors.name" class="text-red-300 text-sm text-center">{{ errors.name[0] }}</div>
            <div class="flex justify-between p-2 text-gray-300 text-xl mr-12 ml-12">
                <label for="biography">Bio</label>
                <textarea name="biography" v-model="fields.biography" class="rounded-md text-gray-800" style="width:209px"></textarea>
            </div>
            <div class="flex justify-between p-2 text-gray-300 text-xl mr-12 ml-12">
                <label for="country">Country</label>
                <input type="text" name="country" v-model="fields.country" class="rounded-md text-gray-800">
            </div>
             <div class="flex justify-between p-2 text-gray-300 text-xl mr-12 ml-12">
                <label for="city">City</label>
                <input type="text" name="city" v-model="fields.city" class="rounded-md text-gray-800">
            </div>
            <div class="flex justify-between p-2 pb-6 text-gray-300 text-xl mr-12 ml-12">
                <label for="website">Website</label>
                <input type="text" name="website" v-model="fields.website" class="rounded-md text-gray-800">
            </div>
            <div class="flex justify-between p-2 pb-6 text-gray-300 text-xl mr-12 ml-12">
                <label for="dob">Birth date</label>
                <input type="date" name="dob" v-model="fields.dob" class="rounded-md text-gray-800">
            </div>
            <div class="flex flex-wrap-reverse justify-end">
                <input type="submit" value="Submit" class="text-gray-300 bg-blue-500 rounded-lg p-2 text-center cursor-pointer" @click="$emit('close')">
            </div>
        </form>
        <div class="flex flex-wrap-reverse -mt-10">
                <button class="text-red-500 border-red-500 border rounded-lg p-2 hover:bg-red-500 hover:text-gray-300 text-center" @click="$emit('close')">X Close</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      fields: {},
      errors: {},
    }
  },
  methods: {
    submit() {
      this.errors = {};
      axios.post('./api/submit', this.fields)
      .catch(error => {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors || {};
        }
      });
    },
  },
  props: {
        user: {
            required: true,
            type: Object,
        },
    },
    mounted() {
        Vue.set(this.fields, 'name', this.user.name);
        Vue.set(this.fields, 'dob', this.user.dob);
        Vue.set(this.fields, 'website', this.user.website);
        Vue.set(this.fields, 'country', this.user.country);
        Vue.set(this.fields, 'city', this.user.city);
        Vue.set(this.fields, 'biography', this.user.biography);
    }
}
</script>
