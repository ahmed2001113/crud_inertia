<template>
  <div class="container">
    <div class="row my-5">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <div class="card-header bg-white">
            <h5 class="text-center mt-2">Login</h5>
          </div>
          <div class="card-body">
            <div
              v-if="$page.props.flash.message"
              :class="$page.props.flash.class"
            >
              {{ $page.props.flash.message }}
            </div>
            <form @submit.prevent="login">
              <div class="mb-3">
                <label for="email">Email*</label>
                <input
                  type="email"
                  v-model="form.email"
                  class="form-control"
                  placeholder="Email*"
                />
                <div
                  v-if="form.errors.email"
                  class="bg-danger text-white rounded p-2"
                >
                  {{ form.errors.email[0] }}
                </div>
              </div>
              <div class="mb-3">
                <label for="password">Password*</label>
                <input
                  type="password"
                  v-model="form.password"
                  class="form-control"
                  placeholder="Password*"
                />
                <div
                  v-if="form.errors.password"
                  class="bg-danger text-white rounded p-2"
                >
                  {{ form.errors.password[0] }}
                </div>
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
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";

const form = useForm({
  email: "",
  password: "",
});

const login = () => {
  form.post(route("login"));
};
</script>

