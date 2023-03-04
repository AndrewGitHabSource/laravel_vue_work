<template>
    <div class="container">
        <h1>Add</h1>

        <EditResumeForm @save="save"/>
    </div>
</template>

<script>
import {inject, reactive, onMounted, ref, watch, computed} from "vue";
import { getResumes } from "../../endpoints";
import EditResumeForm  from "../Front/EditResumeForm.vue";

export default {
    components: {
        EditResumeForm,
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
