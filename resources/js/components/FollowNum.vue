<template>
    <div class="pr-4"><strong>{{followersCount}}</strong> followers</div>
</template>

<script>
    import EventBus from '../EventBus';
    export default {
        props: ['followers'],

        data() {
            return {
                followersCount: this.followers
            }
        },

        created() {
            EventBus.$on('followChanged', (status) => {
                if(status) {
                    this.followersCount++;
                }
                else{ 
                    this.followersCount--;
                };
            })        
        },

        watch: { 
            followersCount : function () {
                return this.followersCount;
            }
        }
    }
</script>