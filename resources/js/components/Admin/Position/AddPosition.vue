<template>
    <div class="container">
        <h1>Admin panel</h1>

        <h2>Add Position</h2>

        <EditPositionForm @save="save"></EditPositionForm>
    </div>
</template>

<script>
import {inject, reactive, onMounted, ref, watch, computed} from "vue";
import {getPositionsAdmin, searchPositions} from "../../../endpoints";
import { useRoute } from 'vue-router';
import EditPositionForm from "./EditPositionForm.vue";

export default {
    components: {
      EditPositionForm,
    },
    setup() {
        let router = inject("router");

        const save = () => {
          router.push({name: 'dashboard'});
        }

        return {
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
