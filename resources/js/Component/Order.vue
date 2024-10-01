<template>
  <div class="card my-3">
    <div class="card-body d-flex justify-content-center">
      <div class="dropdown">
        <button
          class="btn btn-secondary dropdown-toggle"
          type="button"
          id="dropdownMenuButton1"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
            Order By
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li>
                <Link class="dropdown-item" :href="route('order.tasks' , ['id','asc'])">
                ID <i class="fas fa-arrow-up"></i>
                </Link>
            </li>
            <li>
                <Link class="dropdown-item" :href="route('order.tasks' , ['id','desc'])">
                ID <i class="fas fa-arrow-down"></i>
                </Link>
            </li>
            <li>
                <Link class="dropdown-item" :href="route('order.tasks' , ['title','asc'])">
                Title A - Z
                </Link>
            </li>
            <li>
                <Link class="dropdown-item" :href="route('order.tasks' , ['title','desc'])">
                Title Z - A
                </Link>
            </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
