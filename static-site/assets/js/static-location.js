(function () {
  'use strict';

  const cityNames = [
    'Agartala','Agra','Ahmedabad','Aizawl','Ajmer','Akola','Aligarh','Ambala','Amravati','Amritsar','Anantapur','Asansol','Aurangabad',
    'Bareilly','Belgaum','Bengaluru','Bhilai','Bhopal','Bhubaneswar','Bikaner','Bilaspur','Bokaro',
    'Chandigarh','Chennai','Coimbatore','Cuttack',
    'Dehradun','Delhi','Dhanbad','Dharwad','Durgapur',
    'Erode',
    'Faridabad','Firozabad',
    'Ghaziabad','Gorakhpur','Guntur','Gurugram','Guwahati','Gwalior',
    'Hubballi','Hyderabad',
    'Indore',
    'Jabalpur','Jaipur','Jalandhar','Jammu','Jamnagar','Jamshedpur','Jhansi','Jodhpur',
    'Kakinada','Kannur','Kanpur','Kochi','Kolhapur','Kolkata','Kollam','Kota','Kozhikode','Kurnool',
    'Lucknow','Ludhiana',
    'Madurai','Mangaluru','Meerut','Moradabad','Mumbai','Mysuru',
    'Nagpur','Nanded','Nashik','Nellore','Noida',
    'Ongole',
    'Palakkad','Panaji','Patna','Puducherry','Pune',
    'Raipur','Rajahmundry','Rajkot','Ranchi','Rourkela',
    'Salem','Shillong','Shimla','Siliguri','Srinagar','Surat',
    'Thane','Thiruvananthapuram','Thrissur','Tiruchirappalli','Tirupati',
    'Udaipur','Ujjain',
    'Vadodara','Varanasi','Vellore','Vijayawada','Visakhapatnam',
    'Warangal'
  ].sort((a, b) => a.localeCompare(b, 'en'));

  const popularCities = ['Ahmedabad','Bengaluru','Chandigarh','Chennai','Delhi','Hyderabad','Kochi','Kolkata','Mumbai','Pune'];
  const cityIcons = {
    'Ahmedabad':'ahmedabad','Bengaluru':'bengaluru','Chandigarh':'chandigarh','Chennai':'chennai','Delhi':'delhi',
    'Hyderabad':'hyderabad','Kochi':'kochi','Kolkata':'kolkata','Mumbai':'mumbai','Pune':'pune'
  };
  const cityCoords = {
    'Ahmedabad':[23.0225,72.5714],'Bengaluru':[12.9716,77.5946],'Bhopal':[23.2599,77.4126],
    'Chandigarh':[30.7333,76.7794],'Chennai':[13.0827,80.2707],'Coimbatore':[11.0168,76.9558],
    'Delhi':[28.6139,77.2090],'Guntur':[16.3067,80.4365],'Gurugram':[28.4595,77.0266],
    'Guwahati':[26.1445,91.7362],'Hyderabad':[17.3850,78.4867],'Jaipur':[26.9124,75.7873],
    'Jammu':[32.7266,74.8570],'Kakinada':[16.9891,82.2475],'Kochi':[9.9312,76.2673],
    'Kolkata':[22.5726,88.3639],'Lucknow':[26.8467,80.9462],'Madurai':[9.9252,78.1198],
    'Mumbai':[19.0760,72.8777],'Nagpur':[21.1458,79.0882],'Noida':[28.5355,77.3910],
    'Pune':[18.5204,73.8567],'Ranchi':[23.3441,85.3096],'Surat':[21.1702,72.8311],
    'Thiruvananthapuram':[8.5241,76.9366],'Tirupati':[13.6288,79.4192],
    'Vijayawada':[16.5062,80.6480],'Visakhapatnam':[17.6868,83.2185],'Warangal':[17.9689,79.5941]
  };

  const byId = (id) => document.getElementById(id);
  const iconUrl = (city) => cityIcons[city] ? 'assets/images/icons/' + cityIcons[city] + '.png' : '';

  function makeCityButton(city, popular) {
    const button = document.createElement('button');
    button.type = 'button';
    button.className = popular ? 'popular-city-card' : 'city-item';
    button.setAttribute('aria-label', 'Choose ' + city);
    if (popular) {
      const image = document.createElement('img');
      image.className = 'popular-city-icon';
      image.src = iconUrl(city);
      image.alt = '';
      image.loading = 'lazy';
      image.onerror = function () { this.hidden = true; };
      button.appendChild(image);
      const name = document.createElement('span');
      name.className = 'popular-city-name';
      name.textContent = city;
      button.appendChild(name);
    } else {
      button.textContent = city;
      button.style.cssText = 'border:0;background:transparent;font:inherit;width:100%;text-align:left';
    }
    button.addEventListener('click', function () { window.selectCity(city); });
    return button;
  }

  function renderPopularCities() {
    const grid = byId('initialCities');
    if (!grid) return;
    grid.replaceChildren();
    popularCities.forEach((city) => grid.appendChild(makeCityButton(city, true)));
  }

  function renderAllCities(query) {
    const grid = byId('allCities');
    if (!grid) return;
    const filter = (query || '').trim().toLocaleLowerCase();
    const matches = cityNames.filter((city) => city.toLocaleLowerCase().includes(filter));
    grid.replaceChildren();
    matches.forEach((city) => grid.appendChild(makeCityButton(city, false)));
    if (!matches.length) {
      const empty = document.createElement('p');
      empty.className = 'text-muted text-center py-3';
      empty.textContent = 'No cities found. Try another spelling.';
      grid.appendChild(empty);
    }
  }

  function setStatus(message, isError) {
    const status = byId('locationStatus');
    if (!status) return;
    status.textContent = message;
    status.className = 'location-status' + (isError ? ' error' : ' success');
    status.style.display = message ? 'block' : 'none';
  }

  window.selectCity = function (city) {
    const selectedCity = cityNames.find((item) => item.toLocaleLowerCase() === String(city).toLocaleLowerCase());
    if (!selectedCity) return;
    localStorage.setItem('selectedCity', selectedCity);
    const display = byId('currentLocationDisplay');
    if (display) display.textContent = selectedCity;
    setStatus('', false);
    const modal = byId('locationModal');
    if (modal && window.bootstrap) window.bootstrap.Modal.getOrCreateInstance(modal).hide();
  };

  window.showInitialCities = function () {
    renderPopularCities();
    const input = byId('citySearchInput');
    if (input) input.value = '';
    const popular = document.querySelector('.popular-cities-section');
    const viewAll = byId('viewAllCitiesBtn');
    const list = byId('allCitiesList');
    const hide = byId('hideAllCitiesBtn');
    if (popular) popular.style.display = '';
    if (viewAll) viewAll.parentElement.style.display = '';
    if (list) list.style.display = 'none';
    if (hide) hide.style.display = 'none';
    setStatus('', false);
  };

  window.showAllCities = function () {
    const list = byId('allCitiesList');
    if (list) list.style.display = 'block';
    const hide = byId('hideAllCitiesBtn');
    if (hide) hide.style.display = 'inline-block';
    renderAllCities((byId('citySearchInput') || {}).value || '');
  };

  window.hideAllCities = function () {
    window.showInitialCities();
  };

  window.searchCities = function () {
    const input = byId('citySearchInput');
    const query = input ? input.value : '';
    if (!query.trim()) {
      window.showInitialCities();
      return;
    }
    const popular = document.querySelector('.popular-cities-section');
    const viewAll = byId('viewAllCitiesBtn');
    const list = byId('allCitiesList');
    const hide = byId('hideAllCitiesBtn');
    if (popular) popular.style.display = 'none';
    if (viewAll) viewAll.parentElement.style.display = 'none';
    if (list) list.style.display = 'block';
    if (hide) hide.style.display = 'inline-block';
    renderAllCities(query);
  };

  window.detectLocation = function () {
    if (!navigator.geolocation) {
      setStatus('Location detection is unavailable. Choose a city from the list.', true);
      return;
    }
    const button = byId('detectLocationBtn');
    const label = byId('detectLocationText');
    if (button) button.disabled = true;
    if (label) label.textContent = 'Finding nearby city &';
    navigator.geolocation.getCurrentPosition(function (position) {
      const latitude = position.coords.latitude;
      const longitude = position.coords.longitude;
      let nearest = null;
      let nearestDistance = Infinity;
      Object.keys(cityCoords).forEach((city) => {
        const coords = cityCoords[city];
        const distance = Math.hypot(latitude - coords[0], (longitude - coords[1]) * Math.cos(latitude * Math.PI / 180));
        if (distance < nearestDistance) { nearest = city; nearestDistance = distance; }
      });
      if (nearest) {
        setStatus('Nearby city: ' + nearest, false);
        if (label) label.textContent = 'Detect my location';
        if (button) button.disabled = false;
        window.selectCity(nearest);
      }
    }, function (error) {
      if (label) label.textContent = 'Detect my location';
      if (button) button.disabled = false;
      const message = error.code === error.PERMISSION_DENIED
        ? 'Location permission was denied. Choose a city from the list.'
        : 'Could not detect your city. Choose one from the list.';
      setStatus(message, true);
    }, { enableHighAccuracy: false, timeout: 10000, maximumAge: 300000 });
  };

  document.addEventListener('DOMContentLoaded', function () {
    renderPopularCities();
    const savedCity = localStorage.getItem('selectedCity');
    if (savedCity && cityNames.some((city) => city.toLocaleLowerCase() === savedCity.toLocaleLowerCase())) {
      const display = byId('currentLocationDisplay');
      if (display) display.textContent = cityNames.find((city) => city.toLocaleLowerCase() === savedCity.toLocaleLowerCase());
    }
  });
})();
