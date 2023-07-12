import { reactive } from "vue";
import { nextTick } from "vue";
import axios from "axios";

export const store = new reactive({
  base_admin_URL: "http://127.0.0.1:8000/",
  apartments: [],
  apartmentTypes: [],
  services: [],
  filteringApartments: [],
  apartmentType: 0,
  checkedServices: [],
  results: [],
  sponsorizedApartmentsPresent: false,
  selectedResult: "",
  inputAddress: "",
  selectedAddress: null,
  selectedLat: null,
  selectedLon: null,
  radius: 20,
  rooms: 0,
  beds: 0,
  searchError: false,

  arrowKeysFunction() {
    // ENABLE SCROLLING IN THE ADDRESSES WITH THE ARROW KEYS
    const suggestedAddressesContainer = document.getElementById("addressSuggestions");
    const addressEl = document.getElementById("address");



    let selectedIndex = -1;

    addressEl.addEventListener('keydown', (event) => {
      const key = event.key;

      if (key === 'ArrowDown') {
        event.preventDefault();
        selectedIndex = Math.min(selectedIndex + 1, suggestedAddressesContainer.children.length - 1);
        updateSelection();
        console.log(selectedIndex);

      } else if (key === 'ArrowUp') {
        event.preventDefault();
        selectedIndex = Math.max(selectedIndex - 1, -1);
        if (selectedIndex == -1) {
          const selected = suggestedAddressesContainer.querySelector('.selected');

          if (selected) {
            selected.classList.remove('selected');
            console.log(selectedIndex);
          }
        } else {
          updateSelection();
          console.log(selectedIndex);
        }

        // } else if (key === 'Enter' && this.selectedLat == null && this.selectedLon == null) {
      } else if (key === 'Enter') {

        event.preventDefault();

        if (this.results) {
          this.selectedResult = this.results[selectedIndex];
          this.results = [];
          this.inputAddress = this.selectedResult.address.freeformAddress;
          this.searchError = false;
          // console.log(this.inputAddress);
          // console.log(this.selectedResult);
          // console.log(this.selectedLat);
          // console.log(this.selectedLon);
          // console.log(this.searchError);
        }
      }
    }
    );
    /**
 * Remove the selected class to the old element and add to the new one
 */
    function updateSelection() {
      const selected = suggestedAddressesContainer.querySelector('.selected');

      if (selected) {
        selected.classList.remove('selected');
      }

      const newSelected = suggestedAddressesContainer.children[selectedIndex];
      newSelected.classList.add('selected');
    }
  },

  getRealtimeResults() {
    axios
    .get(`https://api.tomtom.com/search/2/search/${this.inputAddress}.json?key=1tCQiScG72uLCOIZ32Xx2BG2eB07fCTm&typeahead=true&language=it-IT&limit=10`)
    .then(response => {
      this.results = response.data.results
    })
    .catch(error => {
      console.error(error.message);
    })
  },

  checkIfSponsorized(apartment) {
    let latestExpiry = null;
    apartment.sponsorization_plans.forEach(apartmentActiveSponsorization => {
        if (latestExpiry == null || apartmentActiveSponsorization.pivot.expiry_date > latestExpiry) {
            latestExpiry = apartmentActiveSponsorization.pivot.expiry_date;
        }
    })
    const now = new Date();
    const day = ("0" + now.getDate()).slice(-2);
    const month = ("0" + (now.getMonth() + 1)).slice(-2);
    const year = now.getFullYear();
    const seconds = ("0" + now.getSeconds()).slice(-2);
    const minutes = ("0" + now.getMinutes()).slice(-2);
    const hours = ("0" + now.getHours()).slice(-2);
    const formattedDate = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
    if(latestExpiry > formattedDate) {
      this.sponsorizedApartmentsPresent = true;
        return true;
    }
    return false;
  },

  getAllApartments(reference, address = null) {
    this.filteringApartments = [];
    if (address == null) {
      axios
      .get(this.base_admin_URL + "api/apartments-types-services")
      .then(response => {
          this.apartments = response.data.apartments;
          this.sponsorizedApartmentsPresent = false;
          this.services = response.data.services;
          this.apartmentTypes = response.data.apartment_types;
          nextTick(() => {
              let loadedApartmentsEls = document.querySelectorAll(".sponsored_apartment");
              loadedApartmentsEls.forEach(loadedApartmentsEl => {
                  loadedApartmentsEl.style.rotate = `${Math.random() * 10 - 5}deg`;
              })
          });
      })
      .catch(error => {
          console.error(error.message);
      })
    } else {
      axios
      .get(this.base_admin_URL + "api/apartments")
      .then(response => {
          this.apartments = response.data.apartments;
          this.sponsorizedApartmentsPresent = false;
          if (address != null) {
              this.filtering = true;
          }
          if (this.filtering) {
              this.setCoordinates(reference, address);
          }
      })
      .catch(error => {
          console.error(error.message);
      })
    }
  },

  setCoordinates(reference, address) {
    this.selectedAddress = address.address.freeformAddress;
    this.selectedLat = address.position.lat;
    this.selectedLon = address.position.lon;
    this.filteringApartments = this.apartments;
    this.checkOtherFilters();
    this.apartments = this.filteringApartments.filter(apartment => {
        const lat1 = this.selectedLat;
        const lon1 = this.selectedLon;
        const lat2 = apartment.latitude;
        const lon2 = apartment.longitude;
        const distance = this.calculateDistance(lat1, lat2, lon1, lon2);
        if (distance <= this.radius) {
            apartment.distance_from_point = distance;
            return true;
        }
        return false;
    });
    this.apartments.sort((a, b) => a.distance_from_point - b.distance_from_point);
    if(reference.$route.name == "searchPage") {
        nextTick(() => {
            let loadedApartmentsEls = document.querySelectorAll(".sponsored_apartment");
            loadedApartmentsEls.forEach(loadedApartmentsEl => {
                loadedApartmentsEl.style.rotate = `${Math.random() * 10 - 5}deg`;
            })
        });
    } else if(reference.$route.name == "home") {
        reference.$router.push({
            name: "searchPage"
        });
    }
  },

  checkOtherFilters() {
    let stepFilteringApartments = [];
    if (this.rooms > 0) {
        stepFilteringApartments = this.filteringApartments.filter(apartment => apartment.rooms >= this.rooms ? true : false);
        this.filteringApartments = stepFilteringApartments;
    }
    if (this.beds > 0) {
        stepFilteringApartments = this.filteringApartments.filter(apartment => apartment.beds >= this.beds ? true : false);
        this.filteringApartments = stepFilteringApartments;
    }
    if (this.apartmentType > 0) {
        stepFilteringApartments = this.filteringApartments.filter(apartment => apartment.apartment_type.id === this.apartmentType ? true : false);
        this.filteringApartments = stepFilteringApartments;
    }
    if (this.services.length > 0) {
        stepFilteringApartments = [];
        this.filteringApartments.forEach(apartment => {
            let apartmentServices = [];
            apartment.services.forEach(service => {
                apartmentServices.push(service.id);
            })
            const allServicesChecked = this.checkedServices.every(service => {
                return apartmentServices.indexOf(service) >= 0;
            })
            if (allServicesChecked) {
                stepFilteringApartments.push(apartment);
            }
        })
        this.filteringApartments = stepFilteringApartments;
    }
  },

  calculateDistance(lat1, lat2, lon1, lon2) {

    // The math module contains a function named toRadians which converts from degrees to radians.
    lon1 = lon1 * Math.PI / 180;
    lon2 = lon2 * Math.PI / 180;
    lat1 = lat1 * Math.PI / 180;
    lat2 = lat2 * Math.PI / 180;

    // Haversine formula
    let diffLon = lon2 - lon1;
    let diffLat = lat2 - lat1;
    let a = Math.pow(Math.sin(diffLat / 2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(diffLon / 2), 2);
    let c = 2 * Math.asin(Math.sqrt(a));

    // Radius of earth in kilometers. Use 3956 for miles
    let r = 6371;

    // calculate the result
    return (c * r);
  },

  resetFilters() {
    this.radius = 20;
    this.rooms = 0;
    this.beds = 0;
    this.checkedServices = [];
    this.apartmentType = 0;
  },

  getImagePath(path) {
    return this.base_admin_URL + 'storage/' + path
  },

  checkOrUncheck(e) {
    if (e.target.getAttribute("checked") == true) {
        e.target.setAttribute("checked", null)
    } else {
        e.target.setAttribute("checked", true)
    }
  },

});
