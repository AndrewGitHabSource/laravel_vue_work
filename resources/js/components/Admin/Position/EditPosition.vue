<template>
  <div class="container">
    <h1>Admin panel</h1>

    <h2>Edit Position</h2>

    <EditPositionForm :position="position" :edit="true" @save="save" />
  </div>
</template>

<script>
import {inject, reactive, onMounted, ref, watch, computed} from "vue";
import {getPositionsAdmin, getPosition} from "../../../endpoints";
import { useRoute } from 'vue-router';
import EditPositionForm from "./EditPositionForm.vue";

export default {
  components: {
    EditPositionForm,
  },
  setup() {
    let router = inject("router");
    const route = useRoute();
    let position = reactive({
      id: null,
      title: '',
      description: '',
    });

    onMounted(async () => {
      try {
        let {data} = await getPosition(route.params.id);

        Object.assign(position, data.position);
      } catch (error) {
        console.log(error);
      }
    });

    const save = () => {
      router.push({name: 'positions'});
    }

    return {
      position,
      save,
    }
  }
}
</script>

<style scoped>
.container {
  min-height: 400px;
}

nav {
  margin-bottom: 20px;
}
</style>