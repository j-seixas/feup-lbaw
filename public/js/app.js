function addEventListeners() {
  let eventDeleteButton = document.getElementById("deleteButton");

  if (eventDeleteButton != null) {
    eventDeleteButton.addEventListener('click', sendDeleteEventRequest);
  }
  
  let attendanceEditButtons = document.querySelectorAll(".attendanceButton");
  
  if (attendanceEditButtons != null) {
    [].forEach.call(attendanceEditButtons, function(attendanceButton) {
      attendanceButton.addEventListener('click', sendEditAttendanceRequest);
    });
  }
}

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
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


function eventDeletedHandler() {
  if(this.status == 200) {
    window.location = '/';
  }
}

function updateAttendanceEditHandler(){
  let activeButtons = document.querySelectorAll('.attendanceButton.active');

  [].forEach.call(activeButtons, function(activeButton) {
    activeButton.classList.toggle('active');
  });

  let attendanceInfo = JSON.parse(this.responseText);

  document.querySelector('#' + attendanceInfo.attendance + 'Button').classList.toggle('active');
  document.querySelector('#participants').innerHTML = attendanceInfo.participants;
  document.querySelector('#interested').innerHTML = attendanceInfo.interested;
}

addEventListeners();
