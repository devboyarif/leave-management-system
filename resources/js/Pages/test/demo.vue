<template>
    <div class="card">
        <div class="card-body">
             <QuillEditor theme="snow" v-model:content="myContent" contentType="html"/>
        </div>

        {{ myContent }}
    </div>
</template>


<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import '@vueup/vue-quill/dist/vue-quill.bubble.css';

export default {
    components: {
    QuillEditor
  },
  data(){
    return {
        myContent : 'asdas'
    }
  }
};
</script>
