
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

//require('./bootstrap');

const openProfileEditModal = function() {
    let modal = document.querySelector('#editUserModal');
    modal.classList.remove('hidden');
    let nameField = document.querySelector("#editUserName");
    let pronounsField = document.querySelector('#editUserPronouns');
    let locationField = document.querySelector('#editUserLocation');
    let descriptionField = document.querySelector('#editUserDescription');
    
    nameField.value = nameField.getAttribute('data-default-name');
    pronounsField.value = pronounsField.getAttribute('data-default-pronouns');
    locationField.value = locationField.getAttribute('data-default-location');
    descriptionField.value = descriptionField.getAttribute('data-default-description');
}

const closeProfileEditdModal = function() {
    let modal = document.querySelector('#editUserModal');
    modal.classList.add('hidden');
    console.log('close')
}

const connectUser = function(event) {
    let receiver_id = event.target.getAttribute("data-id");
    if (receiver_id === null) {
        console.log("An error has occurred.");
        return;
    } 
    receiver_id = parseInt(receiver_id);
    sendAjaxRequest('post', '/api/friendship', {id: receiver_id}, connectHandler);
    // TODO: send ajax request
}

function connectHandler() {
    // console.log("Status: ", this.status, this.responseText);
    if (this.status != 200) {
        console.log("Action failed.");
        return;
    }
    // let item = JSON.parse(this.responseText);
    // console.log(item);
    window.location = "";
}

const deleteUserLink = function(event) {
        let receiver_id = event.target.getAttribute("data-id");
        if (receiver_id === null) {
            console.log("An error has occurred.");
            return;
        } 
        receiver_id = parseInt(receiver_id);
        sendAjaxRequest('delete', '/api/friendship', {id: receiver_id}, deleteLinkHandler);
}


function deleteLinkHandler() {
    if (this.status != 200) {
        console.log("Action failed.");
        return;
    }
    window.location = "";
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


function addEventListeners() {
    let userProfileConnectionButton = document.querySelector('#userProfileConnections');
    let editUserModalBack = document.querySelector('#editUserModalBack');
    if (editUserModalBack != null)
        editUserModalBack.addEventListener('click', () => closeProfileEditdModal());
    let connectButton = document.querySelector("#connect_button");
    if (connectButton != null) {
        if (connectButton.getAttribute("data-method") == "edit")
            connectButton.addEventListener('click', () => openProfileEditModal());
        else if (connectButton.getAttribute("data-method") == "connect")
            connectButton.addEventListener('click', (e) => connectUser(e));
        else if (connectButton.getAttribute("data-method") == "delete")
            connectButton.addEventListener('click', (e) => deleteUserLink(e));
    }
}  

addEventListeners();