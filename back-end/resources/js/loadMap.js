import tt from "@tomtom-international/web-sdk-maps";

const slug = document.getElementById("slug").value;
let lat = null;
let lon = null;
const apiKey = import.meta.env.VITE_TOM_TOM_KEY;

axios
.get(`http://127.0.0.1:8000/api/apartments/${slug}`)
.then(response => {
  lat = response.data.apartment.latitude;
  lon = response.data.apartment.longitude;

  const mapWrapper = document.getElementById("map");
  mapWrapper.classList.remove("d-none");
  const mapChilds = document.querySelectorAll("#map *");
  mapChilds.forEach(child => {
    child.remove();
  });
  let map = tt.map({
    key: apiKey,
    container: "map",
    center: [lon, lat],
    zoom: 14,
  });
  let marker = new tt.Marker()
  .setLngLat([lon, lat])
  .addTo(map)
})
.catch(error => {
  console.error(error.message);
})
