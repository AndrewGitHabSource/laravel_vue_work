<template>
  <v-form ref="sendForm" lazy-validation class="pa-5">
    <v-text-field v-model="form.title" label="Title" required></v-text-field>

    <v-textarea v-model="form.description" clearable clear-icon="mdi-close-circle" label="description"></v-textarea>

    <v-btn dark text @click="save">
      Save
    </v-btn>

    <v-btn color="error" class="mr-4" @click="reset">
      Reset Form
    </v-btn>
  </v-form>
</template>

<script>
  import { inject, reactive, onMounted, ref, watch, computed, toRefs  } from "vue";
  import { savePosition } from "../../../endpoints";
  import { useRoute } from 'vue-router';
  export default {
    props: {
      position: {
        type: Object,
        required: true,
      },
      edit: Boolean,
    },
    setup(props, {emit}) {
      let router = inject("router");
      let form = reactive({
        id: null,
        title: '',
        description: '',
      });
      const positionObject = toRefs(props.position);

      const initPosition = (data) => {
        form.id = data?.id ?? null;
        form.title = data?.title ?? '';
        form.description = data?.description ?? '';
      }

      onMounted(() => {
        initPosition(positionObject);
      });

      const save = async () => {
        try {
          await savePosition(form);
          emit("save", true);
        } catch (error) {
          console.log(error);
        }
      }

      const reset = () => {
        initPosition(false);
      }

      return {
        form,
        save,
        reset,
      }
    }
  }
</script>

<style scoped>

</style>