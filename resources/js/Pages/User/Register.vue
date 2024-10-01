<template>
  <div class="container">
    <div class="row my-5">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <div class="card-header bg-white">
            <h5 class="text-center mt-2">Regester</h5>
          </div>
          <div class="card-body">
            <form @submit.prevent="register">
              <div class="mb-3">
                <label for="name">Name*</label>
                <input type="text" v-model="form.name" class="form-control" placeholder="Name*" />
                   <div v-if="form.errors.name" class="bg-danger text-white rounded p-2">{{ form.errors.name[0] }}</div>
              </div>
              <div class="mb-3">
                <label for="email">Email*</label>
                <input type="email" v-model="form.email" class="form-control" placeholder="Email*" />
                <div v-if="form.errors.email" class="bg-danger text-white rounded p-2">{{form.errors.email[0]}}</div>
              </div>
              <div class="mb-3">
                <label for="password">Password*</label>
                <input type="password" v-model="form.password" class="form-control" placeholder="Password*" />
                <div v-if="form.errors.password" class="bg-danger text-white rounded p-2">{{form.errors.password[0]}}</div>
              </div>

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
import { useForm } from "@inertiajs/vue3";
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

import { usePage } from '@inertiajs/vue3'

const { props } = usePage()

const form = useForm({
    name: '',
    email: '',
    password: '',
    errors: props.errors || {},
});

const register = () => {
    form.post(route('register'));
};

</script>

