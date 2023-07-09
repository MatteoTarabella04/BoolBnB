import { reactive } from "vue";

export const store = new reactive({
  base_admin_URL: "http://127.0.0.1:8000/",
  apartments: [],
  apartmentTypes: [],
  services: [],
  filteringApartments: [],
  apartmentType: 0,
  checkedServices: [],
  results: [],
  inputAddress: "",
  selectedAddress: null,
  selectedLat: null,
  selectedLon: null,
  radius: 20,
  rooms: 0,
  beds: 0,
});
