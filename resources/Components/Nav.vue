<template>
  <nav class="navbar navbar-dark">
    <div class="navbar-nav ml-auto">
      <div class="nav-item">
        <label for="sort">Order:</label>
        <select id="sort" v-model="selectedSort">
          <option value="price">By price</option>
          <option value="star">By stars</option>
        </select>
      </div>

      <div class="nav-item">
        <label for="countryFilter">Country:</label>
        <select id="countryFilter" v-model="selectedCountry">
          <option selected value="0">All</option>
          <option v-for="country in countries" :key="country.id" :value="country.id">
            {{ country.country }}
          </option>
        </select>
      </div>

      <div class="nav-item">
        <label for="cityFilter">City:</label>
        <select id="cityFilter" v-model="selectedCity">
          <option selected value="0">All</option>
          <option v-for="city in cities" :key="city.id" :value="city.id">
            {{ city.city }}
          </option>
        </select>
      </div>

      <div class="nav-item">
        <label for="perPage">Number of offers per page:</label>
        <select id="perPage" v-model="itemsPerPage">
          <option value="21">21</option>
        </select>
      </div>
    </div>
    <button @click="handleFilterChange">Apply Filters</button>
  </nav>
</template>

<script>
export default {
  name: "Nav",
  data() {
    return {
      selectedSort: "price",
      selectedCountry: 0,
      selectedCity: 0,
      itemsPerPage: 21,
      countries: [],
      cities: [],
    };
  },
  methods: {
    handleFilterChange() {
      const newFilters = {
        sortBy: this.selectedSort,
        filterBy: {
          country: this.selectedCountry,
          city: this.selectedCity,
        },
        itemsPerPage: this.itemsPerPage,
      };

      this.$emit("filterChange", newFilters);
    },
    fetchCountries() {
      fetch("http://localhost:8080/Countries")
        .then((res) => res.json())
        .then((data) => {
          this.countries = data;
        })
        .catch((error) => {
          console.error('Error fetching countries:', error);
        });
    },
    fetchCities() {
      fetch("http://localhost:8080/Cities")
        .then((res) => res.json())
        .then((data) => {
          this.cities = data;
        })
        .catch((error) => {
          console.error('Error fetching cities:', error);
        });
    },
  },
  created() {
    // Fetch countries and cities when the component is created
    this.fetchCountries();
    this.fetchCities();
  },
};
</script>

<style scoped>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
}

.navbar-dark {
  background-color: rgb(0, 113, 194);
}

.nav-item {
  margin-right: 20px;
  display: inline-block;
}

label {
  margin-right: 5px;
}
</style>
