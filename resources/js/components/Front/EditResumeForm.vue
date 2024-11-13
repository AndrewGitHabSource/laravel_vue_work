<template>
    <v-form ref="sendForm" v-model="valid" lazy-validation class="pa-5">
        <v-text-field :rules="nameRules" v-model="form.name" label="Name" required></v-text-field>

        <v-text-field :lastNameRules="last_name" v-model="form.last_name" label="Last name" required></v-text-field>

        <v-text-field :rules="emailRules" v-model="form.email" label="E-mail" required></v-text-field>

        <v-text-field :rules="phoneRules" v-model="form.phone" label="Phone" required></v-text-field>

        <v-file-input show-size v-model="form.avatar"></v-file-input>

        <div v-if="image" class="image-avatar">
            <img v-bind:src="image">
        </div>

        <v-textarea :rules="aboutRules" v-model="form.about" clearable clear-icon="mdi-close-circle" label="about"></v-textarea>

        <v-textarea v-model="form.info" clearable clear-icon="mdi-close-circle" label="info"></v-textarea>

        <div v-for="(item, index) in form.skills" :key="item.id">
            <v-btn class="ma-2" color="warning" @click="addSkill">
                Add Skill
            </v-btn>

            <v-combobox
                label="Combobox"
                v-model="form.skills[index].title"
                :items="skills"
                @input="inputSkill">
            </v-combobox>
        </div>

        <div v-for="(item, index) in form.portfolio" :key="item.id">
            <v-btn class="ma-2" color="warning" @click="addPortfolio">
                Add portfolio
            </v-btn>

            <v-text-field
                label="Site"
                class="mb-2"
                v-model="form.portfolio[index].site"
                hide-details="auto">
            </v-text-field>

            <v-text-field
                label="About"
                class="mb-2"
                v-model="form.portfolio[index].about"
                hide-details="auto">
            </v-text-field>
        </div>

        <v-select
            v-model="form.languages"
            :items="languages"
            :item-value="'id'"
            attach
            label="languages"
            class="mb-2"
            multiple>
        </v-select>

        <v-btn dark text @click="save">
            Save
        </v-btn>

        <v-btn color="error" class="mr-4" @click="reset">
            Reset Form
        </v-btn>
    </v-form>
</template>

<script>
    import { inject, reactive, computed, toRefs, onMounted, ref, watch, toRef } from "vue";
    import { searchSkills, saveResume, updateResume, getLanguages } from "../../endpoints";
    import { uuid } from 'vue-uuid';
    import { nameRules, lastNameRules, emailRules, phoneRules, aboutRules } from '../validation/resume';

    export default {
        props: {
            form: Object,
            edit: Boolean,
        },
        setup(props, {emit}) {
            let openDialog = ref(false);
            let skills = ref([]);
            let portfolios = ref([]);
            let languages = ref([]);
            let searchSkill = '';
            let form = reactive({
                'id': null,
                'name': '',
                'last_name': '',
                'email': '',
                'phone': '',
                'avatar': '',
                'about': '',
                'info': '',
                'skills': [{
                    'id': uuid.v1(),
                    'title': '',
                }],
                'languages': [],
                'portfolio': [{
                    'id': uuid.v1(),
                    'site': '',
                    'about': '',
                }]
            });
            let sendForm = ref(null);
            let valid = ref(true);
            let image = ref('');
            const formData = computed(() => {
                return props.form;
            });

            watch(formData, (value) => {
                if(value.id) {
                    initResume(value);
                }
            });

            onMounted(async () => {
                try {
                    const {data} = await getLanguages();
                    languages.value = data;
                } catch (e) {
                    console.log(e);
                }
            });

            const initResume = (data) => {
                form.id = data.id ?? null;
                form.name = data.name ?? '';
                form.last_name = data.last_name ?? '';
                form.email = data.email ?? '';
                form.phone = data.phone ?? '';
                form.about = data.about ?? '';
                form.info = data.info ?? '';
                form.languages = data.languages.map(item => _.values(item).shift()) ?? [];
                if (!_.isEmpty(data.skills)) {
                    form.skills = data.skills;
                }
                if (!_.isEmpty(data.portfolios)) {
                    form.portfolio = data.portfolios;
                }
                image.value = data.avatar ?? '';
            };

            let open = computed({
                get() {
                    return props.open;
                },
            });

            let edit = computed({
                get() {
                    return props.edit;
                }
            });

            const close = () => {
                emit("close", false);
            }

            const formBuild = (form) => {
                let formData = new FormData();
                formData.append("form", JSON.stringify(form));
                formData.append("avatar", form.avatar[0]);

                return formData;
            }

            const save = async () => {
                try {
                    sendForm.value.validate();

                    if (valid.value) {
                        edit ? await updateResume(formBuild(form)) : await saveResume(formBuild(form))
                        emit("save", true);
                    }
                } catch (error) {
                    console.log(error);
                }
            }

            const addSkill = () => {
                form.skills.push({
                    'id': uuid.v1(),
                    'skill': '',
                });
            }

            const addPortfolio = () => {
                form.portfolio.push({
                    'id': uuid.v1(),
                    'portfolio': '',
                });
            }

            const inputSkill = async (value) => {
                searchSkill += value;
                try {
                    const {data} = await searchSkills(searchSkill);
                    skills.value = data;
                } catch (error) {
                    console.log(error);
                }
            }

            const reset = () => {
                initResume(false);
            }

            return {
                open,
                close,
                openDialog,
                form,
                save,
                skills,
                portfolios,
                languages,
                addSkill,
                inputSkill,
                addPortfolio,
                nameRules,
                lastNameRules,
                emailRules,
                phoneRules,
                aboutRules,
                valid,
                sendForm,
                reset,
                formData,
                edit,
                image,
            }
        }
    }
</script>

<style scoped>
    .image-avatar {
        width: 200px;
    }

    .image-avatar img {
        max-width: 100%;
    }
</style>
