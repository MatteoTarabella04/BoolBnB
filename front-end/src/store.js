import { reactive } from "vue";

export const store = new reactive({
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
  filtering: false,
});
