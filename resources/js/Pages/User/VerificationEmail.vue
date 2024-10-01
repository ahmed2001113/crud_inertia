<template>
  <div class="container">
    <div class="row my-3">
      <div class="col-md-6">
        <div class="alert alert-primary">please verify your email</div>
         <form @submit.prevent="sendVerificationLink">
          <button type="submit" class="btn btn-danger">إرسال رابط التحقق</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setUp>

import { Link } from '@inertiajs/vue3';

function sendVerificationLink() {
  Inertia.post(route('verification.send'));
}

</script>
