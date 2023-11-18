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
        // Define your initial filters here
        sortBy: "price",
        filterBy: "country",
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
      const url = `http://localhost/swiss-hotel/public/Hotels?sortBy=${this.filters.sortBy}&filterBy=${this.filters.filterBy}&itemsPerPage=${this.filters.itemsPerPage}`;

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
      console.log("handlefilterchanfe");
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
