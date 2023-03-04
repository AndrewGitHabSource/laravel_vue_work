<template>
    <div class="container">
        <h1>Admin panel</h1>

        <h2>Add Position</h2>


    </div>
</template>

<script>
import {inject, reactive, onMounted, ref, watch, computed} from "vue";
import {getPositionsAdmin, searchPositions} from "../../../endpoints";
import { useRoute } from 'vue-router';

export default {
    setup() {
        let router = inject("router");

        return {

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
