<template>
  <div class="container">
    <div class="row my-5">
      <div class="col-md-9">
        <Search />
        <div v-if="$page.props.flash.message" :class="$page.props.flash.class">
            {{$page.props.flash.message}}
        </div>
        <div class="card">
          <div class="card-body">
            <table class="table">
              <thead>
                <th>ID</th>
                <th>Title</th>
                <th>Body</th>
                <th>Category</th>
                <th>By</th>
                <th>Done</th>
                <th>Create</th>
                <th>Actions</th>
              </thead>
              <tbody>
                <tr v-for="task in tasks.data" :key="task.id">
                  <td>{{ task.id }}</td>
                  <td>{{ task.title }}</td>
                  <td>{{ task.body }}</td>
                  <td>{{ task.category.name }}</td>
                  <td>{{ task.user.name }}</td>
                  <td>
                    <div v-if="task.done">
                      <span class="badge bg-success"> Done </span>
                    </div>
                    <div v-else>
                      <span class="badge bg-danger"> Processing... </span>
                    </div>
                  </td>
                  <td>{{ task.created_at }}</td>
                  <td class="d-flex">
                    <Link :href="route('tasks.edit',task.id)" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </Link>
                    <button @click="deleteTask(task)" class="btn btn-sm btn-danger mx-1">
                        <i class="fas fa-trash"></i>
                    </button>
                    </td>
                </tr>
              </tbody>
            </table>
                <ul class="pagination d-flex justify-content-center">
                    <li :class="`page-item ${link.active ? 'active' : '' }`" v-for="(link , index) in tasks.links" :key="index">
                        <Link class="page-link" :href="link.url" v-if="link.url !== null"  v-html="link.label">
                        </Link>
                        <div v-else class="page-link" v-html="link.label">
                        </div>
                    </li>
                </ul>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <Category :categories="categories"/>
        <Order />
      </div>
    </div>
  </div>
</template>

<script setup>
import {Link, router} from '@inertiajs/vue3';
import Category from '@/Component/Category.vue';
import Order from '@/Component/Order.vue';
import Search from '@/Component/Search.vue';
import Swal from 'sweetalert2' ;
const props = defineProps({
  tasks: {
    type: Object,
    required: true,
  },
  categories: {
    type: Array,
    required: true,
  },
});

const deleteTask = (task) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route('tasks.destroy',task.id));
        }
    });
}
</script>
