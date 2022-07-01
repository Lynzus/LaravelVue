<template>
    <div class="">
        {{ currentUser.name }}
    </div>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
            currentUser: {},
        };
    },
    mounted() {
        axios.get(window.location.origin + "/api/users").then((res) => {
            this.currentUser = res.data;
            console.log(res.data);
        });
    },
};
</script>