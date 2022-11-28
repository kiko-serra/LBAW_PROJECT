
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


const openLeftPanelTab = function(number) {
    let leftPanelLinksList = document.querySelector("#left_panel_links_list");
    let leftPanelGroupsList = document.querySelector("#left_panel_groups_list");
    let leftPanelNotificationsList = document.querySelector("#left_panel_notifications_list");


    switch (number) {
        case 0: {
            leftPanelGroupsList.classList.add("hidden");
            leftPanelNotificationsList.classList.add("hidden");
            if (leftPanelLinksList != null) {
                leftPanelLinksList.classList.toggle("hidden");
            }
            break;
        }
        case 1: {
            leftPanelLinksList.classList.add("hidden");
            leftPanelNotificationsList.classList.add("hidden");
            if (leftPanelGroupsList != null) {
                leftPanelGroupsList.classList.toggle("hidden");
            }
            break;
        }
        case 2: {
            leftPanelLinksList.classList.add("hidden");
            leftPanelGroupsList.classList.add("hidden");
            if (leftPanelNotificationsList != null) {
                leftPanelNotificationsList.classList.toggle("hidden");
            }
            break;
        }
    }
}

//LINK REQUESTS

const leftPanelGetData = function () {
    console.log("leftPanel data fetch");

    sendAjaxRequest('get', '/api/leftpanel', null, leftPanelRequestHandler);

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


const deleteUserLink = function(event) {
    let receiver_id = event.target.getAttribute("data-id");
    if (receiver_id === null) {
        console.log("An error has occurred.");
        return;
    } 
    receiver_id = parseInt(receiver_id);
    sendAjaxRequest('delete', '/api/friendship', {id: receiver_id}, deleteLinkHandler);
}

const acceptLinkRequest = function(event) {
    console.log("accept")
    let receiver_id = event.getAttribute("data-id");
    if (receiver_id === null) {
        console.log("An error has occurred.");
        return;
    } 
    receiver_id = parseInt(receiver_id);
    sendAjaxRequest('put', '/api/friendship/request', {id: receiver_id}, acceptRequestHandler);
}

const declineLinkRequest = function(event) {
    console.log("refuse")
    let receiver_id = event.getAttribute("data-id");
    if (receiver_id === null) {
        console.log("An error has occurred.");
        return;
    } 
    receiver_id = parseInt(receiver_id);
    sendAjaxRequest('delete', '/api/friendship/request', {id: receiver_id}, declineRequestHandler);
}


//LINK HANDLERS
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
function deleteLinkHandler() {
    if (this.status != 200) {
        console.log("Action failed.");
        return;
    }
    window.location = "";
}

function acceptRequestHandler() {
    if (this.status != 200) {
        console.log("Action failed.");
        return;
    }
    window.location = "";
}

function declineRequestHandler() {
    if (this.status != 200) {
        console.log("Action failed.");
        return;
    }
    window.location = "";
}

function leftPanelRequestHandler() {
    // console.log("Status: ", this.status, this.responseText);
    if (this.status != 200) {
        console.log("Action failed.");
        return;
    }
    let data = JSON.parse(this.responseText);
    console.log(data);
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

//EVENT LISTENERS

function addEventListeners() {
    let userProfileConnectionButton = document.querySelector('#userProfileConnections');
    let editUserModalBack = document.querySelector('#editUserModalBack');
    if (editUserModalBack != null)
        editUserModalBack.addEventListener('click', () => closeProfileEditdModal());
    let connectButton = document.querySelector("#connect_button");
    let connectButtonAccept = document.querySelector("#connect_button_accept");
    let connectButtonDecline = document.querySelector("#connect_button_decline");
    let leftPanel = document.querySelector('#leftPanel');
    let leftPanelLinksButton = document.querySelector("#left_panel_link_button");
    let leftPanelGroupsButton = document.querySelector("#left_panel_group_button");
    let leftPanelNotificationsButton = document.querySelector("#left_panel_notification_button");
    if (connectButton != null) {
        if (connectButton.getAttribute("data-method") == "edit")
            connectButton.addEventListener('click', () => openProfileEditModal());
        else if (connectButton.getAttribute("data-method") == "connect")
            connectButton.addEventListener('click', (e) => connectUser(e));
        else if (connectButton.getAttribute("data-method") == "delete")
            connectButton.addEventListener('click', (e) => deleteUserLink(e));
    }
    if (connectButtonAccept != null)
        connectButtonAccept.addEventListener('click', (e) => acceptLinkRequest(connectButtonAccept));
    if (connectButtonDecline != null)
        connectButtonDecline.addEventListener('click', (e) => declineLinkRequest(connectButtonDecline));
    if (leftPanel != null)
        leftPanelGetData();
    if (leftPanelLinksButton != null)
        leftPanelLinksButton.addEventListener('click', (e) => openLeftPanelTab(0));
    if (leftPanelGroupsButton != null)
        leftPanelGroupsButton.addEventListener('click', (e) => openLeftPanelTab(1));
    if (leftPanelNotificationsButton != null)
        leftPanelNotificationsButton.addEventListener('click', (e) => openLeftPanelTab(2));
}  

addEventListeners();