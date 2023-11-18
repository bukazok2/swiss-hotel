<template>
  <div class="d-flex">
      <span v-for="(item, index) of num" :key="index" class="yellow">*</span>
  </div>
</template>

<script>
export default {
  name: "Star",
  props: {
    num: Number,
  },
};
</script>

<style scoped>
.yellow {
  font-size: 32px;
  color: #cda12a;
}
</style>