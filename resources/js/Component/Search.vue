<template>
  <div class="row my-3">
    <div class="col-md-4">
      <form @submit.prevent="searchTask">
        <div class="d-flex justify-content-center">
          <div class="form-group">
            <input
              type="text"
              class="form-control border border-dark"
              v-model="form.term"
              placeholder="Search..."
            />
          </div>
          <div class="form-group mx-1">
            <button type="submit" class="btn btn-sm btn-primary" :disabled="!form.term">
                <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3" ;
    const form = useForm({
        term : ''
    });

    const searchTask = ()=>{
        form.get(route('search.tasks'));
    }
</script>
