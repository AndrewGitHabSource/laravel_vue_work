<template>
  <div class="container">
    <h1>Admin panel</h1>

    <h2>Edit Position</h2>

    <EditPositionForm :position="position" />
  </div>
</template>

<script>
import {inject, reactive, onMounted, ref, watch, computed} from "vue";
import {getPositionsAdmin, searchPositions} from "../../../endpoints";
import { useRoute } from 'vue-router';
import EditPositionForm from "./EditPositionForm.vue";
import positions from "@/components/Admin/Position/Positions.vue";

export default {
  components: {
    EditPositionForm,
  },
  setup() {
    let router = inject("router");
    let position = null;

    return {
      position,
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