
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

//require('./bootstrap');

const openFriendModal = function(tab) {
    let modal = document.querySelector('#connectionsModal');
    modal.classList.remove('hidden');
    switchFriendModalTab(tab);
}

const closeFriendModal = function() {
    let modal = document.querySelector('#connectionsModal');
    modal.classList.add('hidden');
    console.log('close')
}

const switchFriendModalTab = function(tab) {
    if (tab != 0 && tab != 1) return;
    let tab0Button = document.querySelector("#connectionsModalTab0Button");
    let tab1Button = document.querySelector("#connectionsModalTab1Button");
    let tab0Section = document.querySelector("#connectionsModalTab0");
    let tab1Section = document.querySelector("#connectionsModalTab1");

    if (tab0Button == null || tab1Button == null || tab0Section == null || tab1Section == null) {
        closeFriendModal();
        return;
    }
    if (tab == 1) {
        tab1Button.classList.add('bg-gray-100');
        tab1Button.classList.add('rounded-t-lg');
        tab0Button.classList.remove('bg-gray-100');
        tab0Button.classList.remove('rounded-t-lg');
        tab0Section.classList.add('hidden');
        tab1Section.classList.remove('hidden');
    } else {
        tab0Button.classList.add('bg-gray-100');
        tab0Button.classList.add('rounded-t-lg');
        tab1Button.classList.remove('bg-gray-100');
        tab1Button.classList.remove('rounded-t-lg');
        tab0Section.classList.remove('hidden');
        tab1Section.classList.add('hidden');
    }

}

function addEventListeners() {
    let userProfileConnectionButton = document.querySelector('#userProfileConnections');
    if (userProfileConnectionButton != null)
        userProfileConnectionButton.addEventListener('click', () => openFriendModal(1));
    let userProfileFriendConnectionButton = document.querySelector('#userProfileFriendConnections');
    if (userProfileFriendConnectionButton != null)
        userProfileFriendConnectionButton.addEventListener('click', () => openFriendModal(0));
    let connectionsModalBack = document.querySelector('#connectionsModalBack');
    if (connectionsModalBack != null)
        connectionsModalBack.addEventListener('click', () => closeFriendModal());
    let tab0Button = document.querySelector("#connectionsModalTab0Button");
    let tab1Button = document.querySelector("#connectionsModalTab1Button");
    if (tab0Button != null)
        tab0Button.addEventListener('click', () => switchFriendModalTab(0));
    if (tab1Button != null)
        tab1Button.addEventListener('click', () => switchFriendModalTab(1));
}  

addEventListeners();