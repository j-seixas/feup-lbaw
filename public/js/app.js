function addEventListeners() {
  document.getElementById("deleteButton").addEventListener('click', sendDeleteEventRequest);
  //document.getElementById("editButton").addEventListener('click', sendEditEventRequest);
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

function sendEditEventRequest(event) {
  let id = event.target.value;

  sendAjaxRequest('get', '/event/' + id + '/edit', null, eventEditHandler);

}

function sendDeleteEventRequest(event) {
  let id = event.target.value;

  sendAjaxRequest('delete', '/event/' + id, null, eventDeletedHandler);
}

function eventDeletedHandler() {
  if(this.status == 200) {
    window.location = '/';
  }
}

function eventEditHandler() {
  if(this.status == 200) {
    window.location = '/event/' + id;
  }
}

addEventListeners();
