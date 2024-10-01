<template>
  <div class="container">
    <div class="row my-4">
        <div v-if="$page.props.flash.message" :class="$page.props.flash.class">
            {{$page.props.flash.message}}
        </div>
      <div class="col-md-10 mx-auto">
        <div class="card">
          <div class="card-body">
            <ul class="list-group" v-if="notifications.length">
              <li
                class="list-group-item d-flex justify-content-between"
                v-for="notification in notifications"
                :key="notification.id"
              >
                <span class="fw-bold">
                  Your task
                  <u class="text-danger">
                    {{ notification.data.title }}
                  </u>
                  has been removed by admin.
                </span>
                <Link
                  class="btn btn-primary"
                  :href="route('read.notification', notification.id)" v-if="!notification.read_at"
                  >Mark As Read</Link>
                <Link
                  class="btn btn-danger"
                  :href="route('delete.notification', notification.id)" v-else
                  ><i class="fas fa-trash"></i></Link>
              </li>
            </ul>
            <div class="alert alert-primary" v-else>No Notifications !</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
  notifications: {
    type: Array,
    required: true,
  },
});
</script>
