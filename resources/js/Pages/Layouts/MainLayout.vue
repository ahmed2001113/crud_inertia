<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <Link class="nav-link active" :href="route('home')" aria-current="page">
              <i class="fas fa-home"></i> Home
            </Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="route('tasks.create')">
              <i class="fas fa-pencil"></i> Create Task
            </Link>
          </li>
        </ul>
        <ul v-if="!user" class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <Link class="nav-link active" :href="route('login')" aria-current="page">
              <i class="fas fa-sign-in"></i> Login
            </Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" :href="route('register')">
              <i class="fas fa-user-plus"></i> Register
            </Link>
          </li>
        </ul>
        <ul v-else class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <Link class="nav-link active notificationNumberLink" :href="route('notification')" aria-current="page">
              <i class="fas fa-bell"></i> <span class="badge bg-danger notificationNumber" v-if="user.notifications > 0" >{{ user.notifications }}</span>
            </Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link active" :href="route('profile')" aria-current="page">
              <i class="fas fa-user"></i> {{ user.data.name }}
            </Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link border-0 bg-white" method="post" as="button" :href="route('logout')">
              <i class="fas fa-sign-out"></i> Logout
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <slot></slot>
</template>

<script setup>
import { Link , usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const user = computed(() => {
    const pageProps = usePage().props;
    return pageProps.user ? pageProps.user : null;
});
</script>
