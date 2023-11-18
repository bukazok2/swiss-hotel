<template>
  <div class="pagination">
    <button @click="goToPage(1)" :disabled="currentPage === 1" class="pagination-button">First</button>
    <button @click="prevPage" :disabled="currentPage === 1" class="pagination-button">Prev</button>

    <span class="pagination-info">Page {{ currentPage }} of {{ totalPages }}</span>

    <button @click="nextPage" :disabled="currentPage === totalPages" class="pagination-button">Next</button>
    <button @click="goToPage(totalPages)" :disabled="currentPage === totalPages" class="pagination-button">Last</button>
  </div>
</template>

<script>
export default {
  data() { 
    return {
        currentPage: 1
    }
  },
  props: {
    totalPages: {
      type: Number,
      required: true,
    },
    itemsPerPage: {
      type: Number,
      required: true,
    },
  },
  methods: {
    goToPage(page) {
      if (page >= 1 && page <= this.totalPages) {
        this.currentPage = page;
        this.$emit('page-clicked', page);
      }
    },
    prevPage() {
        this.goToPage(this.currentPage-1);
    },
    nextPage() {
        this.goToPage(this.currentPage+1);
    },
  },
};
</script>

<style scoped>
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 20px;
  font-family: 'Arial', sans-serif;
}

.pagination-button {
  margin-left:5px; 
  padding: 8px 12px;
  background-color: #3498db;
  color: #fff;
  border: 1px solid #3498db;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.pagination-button:hover {
  background-color: #2980b9;
}

.pagination-info {
  margin: 0 15px;
  font-size: 16px;
  line-height: 30px;
  color: #333;
  display: flex;
  align-items: center;
}
</style>
