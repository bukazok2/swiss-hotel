<template>
  <div class="app">
    <Nav class="nav-component fixed-top" @filterChange="handleFilterChange" />

    <div v-if="!data">Loading...</div>

    <main v-else class="main">
      <Card v-for="hotel in data" :key="hotel.id" :hotel="hotel" />

      <Pagination
        :items-per-page="filters.itemsPerPage"
        :total-pages="totalPages"
        @page-clicked="handlePageClick"
      />
    </main>
  </div>
</template>

<script>
import Nav from "./Components/Nav.vue";
import Card from "./Components/Card.vue";
import Pagination from "./Components/Pagination.vue";

export default {
  data() {
    return {
      data: null,
      filters: {
        sortBy: "price",
        filterBy: {
          country: 0,
          city: 0,
        },
        itemsPerPage: 21,
      },
      currentPage: 1,
      totalPages: 1,
    };
  },
  components: {
    Nav,
    Card,
    Pagination
  },
  methods: {
    fetchData() {
      console.log(this.filters.sortBy);
      console.log(this.filters.filterBy);
      console.log(this.filters.itemsPerPage);
      console.log(this.currentPage);
      const url = `http://localhost:8080/Hotels?sortBy=${this.filters.sortBy}&filterByCountry=${this.filters.filterBy.country}&filterByCity=${this.filters.filterBy.city}&itemsPerPage=${this.filters.itemsPerPage}&currentPage=${this.currentPage}`;
      console.log(url);
      fetch(url)
        .then((res) => res.json())
        .then((data) => {
          this.data = data.data;
          this.totalPages = Math.ceil(data.total / this.filters.itemsPerPage);
        })
        .catch((error) => {
          console.error('Error fetching data:', error);
        });
    },
    handleFilterChange(newFilters) {
      this.filters = { ...this.filters, ...newFilters };
      this.fetchData();
    },
    handlePageClick(page) {
      this.currentPage = page;
      this.fetchData();
    },
  },
  created() {
    this.fetchData();
  },
};
</script>

<style scoped>
.app {
  width: 100%;
  margin: 0 auto;
}
.nav-component {
  margin: 0 auto;
}
</style>
