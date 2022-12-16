/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

//require('./bootstrap');

const rightPanelChangeTab = function (tab, element, leftTab, rightTab) {
    console.log(tab);
    if (tab) {
        element.classList.add("right-sidepanel-tab-closed");
        leftTab.classList.remove("right-sidepanel-tab-button-selected");
        rightTab.classList.add("right-sidepanel-tab-button-selected");
    } else {
        element.classList.remove("right-sidepanel-tab-closed");
        leftTab.classList.add("right-sidepanel-tab-button-selected");
        rightTab.classList.remove("right-sidepanel-tab-button-selected");
    }
};

const openProfileEditModal = function () {
    let modal = document.querySelector("#editUserModal");
    modal.classList.remove("hidden");
    let nameField = document.querySelector("#editUserName");
    let pronounsField = document.querySelector("#editUserPronouns");
    let locationField = document.querySelector("#editUserLocation");
    let descriptionField = document.querySelector("#editUserDescription");

    nameField.value = nameField.getAttribute("data-default-name");
    pronounsField.value = pronounsField.getAttribute("data-default-pronouns");
    locationField.value = locationField.getAttribute("data-default-location");
    descriptionField.value = descriptionField.getAttribute(
        "data-default-description"
    );
};

const toggleGroupInviteModal = function () {
    let groupInviteModal = document.querySelector("#groupInviteModal");
    if (!groupInviteModal) return;
    groupInviteModal.classList.toggle("hidden");
    var offset = document.getElementById(
        "groupInviteModalContent"
    ).childElementCount;
    var id = groupInviteModal.getAttribute("data-id");
    query = document.getElementById("inviteGroupQuery").value;
    if (!groupInviteModal.classList.contains("hidden")) {
        sendAjaxRequest(
            "POST",
            "/api/group/friends/search/",
            { group: id, offset: offset, query: query },
            groupInviteModalHandler
        );
    }
    document.querySelector("#groupInviteModalContent").innerHTML = "";
};

const queryInviteUser = function () {
    let groupInviteModal = document.querySelector("#groupInviteModal");
    if (!groupInviteModal) return;
    var offset = 0;
    var id = groupInviteModal.getAttribute("data-id");
    query = document.getElementById("inviteGroupQuery").value;
    if (!groupInviteModal.classList.contains("hidden")) {
        sendAjaxRequest(
            "POST",
            "/api/group/friends/search/",
            { group: id, offset: offset, query: query },
            groupInviteModalHandler
        );
    }
    document.querySelector("#groupInviteModalContent").innerHTML = "";
};

const toggleCreateGroupModal = function () {
    document
        .querySelector("#leftPanelCreateGroupModal")
        .classList.toggle("hidden");
};

const closeProfileEditModal = function () {
    let modal = document.querySelector("#editUserModal");
    modal.classList.add("hidden");
};

const openLeftPanelTab = function (number) {
    let leftPanelLinksList = document.querySelector("#left_panel_links_list");
    let leftPanelLinksAddList = document.querySelector(
        "#left_panel_links_add_list"
    );
    let leftPanelGroupsList = document.querySelector("#left_panel_groups_list");
    let leftPanelGroupsAddList = document.querySelector(
        "#left_panel_groups_add_list"
    );
    let leftPanelNotificationsList = document.querySelector(
        "#left_panel_notifications_list"
    );

    switch (number) {
        case 0: {
            leftPanelLinksAddList.classList.add("hidden");
            leftPanelGroupsList.classList.add("hidden");
            leftPanelGroupsAddList.classList.add("hidden");
            leftPanelNotificationsList.classList.add("hidden");
            if (leftPanelLinksList != null) {
                leftPanelLinksList.classList.toggle("hidden");
            }
            break;
        }
        case 1: {
            leftPanelLinksList.classList.add("hidden");
            leftPanelGroupsList.classList.add("hidden");
            leftPanelGroupsAddList.classList.add("hidden");
            leftPanelNotificationsList.classList.add("hidden");
            if (leftPanelLinksAddList != null) {
                leftPanelLinksAddList.classList.toggle("hidden");
            }
            break;
        }
        case 2: {
            leftPanelLinksList.classList.add("hidden");
            leftPanelLinksAddList.classList.add("hidden");
            leftPanelGroupsAddList.classList.add("hidden");
            leftPanelNotificationsList.classList.add("hidden");
            if (leftPanelGroupsList != null) {
                leftPanelGroupsList.classList.toggle("hidden");
            }
            break;
        }
        case 3: {
            leftPanelLinksList.classList.add("hidden");
            leftPanelLinksAddList.classList.add("hidden");
            leftPanelGroupsList.classList.add("hidden");
            leftPanelNotificationsList.classList.add("hidden");
            if (leftPanelGroupsAddList != null) {
                leftPanelGroupsAddList.classList.toggle("hidden");
            }
            break;
        }
        case 4: {
            leftPanelLinksList.classList.add("hidden");
            leftPanelLinksAddList.classList.add("hidden");
            leftPanelGroupsList.classList.add("hidden");
            leftPanelGroupsAddList.classList.add("hidden");
            if (leftPanelNotificationsList != null) {
                leftPanelNotificationsList.classList.toggle("hidden");
            }
            break;
        }
    }
};

//LINK REQUESTS
window.block = function (element) {
    if (element.value == "Block") {
        element.value = "Unblock";
        element.classList.remove("bg-red-400", "hover:bg-red-700");
        element.classList.add("bg-green-400", "hover:bg-green-700");
        element = element.parentNode;
        var id = element.id;
        sendAjaxRequest("GET", "/users/block/" + id, null, reloadIfSuccessful);
    } else {
        element.value = "Block";
        element.classList.remove("bg-green-400", "hover:bg-green-700");
        element.classList.add("bg-red-400", "hover:bg-red-700");
        element = element.parentNode;
        var id = element.id;
        sendAjaxRequest(
            "GET",
            "/users/unblock/" + id,
            null,
            reloadIfSuccessful
        );
    }
};

const leftPanelGetData = function () {
    sendAjaxRequest("get", "/api/leftpanel", null, leftPanelRequestHandler);
};

const linkRequestsGetMoreData = function (offset) {
    sendAjaxRequest(
        "get",
        "/api/leftpanel/friendship-request/" + offset,
        null,
        linkRequestsGetMoreDataHandler
    );
};

const notificationsGetMoreData = function (offset) {
    sendAjaxRequest(
        "get",
        "/api/leftpanel/notifications/" + offset,
        null,
        notificationsGetMoreDataHandler
    );
};

const groupsGetMoreData = function (offset) {
    sendAjaxRequest(
        "get",
        "/api/leftpanel/groups/" + offset,
        null,
        groupsGetMoreDataHandler
    );
};

const linkUser = function (event) {
    let receiver_id = event.target.getAttribute("data-id");
    if (receiver_id === null) {
        console.log("An error has occurred.");
        return;
    }
    receiver_id = parseInt(receiver_id);
    sendAjaxRequest(
        "post",
        "/api/friendship",
        { id: receiver_id },
        reloadIfSuccessful
    );
};

const cancelUserLink = function (event) {
    let receiver_id = event.target.getAttribute("data-id");
    if (receiver_id === null) {
        console.log("An error has occurred.");
        return;
    }
    receiver_id = parseInt(receiver_id);
    sendAjaxRequest(
        "put",
        "/api/friendship",
        { id: receiver_id },
        reloadIfSuccessful
    );
};

const deleteUserLink = function (event) {
    let receiver_id = event.target.getAttribute("data-id");
    if (receiver_id === null) {
        console.log("An error has occurred.");
        return;
    }
    receiver_id = parseInt(receiver_id);
    sendAjaxRequest(
        "delete",
        "/api/friendship",
        { id: receiver_id },
        reloadIfSuccessful
    );
};

const acceptLinkRequest = function (event) {
    let receiver_id = event.getAttribute("data-id");
    if (receiver_id === null) {
        console.log("An error has occurred.");
        return;
    }
    receiver_id = parseInt(receiver_id);
    sendAjaxRequest(
        "put",
        "/api/friendship/request",
        { id: receiver_id },
        reloadIfSuccessful
    );
};

const declineLinkRequest = function (event) {
    let receiver_id = event.getAttribute("data-id");
    if (receiver_id === null) {
        console.log("An error has occurred.");
        return;
    }
    receiver_id = parseInt(receiver_id);
    sendAjaxRequest(
        "delete",
        "/api/friendship/request",
        { id: receiver_id },
        reloadIfSuccessful
    );
};

const filterLinks = function (input, common) {
    let receiver_id = input.getAttribute("data-id");
    if (receiver_id === null) {
        console.log("An error has occurred.");
        return;
    }
    sendAjaxRequest(
        "post",
        "/api/user/search",
        {
            id: receiver_id,
            text: input.value,
            common: common,
        },
        linksFiltered
    );
};

//LINK HANDLERS

function linksFiltered() {
    if (this.status != 200) {
        console.log("Action failed.");
        return;
    }
    let data = JSON.parse(this.responseText);
    let list = document.querySelector("#right-sidepanel-left-tab-content");
    list.innerHTML = "";
    data.results.forEach((element) => {
        var newElement = createElementFromHTML(element);
        list.appendChild(newElement);
    });
}

function reloadIfSuccessful() {
    //console.log(this.responseText)
    if (this.status != 200) {
        console.log("Action failed.");
        return;
    }
    window.location = "";
}

function leftPanelRequestHandler() {
    if (this.status != 200) {
        console.log("Action failed.");
        return;
    }
    let data = JSON.parse(this.responseText);
    //NOTIFICATIONS
    let notifications_counter = document.querySelector(
        "#left_panel_notification_counter"
    );
    let notifications_list = document.querySelector(
        "#left_panel_notifications_list"
    );
    notifications_list.innerHTML = "";
    if (data.notifications.length > 0) {
        if (data.new_notis > 0) {
            notifications_counter.classList.remove("hidden");
            notifications_counter.innerHTML = data.new_notis;
        } else {
            notifications_counter.classList.add("hidden");
        }
        data.notifications.forEach((element) => {
            var newElement = createElementFromHTML(element);
            newElement.addEventListener("click", (ev) =>
                readNotification(newElement.getAttribute("data-id"))
            );
            newElement
                .querySelector(".notification-delete")
                .addEventListener("click", (ev) => {
                    ev.stopPropagation();
                    deleteNotification(
                        newElement.getAttribute("data-id"),
                        newElement
                    );
                });
            notifications_list.appendChild(newElement);
        });

        var refreshButton = createElementFromHTML(
            '<img src=\'/icons/refresh.svg\') alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">'
        );
        notifications_list.appendChild(refreshButton);
        refreshButton.addEventListener("click", () => {
            notificationsGetMoreData(notifications_list.childElementCount - 1);
            notifications_list.removeChild(refreshButton);
        });
    } else {
        notifications_counter.classList.add("hidden");
        document.querySelector("#left_panel_notifications_list").innerHTML =
            "No notifications to show";
    }

    // LINK REQUESTS

    let link_counter = document.querySelector("#left_panel_link_add_counter");
    let link_list = document.querySelector("#left_panel_links_add_list");
    link_list.innerHTML = "";
    if (data.link_requests.length > 0) {
        link_counter.classList.remove("hidden");
        link_counter.innerHTML = data.link_requests.length;
        data.link_requests.forEach((element) => {
            var newElement = createElementFromHTML(element);
            newElement
                .querySelector(".link-request-accept")
                .addEventListener("click", (ev) =>
                    acceptLinkRequest(newElement)
                );
            newElement
                .querySelector(".link-request-refuse")
                .addEventListener("click", (ev) =>
                    declineLinkRequest(newElement)
                );
            link_list.appendChild(newElement);
        });

        var refreshButton = createElementFromHTML(
            '<img src=\'/icons/refresh.svg\') alt="link icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">'
        );
        link_list.appendChild(refreshButton);
        refreshButton.addEventListener("click", () => {
            linkRequestsGetMoreData(link_list.childElementCount - 1);
            link_list.removeChild(refreshButton);
        });
    } else {
        link_counter.classList.add("hidden");
        document.querySelector("#left_panel_links_add_list").innerHTML =
            "No link requests to show";
    }

    // GROUPS
    let group_list = document.querySelector("#left_panel_groups_list_content");
    group_list.innerHTML = "";
    if (data.groups.length > 0) {
        data.groups.forEach((element) => {
            var newElement = createElementFromHTML(element);
            group_list.appendChild(newElement);
        });

        var refreshButton = createElementFromHTML(
            '<img src=\'/icons/refresh.svg\') alt="link icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">'
        );
        group_list.appendChild(refreshButton);
        refreshButton.addEventListener("click", () => {
            groupsGetMoreData(group_list.childElementCount - 1);
            group_list.removeChild(refreshButton);
        });
    } else {
        document.querySelector("#left_panel_groups_list_content").innerHTML =
            "No groups to show";
    }
}

function groupInviteModalHandler() {
    if (this.status != 200) {
        console.log("Action failed.");
        document.getElementById("groupInviteModalContent").innerHTML =
            "Failed to load";
        return;
    }
    let data = JSON.parse(this.responseText);
    let invite_list = document.getElementById("groupInviteModalContent");
    if (invite_list.childElementCount == 0) invite_list.innerHTML = "";
    if (data.results.length > 0) {
        data.results.forEach((element) => {
            var newElement = createElementFromHTML(element);
            invite_list.appendChild(newElement);
        });
    }
}

function linkRequestsGetMoreDataHandler() {
    if (this.status != 200) {
        console.log("Action failed.");
        let link_add_list = document.querySelector(
            "#left_panel_links_add_list"
        );
        var refreshButton = createElementFromHTML(
            '<img src=\'/icons/refresh.svg\') alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">'
        );
        link_add_list.appendChild(refreshButton);
        refreshButton.addEventListener("click", () => {
            linkRequestsGetMoreData(link_add_list.childElementCount - 1);
            link_add_list.removeChild(refreshButton);
        });
        return;
    }
    let data = JSON.parse(this.responseText);
    let counter = document.querySelector("#left_panel_link_add_counter");
    let link_add_list = document.querySelector("#left_panel_links_add_list");
    link_add_list.innerHTML = "";
    if (data.link_requests.length > 0) {
        counter.innerHTML = data.link_requests.length;
        data.link_requests.forEach((element) => {
            var newElement = createElementFromHTML(element);
            newElement
                .querySelector(".link-request-accept")
                .addEventListener("click", (ev) =>
                    acceptLinkRequest(newElement)
                );
            newElement
                .querySelector(".link-request-refuse")
                .addEventListener("click", (ev) =>
                    declineLinkRequest(newElement)
                );
            link_add_list.appendChild(newElement);
        });

        if (data.more_data) {
            var refreshButton = createElementFromHTML(
                '<img src=\'/icons/refresh.svg\') alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer cursor-pointer">'
            );
            link_add_list.appendChild(refreshButton);
            refreshButton.addEventListener("click", () => {
                linkRequestsGetMoreData(link_add_list.childElementCount - 1);
                link_add_list.removeChild(refreshButton);
            });
        }
    }
}

function notificationsGetMoreDataHandler() {
    if (this.status != 200) {
        console.log("Action failed.");
        let notifications_list = document.querySelector(
            "#left_panel_notifications_list"
        );
        var refreshButton = createElementFromHTML(
            '<img src=\'/icons/refresh.svg\') alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">'
        );
        notifications_list.appendChild(refreshButton);
        refreshButton.addEventListener("click", () => {
            notificationsGetMoreData(notifications_list.childElementCount - 1);
            notifications_list.removeChild(refreshButton);
        });
        return;
    }
    let data = JSON.parse(this.responseText);
    let counter = document.querySelector("#left_panel_notification_counter");
    let notifications_list = document.querySelector(
        "#left_panel_notifications_list"
    );
    notifications_list.innerHTML = "";
    if (data.notifications.length > 0) {
        counter.innerHTML = data.new_notis;
        data.notifications.forEach((element) => {
            var newElement = createElementFromHTML(element);
            newElement.addEventListener("click", (ev) =>
                readNotification(newElement.getAttribute("data-id"))
            );
            newElement
                .querySelector(".notification-delete")
                .addEventListener("click", (ev) => {
                    ev.stopPropagation();
                    deleteNotification(
                        newElement.getAttribute("data-id"),
                        newElement
                    );
                });
            notifications_list.appendChild(newElement);
        });

        if (data.more_data) {
            var refreshButton = createElementFromHTML(
                '<img src=\'/icons/refresh.svg\') alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer cursor-pointer">'
            );
            notifications_list.appendChild(refreshButton);
            refreshButton.addEventListener("click", () => {
                notificationsGetMoreData(
                    notifications_list.childElementCount - 1
                );
                notifications_list.removeChild(refreshButton);
            });
        }
    }
}

function groupsGetMoreDataHandler() {
    if (this.status != 200) {
        console.log("Action failed.");
        let notifications_list = document.querySelector(
            "#left_panel_groups_list_content"
        );
        var refreshButton = createElementFromHTML(
            '<img src=\'/icons/refresh.svg\') alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">'
        );
        notifications_list.appendChild(refreshButton);
        refreshButton.addEventListener("click", () => {
            groupsGetMoreData(notifications_list.childElementCount - 1);
            notifications_list.removeChild(refreshButton);
        });
        return;
    }
    let data = JSON.parse(this.responseText);
    let group_list = document.querySelector("#left_panel_groups_list_content");
    group_list.innerHTML = "";
    if (data.groups.length > 0) {
        data.groups.forEach((element) => {
            var newElement = createElementFromHTML(element);
            group_list.appendChild(newElement);
        });
        if (data.more_data) {
            var refreshButton = createElementFromHTML(
                '<img src=\'/icons/refresh.svg\') alt="link icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">'
            );
            group_list.appendChild(refreshButton);
            refreshButton.addEventListener("click", () => {
                groupsGetMoreData(group_list.childElementCount - 1);
                group_list.removeChild(refreshButton);
            });
        }
    } else {
        document.querySelector("#left_panel_groups_list_content").innerHTML =
            "No groups to show";
    }
}

function notificationReadHandler() {
    if (this.status != 200) {
        console.log("action failed");
        return;
    }
    let data = JSON.parse(this.responseText);
    window.location = data["url"];
}

function notificationDeleteHandler() {
    if (this.status != 200) {
        console.log("action failed");
        return;
    }
}

const readNotification = function (id) {
    sendAjaxRequest(
        "post",
        "/api/notification",
        { id: id },
        notificationReadHandler
    );
};

const deleteNotification = function (id, newElement) {
    sendAjaxRequest(
        "delete",
        "/api/notification",
        { id: id },
        notificationDeleteHandler
    );
    if (newElement.classList.contains("bg-blue-100")) {
        var counter = document.querySelector(
            "#left_panel_notification_counter"
        );
        counter.innerHTML = parseInt(counter.innerHTML) - 1;
        if (parseInt(counter.innerHTML) === 0) counter.classList.add("hidden");
    }
    newElement.remove();
};

function createElementFromHTML(htmlString) {
    var div = document.createElement("div");
    div.innerHTML = htmlString.trim();

    return div.firstChild;
}

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data)
        .map(function (k) {
            return encodeURIComponent(k) + "=" + encodeURIComponent(data[k]);
        })
        .join("&");
}

function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();

    request.open(method, url, true);
    request.setRequestHeader(
        "X-CSRF-TOKEN",
        document.querySelector('meta[name="csrf-token"]').content
    );
    request.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );
    request.addEventListener("load", handler);
    request.send(encodeForAjax(data));
}

//EVENT LISTENERS

function addEventListeners() {
    let editUserModalBack = document.querySelector("#editUserModalBack");
    let linkButton = document.querySelector("#link_button");
    let linkButtonAccept = document.querySelector("#link_button_accept");
    let linkButtonDecline = document.querySelector("#link_button_decline");
    let leftPanel = document.querySelector("#leftPanel");
    let leftPanelLinksButton = document.querySelector(
        "#left_panel_link_button"
    );
    let leftPanelLinksAddButton = document.querySelector(
        "#left_panel_link_add_button"
    );
    let leftPanelGroupsButton = document.querySelector(
        "#left_panel_group_button"
    );
    let leftPanelNotificationsButton = document.querySelector(
        "#left_panel_notification_button"
    );
    let leftPanelGroupsAddButton = document.querySelector(
        "#left_panel_group_add_button"
    );
    let commonLinkFilter = document.querySelector(
        "#right-panel-common-link-filter"
    );
    let linkFilter = document.querySelector("#linksfilter");
    let userProfileFriendLinks = document.querySelector(
        "#userProfileFriendlinks"
    );
    let userProfileLinks = document.querySelector("#userProfilelinks");
    let createGroupButton = document.querySelector("#left_panel_groups_create");
    let groupInviteButton = document.querySelector("#groupInviteModalButton");
    let rightSidepanelRightTabButton = document.querySelector(
        "#right-sidepanel-right-tab-button"
    );
    let rightSidepanelLeftTabButton = document.querySelector(
        "#right-sidepanel-left-tab-button"
    );

    let rightSidepanelLeftTab = document.querySelector(
        "#right-sidepanel-left-tab"
    );
    let inviteGroupQuery = document.querySelector("#inviteGroupQuery");

    if (editUserModalBack != null)
        editUserModalBack.addEventListener("click", () =>
            closeProfileEditModal()
        );
    if (linkButton != null) {
        if (linkButton.getAttribute("data-method") == "edit")
            linkButton.addEventListener("click", () => openProfileEditModal());
        else if (linkButton.getAttribute("data-method") == "link")
            linkButton.addEventListener("click", (e) => linkUser(e));
        else if (linkButton.getAttribute("data-method") == "cancel")
            linkButton.addEventListener("click", (e) => cancelUserLink(e));
        else if (linkButton.getAttribute("data-method") == "delete")
            linkButton.addEventListener("click", (e) => deleteUserLink(e));
    }
    if (linkButtonAccept != null)
        linkButtonAccept.addEventListener("click", (e) =>
            acceptLinkRequest(linkButtonAccept)
        );
    if (linkButtonDecline != null)
        linkButtonDecline.addEventListener("click", (e) =>
            declineLinkRequest(linkButtonDecline)
        );
    if (leftPanel != null) leftPanelGetData();
    if (leftPanelLinksButton != null)
        leftPanelLinksButton.addEventListener("click", (e) =>
            openLeftPanelTab(0)
        );
    if (leftPanelLinksAddButton != null)
        leftPanelLinksAddButton.addEventListener("click", (e) =>
            openLeftPanelTab(1)
        );
    if (leftPanelGroupsButton != null)
        leftPanelGroupsButton.addEventListener("click", (e) =>
            openLeftPanelTab(2)
        );
    if (leftPanelGroupsAddButton != null)
        leftPanelGroupsAddButton.addEventListener("click", (e) =>
            openLeftPanelTab(3)
        );
    if (leftPanelNotificationsButton != null)
        leftPanelNotificationsButton.addEventListener("click", (e) =>
            openLeftPanelTab(4)
        );
    if (commonLinkFilter != null && linkFilter != null)
        commonLinkFilter.addEventListener("click", (e) => {
            commonLinkFilter.classList.toggle("common-link-filter-selected");
            filterLinks(
                linkFilter,
                commonLinkFilter.classList.contains(
                    "common-link-filter-selected"
                )
            );
        });
    if (
        linkFilter != null &&
        document.querySelector("#right-panel-common-link-filter > p") != null
    ) {
        linkFilter.addEventListener("keyup", (ev) => {
            filterLinks(
                ev.target,
                commonLinkFilter.classList.contains(
                    "common-link-filter-selected"
                )
            );
        });
    }

    if (userProfileFriendLinks != null && linkFilter != null) {
        userProfileFriendLinks.addEventListener("click", (ev) => {
            if (commonLinkFilter != null)
                commonLinkFilter.classList.add("common-link-filter-selected");
            linkFilter.value = "";
            filterLinks(linkFilter, true);
        });
    }

    if (userProfileLinks != null && linkFilter != null) {
        userProfileLinks.addEventListener("click", (ev) => {
            if (commonLinkFilter != null)
                commonLinkFilter.classList.remove(
                    "common-link-filter-selected"
                );
            linkFilter.value = "";
            filterLinks(linkFilter, false);
        });
    }
    if (createGroupButton != null) {
        createGroupButton.addEventListener("click", (ev) =>
            toggleCreateGroupModal()
        );
        if (document.querySelector("#toggleCreateGroupModalClose"))
            document
                .querySelector("#toggleCreateGroupModalClose")
                .addEventListener("click", (ev) => toggleCreateGroupModal());
    }

    if (groupInviteButton != null) {
        groupInviteButton.addEventListener("click", (ev) =>
            toggleGroupInviteModal()
        );
        if (document.querySelector("#toggleGroupInviteModalClose"))
            document
                .querySelector("#toggleGroupInviteModalClose")
                .addEventListener("click", (ev) => toggleGroupInviteModal());
    }

    if (
        rightSidepanelLeftTabButton != null &&
        rightSidepanelRightTabButton != null &&
        rightSidepanelLeftTab != null
    ) {
        rightSidepanelLeftTabButton.addEventListener("click", (ev) =>
            rightPanelChangeTab(
                0,
                rightSidepanelLeftTab,
                rightSidepanelLeftTabButton,
                rightSidepanelRightTabButton
            )
        );
        rightSidepanelRightTabButton.addEventListener("click", (ev) =>
            rightPanelChangeTab(
                1,
                rightSidepanelLeftTab,
                rightSidepanelLeftTabButton,
                rightSidepanelRightTabButton
            )
        );
    }

    if (inviteGroupQuery != null) {
        inviteGroupQuery.addEventListener("keyup", (ev) => {
            if (
                inviteGroupQuery.value !=
                inviteGroupQuery.getAttribute("data-last-query")
            )
                queryInviteUser();
            inviteGroupQuery.setAttribute(
                "data-last-query",
                inviteGroupQuery.value
            );
        });
    }
}

addEventListeners();
