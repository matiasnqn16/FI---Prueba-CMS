<template>
    <div>
        <p>{{ currentTime }}</p>
    </div>
</template>
  
<script>
import { ref } from 'vue';
  
export default {
    name: 'Clock',
    setup() {
        const currentTime = ref(new Date().toLocaleTimeString());
  
        setInterval(() => {
            currentTime.value = new Date().toLocaleTimeString();
        }, 1000);
  
        return {
            currentTime,
        };
    },
};
</script>
  
<style scoped>
  p {
    font-size: 1.7rem;
  }
</style>