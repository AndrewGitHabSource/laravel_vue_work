<template>
    <div class="container">
        <h1>Edit</h1>

        <EditResumeForm :form="resume.key" @save="save"/>
    </div>
</template>

<script>
import { inject, reactive, onMounted, ref, toRef, watch, computed, nextTick } from "vue";
import { findResume, getResumes } from "../../endpoints";
import EditResumeForm  from "../Front/EditResumeForm.vue";
import { useRoute } from 'vue-router';
import {uuid} from "vue-uuid";

export default {
    components: {
        EditResumeForm,
    },
    setup() {
        const route = useRoute();
        let router = inject("router");
        let resume = reactive({'key': {}});

        const save = () => {
            router.push({name: 'dashboard'});
        }

        onMounted(async () => {
            try {
                const {data} = await findResume(route.params.id);
                resume.key = data;
            } catch (e) {
                console.log(e);
            }
        });

        return {
            save,
            resume,
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
