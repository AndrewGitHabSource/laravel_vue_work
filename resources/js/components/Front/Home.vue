<template>
    <div class="container">
        <h1>Positions</h1>

        <div class="position">
            <v-card class="mx-auto">
                <v-list three-line>
                    <template v-for="item in positions.key" :key="item.id">
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title v-html="item.title"></v-list-item-title>

                                <v-list-item-subtitle v-html="item.description"></v-list-item-subtitle>

                                <v-btn @click.stop="openDialog" color="primary" dark class="send-btn">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M4 6.03L11.5 9.25L4 8.25L4 6.03M11.5 14.75L4 17.97V15.75L11.5 14.75M2 3L2 10L17 12L2 14L2 21L23 12L2 3Z" />
                                    </svg>

                                    Send resume
                                </v-btn>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-list>
            </v-card>
        </div>

        <SendResumeModal @close="closeModal" :open="openModal" />
    </div>
</template>

<script>
import { inject, reactive, computed, onMounted, ref, watch } from "vue";
import { getPositions } from "../../endpoints";
import SendResumeModal from "../Front/SendResumeModal.vue";

export default {
    components: {
        SendResumeModal,
    },
    setup() {
        let positions = reactive({
            'key': [],
        });
        let openModal = ref(false);
        const openDialog = () => {
            openModal.value = true;
        }
        const closeModal = (value) => {
            openModal.value = false;
        }

        onMounted(async () => {
            try {
                const {data} = await getPositions();
                positions.key = data;
            } catch (e) {
                console.log(e);
            }
        });

        return {
            positions,
            openModal,
            openDialog,
            closeModal,
        }
    }
}
</script>

<style scoped>
    ul li {
        margin-bottom: 20px;
        border: 1px solid #718096;
        padding: 10px;
    }

    strong {
        display: block;
    }

    .container {
        background: #cbd5e0;
    }

    .send-btn {
        margin-top: 10px;
    }
</style>
