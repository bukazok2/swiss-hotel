<template>
  <div class="app">
    <Nav class="nav-component fixed-top" @filterChange="handleFilterChange" />

    <div v-if="!data">Loading...</div>

    <main v-else class="main">
      <Card v-for="hotel in data" :key="hotel.id" :hotel="hotel" />
    </main>
  </div>
</template>

<script>
import Nav from "./Components/Nav.vue";
import Card from "./Components/Card.vue";

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
    };
  },
  components: {
    Nav,
    Card,
  },
  methods: {
    fetchData() {
      console.log(this.filters.sortBy);
      console.log(this.filters.filterBy);
      console.log(this.filters.itemsPerPage);
      const url = `http://localhost/swiss-hotel/public/Hotels?sortBy=${this.filters.sortBy}&filterByCountry=${this.filters.filterBy.country}&filterByCity=${this.filters.filterBy.city}&itemsPerPage=${this.filters.itemsPerPage}`;
      console.log(url);
      fetch(url)
        .then((res) => res.json())
        .then((data) => {
          this.data = data;
        })
        .catch((error) => {
          console.error('Error fetching data:', error);
        });
    },
    handleFilterChange(newFilters) {
      this.filters = { ...this.filters, ...newFilters };
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
