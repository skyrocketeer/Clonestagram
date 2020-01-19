<template>
    <button class="btn ml-3" v-bind:class="{'btn-primary': isActive, 'btn-success': !isActive}" @click="followUser" v-text="buttonText"></button>
</template>

<script>
    import EventBus from '../EventBus';
    export default {
        props : ['userId','followed'],

        data: function () {
            return {
                isActive: false,
                status: this.followed // status --> false (initially)
            }
        },

        methods: {
            followUser() {
                axios.post('/follow/'+ this.userId)
                    .then( response => {
                        this.isActive = ! this.isActive;
                        this.status = ! this.status; // status --> true
                        EventBus.$emit('followChanged',this.status); 
                    })
                    .catch( error => {
                        if(error.response.status === 401){
                            window.location = '/login';
                        }
                    });
            }
        },

        computed: {
            buttonText() {
                return (this.status)? 'Following' : 'Follow'     
            }
        }
    }
</script>
