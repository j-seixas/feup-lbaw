function addEventListeners() {
  let eventDeleteButton = document.getElementById("eventDeleteButton");

  if (eventDeleteButton != null) {
    eventDeleteButton.addEventListener('click', sendDeleteEventRequest);
  }

  let memberEditButton = document.getElementById("memberEditButton");

  if (memberEditButton != null) {
    memberEditButton.addEventListener('click', changeUserPageToEdit);
  }

  let attendanceEditButtons = document.querySelectorAll(".attendanceButton");

  if (attendanceEditButtons != null) {
    [].forEach.call(attendanceEditButtons, function (attendanceButton) {
      attendanceButton.addEventListener('click', sendEditAttendanceRequest);
    });
  }
}

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}

function sendDeleteEventRequest(event) {
  let id = document.getElementById("eventId").value;

  sendAjaxRequest('delete', '/event/' + id, null, eventDeletedHandler);
}

function sendEditAttendanceRequest(event) {
  let id = event.target.parentNode.previousElementSibling.value;
  let attendance = event.target.value;
  sendAjaxRequest('post', '/api/event/' + id + '/attendance', {'attendance': attendance}, updateAttendanceEditHandler);
}

function sendCountryListRequest() {
  sendAjaxRequest('get', '/api/country', null, updateCountryList);
}

function eventDeletedHandler() {
  if (this.status == 200) {
    window.location = '/';
  }
}

function updateAttendanceEditHandler() {
  let attendanceInfo = JSON.parse(this.responseText);
  
  let activeButtons = document.querySelectorAll('#attendanceEventId'  + attendanceInfo.id + '.attendanceButton.active');

  [].forEach.call(activeButtons, function (activeButton) {
    activeButton.classList.toggle('active');
  });

  let attendanceInfo = JSON.parse(this.responseText);

  document.querySelector('#attendanceEventId'  + attendanceInfo.id + ' button[value=' + attendanceInfo.attendance + ']').classList.toggle('active');

  if(document.querySelector('#participants')) document.querySelector('#participants').innerHTML = attendanceInfo.participants;
  if(document.querySelector('#interested')) document.querySelector('#interested').innerHTML = attendanceInfo.interested;
}

function updateCountryList() {
  if (this.status != 200) {
    return;
  }

  let memberCountry = document.getElementById('memberCountry');
  memberCountry.hidden = true;

  let memberCountryInput = document.createElement('select');
  memberCountryInput.classList.add('form-control');
  memberCountryInput.id = 'memberCountryInput';
  memberCountryInput.name = 'memberCountryInput';
  memberCountry.insertAdjacentElement('afterend', memberCountryInput);

  let countries = JSON.parse(this.responseText);
  for (let i = 0; i < countries.length; i++) {
    let country = document.createElement('option');
    country.value = countries[i].id;
    country.innerText = countries[i].name;
    if (country.innerText == memberCountry.innerText) {
      country.selected = true;
    }
    memberCountryInput.appendChild(country);
  }
}

function changeUserPageToEdit(event) {
  let deleteUserCard = document.getElementById('deleteUserCard');
  deleteUserCard.hidden = false;

  let editButton = document.getElementById('memberEditButton');
  editButton.innerHTML = '<i class="fas fa-check"></i> Done';
  editButton.classList.toggle('btn-outline-primary');
  editButton.classList.toggle('btn-outline-success');

  editButton.removeEventListener('click', changeUserPageToEdit);

  let memberName = document.getElementById('memberName');
  memberName.hidden = true;

  let memberNameInput = document.createElement('input');
  memberNameInput.type = 'text';
  memberNameInput.classList.add('form-control');
  memberNameInput.classList.add('form-control-lg');
  memberNameInput.classList.add('mb-3');
  memberNameInput.id = 'memberNameInput';
  memberNameInput.name = 'memberName';
  memberNameInput.required = true;
  memberNameInput.style = 'max-width: 75%'
  memberNameInput.placeholder = 'Name';
  memberNameInput.value = memberName.innerText;
  memberName.insertAdjacentElement('afterend', memberNameInput);

  let memberDescription = document.getElementById('memberDescription');
  memberDescription.hidden = true;

  let memberDescriptionInput = document.createElement('textarea');
  memberDescriptionInput.classList.add('form-control');
  memberDescriptionInput.id = 'memberDescriptionInput';
  memberDescriptionInput.name = 'memberDescription';
  memberDescriptionInput.placeholder = 'Description';
  memberDescriptionInput.value = memberDescription.innerText;
  memberDescription.insertAdjacentElement('afterend', memberDescriptionInput);

  sendCountryListRequest();
}

addEventListeners();
