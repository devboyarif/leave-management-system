<template>
<div class="mt-5"></div>
      <vue-tel-input v-model="phone" mode="international"></vue-tel-input>

{{ phone }}
</template>

<script>
  import { VueTelInput } from 'vue-tel-input';
  import 'vue-tel-input/dist/vue-tel-input.css';

export default {
 components: {
      VueTelInput,
    },
    data(){
        return {
            phone: '',
        }
    }
}
</script>
