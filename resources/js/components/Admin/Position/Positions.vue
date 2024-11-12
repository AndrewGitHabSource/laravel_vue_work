<template>
    <div class="container">
        <h1>Admin panel</h1>

        <nav>
            <ul>
                <li>
                    <router-link to="/admin/add-position">Add Positions</router-link>
                </li>
            </ul>
        </nav>

        <h2>Positions</h2>

        <v-text-field v-model="search" label="Search" class="mx-4"></v-text-field>

        <v-table fixed-header height="300px">
            <thead>
                <tr>
                    <th class="text-left">
                        Title
                    </th>
                    <th class="text-left">
                        Description
                    </th>
                    <th class="text-left">
                        Edit
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="item in positions.key" :key="item.id">
                    <td>{{ item.title }}</td>
                    <td>{{ item.description }}</td>
                    <td>
                        <v-btn color="warning" @click="edit(item.id)">
                            Edit
                        </v-btn>

                        <v-btn color="warning" @click="deleteResume(item.id)">
                            Delete
                        </v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <v-pagination
            v-model="currentPage"
            class="my-4"
            :length="total">
        </v-pagination>
    </div>
</template>

<script>
import {inject, reactive, onMounted, ref, watch, computed} from "vue";
import {getPositionsAdmin, searchPositions} from "../../../endpoints";
import { useRoute } from 'vue-router';

export default {
    setup() {
        let router = inject("router");
        let positions = reactive({
            'key': [],
        });
        let search = ref('');
        let currentPage = ref(1);
        let total = ref(1);

        onMounted(async () => {
            await receivePositions();
        });

        const receivePositions = async () => {
            try {
                let {data} = search.value ? await searchPositions(search.value, currentPage.value) : await getPositionsAdmin(currentPage.value);
                positions.key = data.positions;
                total.value = data.total;
            } catch (e) {
                console.log(e);
            }
        }

        watch(currentPage, async () => {
            await receivePositions();
        });

        watch(search, async () => {
            await receivePositions();
        });

        return {
            total,
            currentPage,
            search,
            positions,
            router,
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
