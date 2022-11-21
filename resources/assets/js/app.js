
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

//require('./bootstrap');

const openFriendModal = function(type) {
    console.log('tried to open with', type)
}

function addEventListeners() {
    let userProfileConnectionButton = document.querySelector('#userProfileConnections');
    if (userProfileConnectionButton != null)
        userProfileConnectionButton.addEventListener('click', () => openFriendModal(1));
    let userProfileFriendConnectionButton = document.querySelector('#userProfileFriendConnections');
    if (userProfileFriendConnectionButton != null)
        userProfileFriendConnectionButton.addEventListener('click', () => openFriendModal(0));
}  

addEventListeners();