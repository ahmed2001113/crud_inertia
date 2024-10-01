<template>
  <div class="container">
    <div class="row my-5">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <div class="card-header bg-white">
            <h5 class="text-center mt-2">Create New Task</h5>
          </div>
          <div class="card-body">
            <form @submit.prevent="addTask">
              <div class="mb-3">
                <label for="title">Title*</label>
                <input type="text" v-model="form.title" class="form-control" placeholder="Title*" />
                <div v-if="form.errors.title" class="bg-danger text-white rounded p-2">{{form.errors.title[0]}}</div>
              </div>
              <div class="mb-3">
                <label for="body">Body*</label>
                <textarea v-model="form.body"
                  rows="5"
                  cols="30"
                  class="form-control"
                  placeholder="Body*"
                ></textarea>
              </div>
              <div v-if="form.errors.body" class="bg-danger text-white rounded p-2">{{form.errors.body[0]}}</div>
              <div class="mb-3">
                <label for="category">Choose a Category*</label>
                <select class="form-select" v-model="form.category_id">
                  <option disabled selected value="">Choose Category</option>
                  <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
              </div>
              <div v-if="form.errors.category_id" class="bg-danger text-white rounded p-2">{{form.errors.category_id[0]}}</div>
              <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-sm">
                  Create
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm , usePage } from "@inertiajs/vue3";
import { reactive , computed } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  categories: {
    type: Array,
    required: true,
  },
});

const form = useForm({
  title: "",
  body: "",
  category_id: "",
});

const errors = computed(() => {
    const pageProps = usePage().props;
    return pageProps.errors ? pageProps.errors : null;
});

const addTask = () => {
  form.post("/tasks");
};


</script>


