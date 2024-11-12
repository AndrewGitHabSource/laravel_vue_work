<template>
    <div class="container">
        <h1>Admin panel</h1>

        <nav>
            <ul>
                <li>
                    <router-link to="/admin/positions">Go to Positions</router-link>
                </li>
            </ul>
        </nav>

        <v-btn color="warning" @click="addResume">Add resume</v-btn>

        <h2>Resumes</h2>

        <v-text-field v-model="search" label="Search" class="mx-4"></v-text-field>

        <v-table fixed-header height="300px">
            <thead>
                <tr>
                    <th class="text-left">
                        Name
                    </th>
                    <th class="text-left">
                        Last name
                    </th>
                    <th class="text-left">
                        Email
                    </th>
                    <th class="text-left">
                        Phone
                    </th>
                    <th class="text-left">
                        Edit
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="item in resumes.key" :key="item.id">
                    <td>{{ item.name }}</td>
                    <td>{{ item.last_name }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.phone }}</td>
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
    import { getResumes, searchResumes } from "../../endpoints";
    import { useRoute } from 'vue-router';

    export default {
         setup() {
             let router = inject("router");
             let resumes = reactive({
                 'key': [],
             });
             let search = ref('');
             let currentPage = ref(1);
             let total = ref(1);

             const receiveResumes = async () => {
                 try {
                     let {data} = search.value ? await searchResumes({"search": search.value, "page": currentPage.value}) : await getResumes(currentPage.value);
                     resumes.key = data.resumes;
                     total.value = data.total;
                 } catch (e) {
                     console.log(e);
                 }
             }

             onMounted(async () => {
                 await receiveResumes();
             });


             const addResume = () => {
                 router.push({name: 'addResume'});
             };

             const edit = (id) => {
                 router.push({name: 'editResume', params: {id}});
             };

             const deleteResume = ({id}) => {

             };

             watch(currentPage, async () => {
                 await receiveResumes();
             });

             watch(search, async () => {
                 await receiveResumes();
             });

            return {
                resumes,
                search,
                edit,
                addResume,
                deleteResume,
                currentPage,
                total,
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
