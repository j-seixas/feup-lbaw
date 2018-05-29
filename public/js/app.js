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
  let id = document.getElementById("eventId").value;
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
  let activeButtons = document.querySelectorAll('.attendanceButton.active');

  [].forEach.call(activeButtons, function (activeButton) {
    activeButton.classList.toggle('active');
  });

  let attendanceInfo = JSON.parse(this.responseText);

  document.querySelector('#' + attendanceInfo.attendance + 'Button').classList.toggle('active');
  document.querySelector('#participants').innerHTML = attendanceInfo.participants;
  document.querySelector('#interested').innerHTML = attendanceInfo.interested;
}

function updateCountryList() {
  if (this.status == 200) {
    
  }
}

function changeUserPageToEdit(event) {
  let deleteUserCard = document.getElementById('deleteUserCard');
  deleteUserCard.hidden = false;

  event.target.innerHTML = '<i class="fas fa-check"></i> Done';
  event.target.classList.toggle('btn-outline-primary');
  event.target.classList.toggle('btn-outline-success');

  event.target.removeEventListener('click', changeUserPageToEdit);

  let memberName = document.getElementById('memberName');
  memberName.hidden = true;

  let memberNameInput = document.createElement('input');
  memberName.insertAdjacentElement('afterend', memberNameInput);
  memberNameInput.outerHTML = '<input type="text" class="form-control" id="eventName" name="eventName" required="required">';
  memberNameInput.value = memberName.innerText;
  sendCountryListRequest();
}

addEventListeners();
