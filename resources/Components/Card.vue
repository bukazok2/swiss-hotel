<template>
  <div class="custom-card mb-3">
    <img :src="hotel.attachment_url" alt="Hotel Image" class="card-img" />
    <div class="w-50">
      <h5 class="card-title blue mb-1">
        {{hotel.hotel_name}}
      </h5>
      <p>
        <Star :num="parseInt(hotel.star)" />
      </p>
      <p class="card-text blue mb-2">
        <i class="fa fa-map-marker" aria-hidden="true"></i>
        {{hotel.country_name}}
      </p>
      <p class="card-text">
        {{hotel.city_name}}
        <span class="d-block">{{ hotel.bed }}</span>
      </p>
      <p class="card-text green mb-3">
        {{hotel.address}}
      </p>
      <p class="card-text grey mb-3">
        {{hotel.latitude}}
        {{hotel.longitude}}
      </p>
      <p class="card-text price">
        {{ formattedPrice }}
      </p>
    </div>
  </div>
</template>

<script>
import Star from "../Components/Star.vue";

export default {
  name: "Card",
  components: {
    Star,
  },
  props: {
    hotel: Object,
  },
  computed: {
    formattedPrice() {
      // Assuming 'price' is a number in euros
      return `€${this.hotel.price}`; // Format as euros with two decimal places
    },
  },
};
</script>

<style scoped>
.custom-card {
  display: flex;
  padding: 10px;
  border: 1px solid rgb(187, 187, 187);
  border-radius: 5px;
}
.card-img {
  max-height: 200px;
  max-width: 200px;
}
.card-title {
  font-size: 20px;
  font-weight: 700;
}
.card-text {
  font-size: 12px;
  font-weight: 600;
}
.blue {
  color: rgb(0, 113, 194);
}
.green {
  color: rgb(0, 128, 9);
  font-weight: 700;
}
.price{
   color: rgb(0, 0, 0);
   font-size: 15px;
    font-weight: 700;
}

.rating {
  font-size: 16px;
  font-weight: 500;
  width: 32px;
  height: 32px;
  background-color: #043580;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 5px 5px 5px 0;
}

small {
  font-size: 12px;
  font-weight: 400;
  color: rgb(107, 107, 107);
}
</style>