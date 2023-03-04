<template>
    <v-row justify="center">
        <v-dialog v-model="open" v-bind:value="open">

            <v-card>
                <v-toolbar dark color="primary">
                    <v-btn dark text @click="close">
                        Close
                    </v-btn>

                    <v-toolbar-title>Settings</v-toolbar-title>

                    <v-spacer></v-spacer>
                </v-toolbar>

                <EditResumeForm @save="save"/>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import { inject, reactive, computed, onMounted, ref, watch } from "vue";
import { searchSkills, saveResume, getLanguages } from "../../endpoints";
import EditResumeForm  from "./EditResumeForm.vue";
import { uuid } from 'vue-uuid';

export default {
    components: {
        EditResumeForm,
    },
    props: {
        open: Boolean,
    },
    setup(props, {emit}) {
        let openDialog = ref(false);

        let open = computed({
            get() {
                return props.open;
            },
        });

        const close = () => {
            emit("close", false);
        }

        const save = () => {
            try {
                emit("close", false);
            } catch (error) {
                console.log(error);
            } finally {
                emit("close", false);
            }
        }

        return {
            open,
            close,
            openDialog,
            save,
        }
    }
}
</script>

<style scoped>

.dialog-bottom-transition-enter-active,
.dialog-bottom-transition-leave-active {
    transition: transform .2s ease-in-out;
}

.v-dialog__container {
    display: unset;
}

</style>
