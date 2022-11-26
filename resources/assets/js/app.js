
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

const followUser = function() {
    console.log("to be implemented");
    // TODO: send ajax request
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
    let followButton = document.querySelector("#follow_button");
    if (followButton != null) {
        if (followButton.getAttribute("data-method") == "edit")
            followButton.addEventListener('click', () => openProfileEditModal());
        else if (followButton.getAttribute("data-method") == "connect")
            followButton.addEventListener('click', () => followUser());
    }}  

addEventListeners();