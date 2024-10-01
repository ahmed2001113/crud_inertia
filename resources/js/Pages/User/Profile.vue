<template>
  <div class="container">
    <div class="row my-5">
      <div class="col-md-3">
        <div v-if="$page.props.flash.message" :class="$page.props.flash.class">
          {{ $page.props.flash.message }}
        </div>
        <div class="card">
          <div class="card-body">
            <img
              :src="user.data.photo_url"
              alt="Profile Image"
              class="img-fluid rounded"
            />
            <form @submit.prevent="uploadFile">
              <div class="mt-3">
                <label for="formFile" class="mb-2">Change Profile Image</label>
                <input
                  type="file"
                  id="formFile"
                  @input="setPhotoUrl"
                  class="form-control"
                />
                   <div v-if="form.errors.photo_url" class="bg-danger text-white rounded p-2">{{ form.errors.photo_url[0] }}</div>
              </div>
              <div class="mt-3">
                <button :disabled="!form.photo_url" class="btn btn-primary">
                  Save
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item">
                <span class="fw-bold">User Name : </span>{{ user.data.name }}
              </li>
              <li class="list-group-item">
                <span class="fw-bold">Email : </span>{{ user.data.email }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const form = useForm({
  photo_url: "",
});

const setPhotoUrl = (e) => {
  form.photo_url = e.target.files[0];
};

const user = computed(() => {
  const pageProps = usePage().props;
  return pageProps.user ? pageProps.user : null;
});

const uploadFile = () => {
  form.post(
    route("profile", {
      onSuccess: () => {
        form.reset("photo_url");
      },
    })
  );
};
</script>

