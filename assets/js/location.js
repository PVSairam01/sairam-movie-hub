// =============================================
// PREMIUM LOCATION SYSTEM (Complete location.js)
// =============================================

// Bind window functions immediately so HTML inline handlers never break
window.showAllCities = showAllCities;
window.hideAllCities = hideAllCities;
window.selectCity = selectCity;
window.searchCities = searchCities;
window.detectLocation = detectLocation;
window.resetCitySearch = resetCitySearch;
window.showInitialCities = showInitialCities;

// =============================================
// CITY DATA
// =============================================
var allCitiesData = [
    'Aalo', 'Abohar', 'Abu Road', 'Achampet', 'Acharapakkam', 'Addanki', 'Adilabad',
    'Adimali', 'Adipur', 'Adoni', 'Agar Malwa', 'Agartala', 'Agiripalli', 'Agra',
    'Ahilyanagar', 'Ahmedgarh', 'Ahore', 'Aizawl', 'Ajmer', 'Akaltara', 'Akbarpur',
    'Akividu', 'Akluj', 'Akola', 'Akot', 'Alakode', 'Alangudi', 'Alangulam',
    'Alappuzha', 'Alathur', 'Alibaug', 'Aligarh', 'Alipurduar', 'Allagadda', 'Almora',
    'Amalapuram', 'Amravati', 'Amritsar', 'Anakapalle', 'Anantapur', 'Anantnag',
    'Anand', 'Anaparthi', 'Araku', 'Armoor', 'Arrah', 'Asansol', 'Aurangabad',
    'Bengaluru', 'Bhopal', 'Bhubaneswar', 'Bikaner', 'Bilaspur', 'Chandigarh',
    'Chennai', 'Coimbatore', 'Cuddalore', 'Cuttack', 'Darbhanga', 'Dehradun',
    'Delhi-NCR', 'Dhanbad', 'Durgapur', 'Eluru', 'Erode', 'Faridabad', 'Fatehpur',
    'Firozabad', 'Gandhinagar', 'Ghaziabad', 'Goa', 'Guntur', 'Guwahati', 'Gwalior',
    'Haldia', 'Haridwar', 'Hassan', 'Hisar', 'Hosur', 'Hubli', 'Hyderabad',
    'Imphal', 'Indore', 'Itanagar', 'Jabalpur', 'Jaipur', 'Jalandhar', 'Jammu',
    'Jamshedpur', 'Jodhpur', 'Kakinada', 'Kakinada Rural', 'Kalaburagi', 'Kalyan',
    'Kanchipuram', 'Kanpur', 'Karimnagar', 'Karnal', 'Kavali', 'Khammam', 'Kochi',
    'Kohima', 'Kolar', 'Kolhapur', 'Kolkata', 'Kota', 'Kottayam', 'Kozhikode',
    'Kurnool', 'Latur', 'Lucknow', 'Ludhiana', 'Madurai', 'Mangalore', 'Mathura',
    'Meerut', 'Moradabad', 'Mumbai', 'Mysuru', 'Nagapattinam', 'Nagpur', 'Nainital',
    'Nalgonda', 'Nanded', 'Nashik', 'Navi Mumbai', 'Nellore', 'New Delhi', 'Nizamabad',
    'Noida', 'Ongole', 'Ooty', 'Palakkad', 'Panaji', 'Panipat', 'Patiala', 'Patna',
    'Pimpri-Chinchwad', 'Pondicherry', 'Pune', 'Raichur', 'Raipur', 'Rajahmundry',
    'Rajkot', 'Ranchi', 'Rohtak', 'Rourkela', 'Sagar', 'Salem', 'Sangli', 'Satara',
    'Shimla', 'Shillong', 'Siliguri', 'Srinagar', 'Surat', 'Tadepalligudem', 'Tenali',
    'Thane', 'Thanjavur', 'Thiruvananthapuram', 'Thrissur', 'Tiruchirappalli',
    'Tirupati', 'Tiruppur', 'Tumakuru', 'Udaipur', 'Udupi', 'Ujjain', 'Vadodara',
    'Varanasi', 'Vellore', 'Vijayawada', 'Visakhapatnam', 'Vizianagaram', 'Warangal',
    'Yamunanagar', 'Yavatmal', 'Zirakpur'
];

// Deduplicate and sort alphabetically
allCitiesData = [...new Set(allCitiesData)].sort(function (a, b) {
    return a.localeCompare(b);
});

// =============================================
// POPULAR CITIES (Icon Paths)
// =============================================
var popularCities = [
    { name: 'Mumbai', icon: 'assets/images/icons/mumbai.png' },
    { name: 'Delhi-NCR', icon: 'assets/images/icons/delhi.png' },
    { name: 'Bengaluru', icon: 'assets/images/icons/bengaluru.png' },
    { name: 'Hyderabad', icon: 'assets/images/icons/hyderabad.png' },
    { name: 'Chandigarh', icon: 'assets/images/icons/chandigarh.png' },
    { name: 'Ahmedabad', icon: 'assets/images/icons/ahmedabad.png' },
    { name: 'Pune', icon: 'assets/images/icons/pune.png' },
    { name: 'Chennai', icon: 'assets/images/icons/chennai.png' },
    { name: 'Kolkata', icon: 'assets/images/icons/kolkata.png' },
    { name: 'Kochi', icon: 'assets/images/icons/kochi.png' }
];

// =============================================
// INITIALIZATION
// =============================================
document.addEventListener('DOMContentLoaded', function () {
    console.log('✅ Premium Location System Initialized');
    showInitialCities();
    populateAllCities();
    loadSavedCity();
});

// =============================================
// RENDER POPULAR CITIES (BookMyShow Clean Layout)
// =============================================
function showInitialCities() {
    var container = document.getElementById('initialCities');
    if (!container) return;

    container.innerHTML = '';

    popularCities.forEach(function (cityData) {
        var wrapper = document.createElement('div');
        wrapper.className = 'popular-city-card cursor-pointer';

        // Direct Icon Image (No outer border box)
        var iconImg = document.createElement('img');
        iconImg.src = cityData.icon;
        iconImg.alt = cityData.name;
        iconImg.className = 'popular-city-icon';

        iconImg.onerror = function () {
            this.style.visibility = 'hidden';
        };

        // Text Below Icon
        var nameSpan = document.createElement('div');
        nameSpan.className = 'popular-city-name';
        nameSpan.textContent = cityData.name;

        wrapper.appendChild(iconImg);
        wrapper.appendChild(nameSpan);

        wrapper.onclick = function () {
            selectCity(cityData.name);
        };

        container.appendChild(wrapper);
    });
}

// =============================================
// SHOW ALL CITIES
// =============================================
function showAllCities() {
    var allCitiesList = document.getElementById('allCitiesList');
    if (allCitiesList) allCitiesList.style.display = 'block';

    var viewBtn = document.getElementById('viewAllCitiesBtn');
    if (viewBtn) viewBtn.style.display = 'none';

    var hideBtn = document.getElementById('hideAllCitiesBtn');
    if (hideBtn) hideBtn.style.display = 'inline-block';

    populateAllCities();

    setTimeout(function () {
        if (allCitiesList) {
            allCitiesList.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }, 100);
}

// =============================================
// HIDE ALL CITIES
// =============================================
function hideAllCities() {
    var allCitiesList = document.getElementById('allCitiesList');
    if (allCitiesList) allCitiesList.style.display = 'none';

    var viewBtn = document.getElementById('viewAllCitiesBtn');
    if (viewBtn) viewBtn.style.display = 'inline-block';

    var hideBtn = document.getElementById('hideAllCitiesBtn');
    if (hideBtn) hideBtn.style.display = 'none';
}

// =============================================
// POPULATE ALL CITIES LIST
// =============================================
function populateAllCities(citiesToShow) {
    var container = document.getElementById('allCities');
    if (!container) return;

    if (!citiesToShow) {
        citiesToShow = allCitiesData;
    }

    container.innerHTML = '';

    if (citiesToShow.length === 0) {
        var noResult = document.createElement('div');
        noResult.className = 'no-city-result text-center py-3 w-100';
        noResult.innerHTML = '<span class="text-muted">No cities found</span>';
        container.appendChild(noResult);
        return;
    }

    var savedCity = localStorage.getItem('selectedCity');

    citiesToShow.forEach(function (city) {
        var div = document.createElement('div');
        div.className = 'list-city-item cursor-pointer';
        div.setAttribute('data-city', city);
        div.textContent = city;

        if (savedCity && savedCity.toLowerCase() === city.toLowerCase()) {
            div.classList.add('selected-city');
        }

        div.onclick = function () {
            selectCity(city);
        };

        container.appendChild(div);
    });
}

// =============================================
// SELECT CITY (BS4 & BS5 Compatible)
// =============================================
function selectCity(city) {
    if (!city) return;

    localStorage.setItem('selectedCity', city);
    updateNavbarLocation(city);

    var modalElement = document.getElementById('locationModal');
    if (modalElement) {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            var modal = bootstrap.Modal.getInstance(modalElement);
            if (!modal) {
                modal = new bootstrap.Modal(modalElement);
            }
            modal.hide();
        } else if (typeof $ !== 'undefined') {
            $(modalElement).modal('hide');
        }
    }

    resetCitySearch();
    hideAllCities();
}

// =============================================
// UPDATE NAVBAR LOCATION
// =============================================
function updateNavbarLocation(city) {
    var display = document.getElementById('currentLocationDisplay');
    if (!display) return;

    display.textContent = city;
    display.classList.add('location-updated');

    setTimeout(function () {
        display.classList.remove('location-updated');
    }, 500);
}

// =============================================
// LOAD SAVED CITY
// =============================================
function loadSavedCity() {
    var savedCity = localStorage.getItem('selectedCity');
    var display = document.getElementById('currentLocationDisplay');

    if (savedCity && display) {
        display.textContent = savedCity;
    } else if (display && !display.textContent.trim()) {
        display.textContent = 'Kochi';
    }
}

// =============================================
// SEARCH CITIES
// =============================================
function searchCities() {
    var input = document.getElementById('citySearchInput');
    if (!input) return;

    var query = input.value.toLowerCase().trim();

    if (query === '') {
        resetCitySearch();
        return;
    }

    var filteredCities = allCitiesData.filter(function (city) {
        return city.toLowerCase().includes(query);
    });

    var allCitiesList = document.getElementById('allCitiesList');
    if (allCitiesList) allCitiesList.style.display = 'block';

    var viewBtn = document.getElementById('viewAllCitiesBtn');
    if (viewBtn) viewBtn.style.display = 'none';

    var hideBtn = document.getElementById('hideAllCitiesBtn');
    if (hideBtn) hideBtn.style.display = 'inline-block';

    populateAllCities(filteredCities);
}

// =============================================
// RESET SEARCH
// =============================================
function resetCitySearch() {
    var input = document.getElementById('citySearchInput');
    if (input) input.value = '';

    hideAllCities();
    showInitialCities();
}

// =============================================
// DETECT LOCATION
// =============================================
function detectLocation() {
    if (!navigator.geolocation) {
        showLocationMessage('Location detection is not supported by your browser.', 'error');
        return;
    }

    var detectBtn = document.getElementById('detectLocationBtn');
    var detectText = document.getElementById('detectLocationText');

    if (detectBtn) detectBtn.disabled = true;

    if (detectText) {
        detectText.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            Detecting location...
        `;
    }

    showLocationMessage('Please allow location access in your browser.', 'info');

    navigator.geolocation.getCurrentPosition(
        function (position) {
            reverseGeocodeLocation(position.coords.latitude, position.coords.longitude);
        },
        function (error) {
            resetDetectButton();
            if (error.code === error.PERMISSION_DENIED) {
                showLocationMessage('Location permission was denied.', 'error');
            } else if (error.code === error.POSITION_UNAVAILABLE) {
                showLocationMessage('Current location unavailable.', 'error');
            } else if (error.code === error.TIMEOUT) {
                showLocationMessage('Location request timed out.', 'error');
            } else {
                showLocationMessage('Unable to detect location. Select manually.', 'error');
            }
        },
        {
            enableHighAccuracy: true,
            timeout: 15000,
            maximumAge: 300000
        }
    );
}

// =============================================
// REVERSE GEOCODING
// =============================================
async function reverseGeocodeLocation(latitude, longitude) {
    try {
        var apiUrl = 'https://api.bigdatacloud.net/data/reverse-geocode-client' +
            '?latitude=' + encodeURIComponent(latitude) +
            '&longitude=' + encodeURIComponent(longitude) +
            '&localityLanguage=en';

        var response = await fetch(apiUrl);
        if (!response.ok) throw new Error('Reverse geocoding failed');

        var data = await response.json();
        var city = data.city || data.locality || data.principalSubdivision;

        if (!city && data.localityInfo && data.localityInfo.administrative && data.localityInfo.administrative[2]) {
            city = data.localityInfo.administrative[2].name;
        }

        if (!city) throw new Error('City name not found');

        city = city.trim();

        showLocationMessage('Location detected: ' + city, 'success');
        resetDetectButton();

        setTimeout(function () {
            selectCity(city);
        }, 800);

    } catch (error) {
        resetDetectButton();
        showLocationMessage('Unable to identify city automatically. Please select manually.', 'error');
    }
}

// =============================================
// RESET DETECT BUTTON
// =============================================
function resetDetectButton() {
    var detectBtn = document.getElementById('detectLocationBtn');
    var detectText = document.getElementById('detectLocationText');

    if (detectBtn) detectBtn.disabled = false;
    if (detectText) detectText.textContent = 'Detect my location';
}

// =============================================
// SHOW LOCATION MESSAGE
// =============================================
function showLocationMessage(message, type) {
    var status = document.getElementById('locationStatus');

    if (!status) {
        var detectBtn = document.getElementById('detectLocationBtn');
        if (!detectBtn) return;

        status = document.createElement('div');
        status.id = 'locationStatus';
        status.className = 'location-status mt-2';
        detectBtn.parentNode.appendChild(status);
    }

    status.textContent = message;
    status.style.display = 'block';

    if (type === 'success') {
        status.style.color = '#198754';
    } else if (type === 'error') {
        status.style.color = '#dc3545';
    } else {
        status.style.color = '#6c757d';
    }

    if (type === 'success' || type === 'info') {
        setTimeout(function () {
            if (status) status.style.display = 'none';
        }, 3000);
    }
}

// =============================================
// UNIVERSAL MODAL EVENT LISTENERS
// =============================================
function handleModalReset() {
    resetCitySearch();
    var status = document.getElementById('locationStatus');
    if (status) status.style.display = 'none';
    resetDetectButton();
}

// Vanilla JS Listener (Bootstrap 5)
document.addEventListener('shown.bs.modal', function (event) {
    if (event.target && event.target.id === 'locationModal') handleModalReset();
});

document.addEventListener('hidden.bs.modal', function (event) {
    if (event.target && event.target.id === 'locationModal') handleModalReset();
});

// jQuery Listener Fallback (Bootstrap 4)
if (typeof $ !== 'undefined') {
    $('#locationModal').on('shown.bs.modal hidden.bs.modal', function () {
        handleModalReset();
    });
}