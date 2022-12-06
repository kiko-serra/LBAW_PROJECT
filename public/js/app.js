/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/js/app.js":
/*!************************************!*\
  !*** ./resources/assets/js/app.js ***!
  \************************************/
/***/ (() => {

/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

//require('./bootstrap');

var openProfileEditModal = function openProfileEditModal() {
  var modal = document.querySelector("#editUserModal");
  modal.classList.remove("hidden");
  var nameField = document.querySelector("#editUserName");
  var pronounsField = document.querySelector("#editUserPronouns");
  var locationField = document.querySelector("#editUserLocation");
  var descriptionField = document.querySelector("#editUserDescription");
  nameField.value = nameField.getAttribute("data-default-name");
  pronounsField.value = pronounsField.getAttribute("data-default-pronouns");
  locationField.value = locationField.getAttribute("data-default-location");
  descriptionField.value = descriptionField.getAttribute("data-default-description");
};
var closeProfileEditModal = function closeProfileEditModal() {
  var modal = document.querySelector("#editUserModal");
  modal.classList.add("hidden");
};
var openLeftPanelTab = function openLeftPanelTab(number) {
  var leftPanelLinksList = document.querySelector("#left_panel_links_list");
  var leftPanelLinksAddList = document.querySelector("#left_panel_links_add_list");
  var leftPanelGroupsList = document.querySelector("#left_panel_groups_list");
  var leftPanelGroupsAddList = document.querySelector("#left_panel_groups_add_list");
  var leftPanelNotificationsList = document.querySelector("#left_panel_notifications_list");
  switch (number) {
    case 0:
      {
        leftPanelLinksAddList.classList.add("hidden");
        leftPanelGroupsList.classList.add("hidden");
        leftPanelGroupsAddList.classList.add("hidden");
        leftPanelNotificationsList.classList.add("hidden");
        if (leftPanelLinksList != null) {
          leftPanelLinksList.classList.toggle("hidden");
        }
        break;
      }
    case 1:
      {
        leftPanelLinksList.classList.add("hidden");
        leftPanelGroupsList.classList.add("hidden");
        leftPanelGroupsAddList.classList.add("hidden");
        leftPanelNotificationsList.classList.add("hidden");
        if (leftPanelLinksAddList != null) {
          leftPanelLinksAddList.classList.toggle("hidden");
        }
        break;
      }
    case 2:
      {
        leftPanelLinksList.classList.add("hidden");
        leftPanelLinksAddList.classList.add("hidden");
        leftPanelGroupsAddList.classList.add("hidden");
        leftPanelNotificationsList.classList.add("hidden");
        if (leftPanelGroupsList != null) {
          leftPanelGroupsList.classList.toggle("hidden");
        }
        break;
      }
    case 3:
      {
        leftPanelLinksList.classList.add("hidden");
        leftPanelLinksAddList.classList.add("hidden");
        leftPanelGroupsList.classList.add("hidden");
        leftPanelNotificationsList.classList.add("hidden");
        if (leftPanelGroupsAddList != null) {
          leftPanelGroupsAddList.classList.toggle("hidden");
        }
        break;
      }
    case 4:
      {
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

var leftPanelGetData = function leftPanelGetData() {
  sendAjaxRequest("get", "/api/leftpanel", null, leftPanelRequestHandler);
};
var linkRequestsGetMoreData = function linkRequestsGetMoreData(offset) {
  sendAjaxRequest("get", "/api/leftpanel/friendship-request/" + offset, null, linkRequestsGetMoreDataHandler);
};
var notificationsGetMoreData = function notificationsGetMoreData(offset) {
  sendAjaxRequest("get", "/api/leftpanel/notifications/" + offset, null, notificationsGetMoreDataHandler);
};
var linkUser = function linkUser(event) {
  var receiver_id = event.target.getAttribute("data-id");
  if (receiver_id === null) {
    console.log("An error has occurred.");
    return;
  }
  receiver_id = parseInt(receiver_id);
  sendAjaxRequest("post", "/api/friendship", {
    id: receiver_id
  }, reloadIfSuccessful);
};
var cancelUserLink = function cancelUserLink(event) {
  var receiver_id = event.target.getAttribute("data-id");
  if (receiver_id === null) {
    console.log("An error has occurred.");
    return;
  }
  receiver_id = parseInt(receiver_id);
  sendAjaxRequest("put", "/api/friendship", {
    id: receiver_id
  }, reloadIfSuccessful);
};
var deleteUserLink = function deleteUserLink(event) {
  var receiver_id = event.target.getAttribute("data-id");
  if (receiver_id === null) {
    console.log("An error has occurred.");
    return;
  }
  receiver_id = parseInt(receiver_id);
  sendAjaxRequest("delete", "/api/friendship", {
    id: receiver_id
  }, reloadIfSuccessful);
};
var acceptLinkRequest = function acceptLinkRequest(event) {
  var receiver_id = event.getAttribute("data-id");
  if (receiver_id === null) {
    console.log("An error has occurred.");
    return;
  }
  receiver_id = parseInt(receiver_id);
  sendAjaxRequest("put", "/api/friendship/request", {
    id: receiver_id
  }, reloadIfSuccessful);
};
var declineLinkRequest = function declineLinkRequest(event) {
  var receiver_id = event.getAttribute("data-id");
  if (receiver_id === null) {
    console.log("An error has occurred.");
    return;
  }
  receiver_id = parseInt(receiver_id);
  sendAjaxRequest("delete", "/api/friendship/request", {
    id: receiver_id
  }, reloadIfSuccessful);
};
var filterLinks = function filterLinks(input, common) {
  var receiver_id = input.getAttribute("data-id");
  if (receiver_id === null) {
    console.log("An error has occurred.");
    return;
  }
  sendAjaxRequest("post", "/api/user/search", {
    id: receiver_id,
    text: input.value,
    common: common
  }, linksFiltered);
};

//LINK HANDLERS

function linksFiltered() {
  if (this.status != 200) {
    console.log("Action failed.");
    return;
  }
  var data = JSON.parse(this.responseText);
  var list = document.querySelector("#right-panel-links");
  list.innerHTML = "";
  data.results.forEach(function (element) {
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
  var data = JSON.parse(this.responseText);
  //NOTIFICATIONS
  var notifications_counter = document.querySelector("#left_panel_notification_counter");
  var notifications_list = document.querySelector("#left_panel_notifications_list");
  notifications_list.innerHTML = "";
  if (data.notifications.length > 0) {
    if (data.new_notis > 0) {
      notifications_counter.classList.remove("hidden");
      notifications_counter.innerHTML = data.new_notis;
    } else {
      notifications_counter.classList.add("hidden");
    }
    data.notifications.forEach(function (element) {
      var newElement = createElementFromHTML(element);
      newElement.addEventListener("click", function (ev) {
        return readNotification(newElement.getAttribute("data-id"));
      });
      newElement.querySelector(".notification-delete").addEventListener("click", function (ev) {
        ev.stopPropagation();
        deleteNotification(newElement.getAttribute("data-id"), newElement);
      });
      notifications_list.appendChild(newElement);
    });
    var refreshButton = createElementFromHTML('<img src=\'/icons/refresh.svg\') alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">');
    notifications_list.appendChild(refreshButton);
    refreshButton.addEventListener("click", function () {
      notificationsGetMoreData(notifications_list.childElementCount - 1);
      notifications_list.removeChild(refreshButton);
    });
  } else {
    notifications_counter.classList.add("hidden");
    document.querySelector("#left_panel_notifications_list").innerHTML = "No notifications to show";
  }

  // LINK REQUESTS

  var link_counter = document.querySelector("#left_panel_link_add_counter");
  var link_list = document.querySelector("#left_panel_links_add_list");
  link_list.innerHTML = "";
  if (data.link_requests.length > 0) {
    link_counter.classList.remove("hidden");
    link_counter.innerHTML = data.link_requests.length;
    data.link_requests.forEach(function (element) {
      var newElement = createElementFromHTML(element);
      newElement.querySelector(".link-request-accept").addEventListener("click", function (ev) {
        return acceptLinkRequest(newElement);
      });
      newElement.querySelector(".link-request-refuse").addEventListener("click", function (ev) {
        return declineLinkRequest(newElement);
      });
      link_list.appendChild(newElement);
    });
    var refreshButton = createElementFromHTML('<img src=\'/icons/refresh.svg\') alt="link icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">');
    link_list.appendChild(refreshButton);
    refreshButton.addEventListener("click", function () {
      linkRequestsGetMoreData(link_list.childElementCount - 1);
      link_list.removeChild(refreshButton);
    });
  } else {
    link_counter.classList.add("hidden");
    document.querySelector("#left_panel_links_add_list").innerHTML = "No link requests to show";
  }
}
function linkRequestsGetMoreDataHandler() {
  if (this.status != 200) {
    console.log("Action failed.");
    var _link_add_list = document.querySelector("#left_panel_links_add_list");
    var refreshButton = createElementFromHTML('<img src=\'/icons/refresh.svg\') alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">');
    _link_add_list.appendChild(refreshButton);
    refreshButton.addEventListener("click", function () {
      linkRequestsGetMoreData(_link_add_list.childElementCount - 1);
      _link_add_list.removeChild(refreshButton);
    });
    return;
  }
  var data = JSON.parse(this.responseText);
  var counter = document.querySelector("#left_panel_link_add_counter");
  var link_add_list = document.querySelector("#left_panel_links_add_list");
  link_add_list.innerHTML = "";
  if (data.link_requests.length > 0) {
    counter.innerHTML = data.link_requests.length;
    data.link_requests.forEach(function (element) {
      var newElement = createElementFromHTML(element);
      newElement.querySelector(".link-request-accept").addEventListener("click", function (ev) {
        return acceptLinkRequest(newElement);
      });
      newElement.querySelector(".link-request-refuse").addEventListener("click", function (ev) {
        return declineLinkRequest(newElement);
      });
      link_add_list.appendChild(newElement);
    });
    if (data.more_data) {
      var refreshButton = createElementFromHTML('<img src=\'/icons/refresh.svg\') alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer cursor-pointer">');
      link_add_list.appendChild(refreshButton);
      refreshButton.addEventListener("click", function () {
        linkRequestsGetMoreData(link_add_list.childElementCount - 1);
        link_add_list.removeChild(refreshButton);
      });
    }
  }
}
function notificationsGetMoreDataHandler() {
  if (this.status != 200) {
    console.log("Action failed.");
    var _notifications_list = document.querySelector("#left_panel_notifications_list");
    var refreshButton = createElementFromHTML('<img src=\'/icons/refresh.svg\') alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">');
    _notifications_list.appendChild(refreshButton);
    refreshButton.addEventListener("click", function () {
      notificationsGetMoreData(_notifications_list.childElementCount - 1);
      _notifications_list.removeChild(refreshButton);
    });
    return;
  }
  var data = JSON.parse(this.responseText);
  var counter = document.querySelector("#left_panel_notification_counter");
  var notifications_list = document.querySelector("#left_panel_notifications_list");
  notifications_list.innerHTML = "";
  if (data.notifications.length > 0) {
    counter.innerHTML = data.new_notis;
    data.notifications.forEach(function (element) {
      var newElement = createElementFromHTML(element);
      newElement.addEventListener("click", function (ev) {
        return readNotification(newElement.getAttribute("data-id"));
      });
      newElement.querySelector(".notification-delete").addEventListener("click", function (ev) {
        ev.stopPropagation();
        deleteNotification(newElement.getAttribute("data-id"), newElement);
      });
      notifications_list.appendChild(newElement);
    });
    if (data.more_data) {
      var refreshButton = createElementFromHTML('<img src=\'/icons/refresh.svg\') alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer cursor-pointer">');
      notifications_list.appendChild(refreshButton);
      refreshButton.addEventListener("click", function () {
        notificationsGetMoreData(notifications_list.childElementCount - 1);
        notifications_list.removeChild(refreshButton);
      });
    }
  }
}
function notificationReadHandler() {
  if (this.status != 200) {
    console.log("action failed");
    return;
  }
  var data = JSON.parse(this.responseText);
  window.location = data["url"];
}
function notificationDeleteHandler() {
  if (this.status != 200) {
    console.log("action failed");
    return;
  }
}
var readNotification = function readNotification(id) {
  sendAjaxRequest("post", "/api/notification", {
    id: id
  }, notificationReadHandler);
};
var deleteNotification = function deleteNotification(id, newElement) {
  sendAjaxRequest("delete", "/api/notification", {
    id: id
  }, notificationDeleteHandler);
  if (newElement.classList.contains("bg-blue-100")) {
    var counter = document.querySelector("#left_panel_notification_counter");
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
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + "=" + encodeURIComponent(data[k]);
  }).join("&");
}
function sendAjaxRequest(method, url, data, handler) {
  var request = new XMLHttpRequest();
  request.open(method, url, true);
  request.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.addEventListener("load", handler);
  request.send(encodeForAjax(data));
}

//EVENT LISTENERS

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
  }).join('&');
}
function sendAjaxRequest(method, url, data, handler) {
  var request = new XMLHttpRequest();
  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}
window.block = function (element) {
  if (element.value == "Block") {
    element.value = "Unblock";
    element.classList.remove('bg-red-400', 'hover:bg-red-700');
    element.classList.add('bg-green-400', 'hover:bg-green-700');
    element = element.parentNode;
    var id = element.id;
    sendAjaxRequest("POST", "/users/block", {
      id_user: id
    }, function (response) {
    });
  } else {
    element.value = "Block";
    element.classList.remove('bg-green-400', 'hover:bg-green-700');
    element.classList.add('bg-red-400', 'hover:bg-red-700');
    element = element.parentNode;
    var id = element.id;
    sendAjaxRequest("POST", "/users/unblock", {
      id_user: id
    }, function (response) {
    });
  }
};
function addEventListeners() {
  var editUserModalBack = document.querySelector("#editUserModalBack");
  var linkButton = document.querySelector("#link_button");
  var linkButtonAccept = document.querySelector("#link_button_accept");
  var linkButtonDecline = document.querySelector("#link_button_decline");
  var leftPanel = document.querySelector("#leftPanel");
  var leftPanelLinksButton = document.querySelector("#left_panel_link_button");
  var leftPanelLinksAddButton = document.querySelector("#left_panel_link_add_button");
  var leftPanelGroupsButton = document.querySelector("#left_panel_group_button");
  var leftPanelNotificationsButton = document.querySelector("#left_panel_notification_button");
  var leftPanelGroupsAddButton = document.querySelector("#left_panel_group_add_button");
  var commonLinkFilter = document.querySelector("#right-panel-common-link-filter");
  var linkFilter = document.querySelector("#linksfilter");
  var userProfileFriendLinks = document.querySelector("#userProfileFriendlinks");
  var userProfileLinks = document.querySelector("#userProfilelinks");
  if (editUserModalBack != null) editUserModalBack.addEventListener("click", function () {
    return closeProfileEditModal();
  });
  if (linkButton != null) {
    if (linkButton.getAttribute("data-method") == "edit") linkButton.addEventListener("click", function () {
      return openProfileEditModal();
    });else if (linkButton.getAttribute("data-method") == "link") linkButton.addEventListener("click", function (e) {
      return linkUser(e);
    });else if (linkButton.getAttribute("data-method") == "cancel") linkButton.addEventListener("click", function (e) {
      return cancelUserLink(e);
    });else if (linkButton.getAttribute("data-method") == "delete") linkButton.addEventListener("click", function (e) {
      return deleteUserLink(e);
    });
  }
  if (linkButtonAccept != null) linkButtonAccept.addEventListener("click", function (e) {
    return acceptLinkRequest(linkButtonAccept);
  });
  if (linkButtonDecline != null) linkButtonDecline.addEventListener("click", function (e) {
    return declineLinkRequest(linkButtonDecline);
  });
  if (leftPanel != null) leftPanelGetData();
  if (leftPanelLinksButton != null) leftPanelLinksButton.addEventListener("click", function (e) {
    return openLeftPanelTab(0);
  });
  if (leftPanelLinksAddButton != null) leftPanelLinksAddButton.addEventListener("click", function (e) {
    return openLeftPanelTab(1);
  });
  if (leftPanelGroupsButton != null) leftPanelGroupsButton.addEventListener("click", function (e) {
    return openLeftPanelTab(2);
  });
  if (leftPanelGroupsAddButton != null) leftPanelGroupsAddButton.addEventListener("click", function (e) {
    return openLeftPanelTab(3);
  });
  if (leftPanelNotificationsButton != null) leftPanelNotificationsButton.addEventListener("click", function (e) {
    return openLeftPanelTab(4);
  });
  if (commonLinkFilter != null && linkFilter != null) commonLinkFilter.addEventListener("click", function (e) {
    commonLinkFilter.classList.toggle("common-link-filter-selected");
    filterLinks(linkFilter, commonLinkFilter.classList.contains("common-link-filter-selected"));
  });
  if (linkFilter != null && document.querySelector("#right-panel-common-link-filter > p") != null) {
    linkFilter.addEventListener("keyup", function (ev) {
      filterLinks(ev.target, commonLinkFilter.classList.contains("common-link-filter-selected"));
    });
  }
  if (userProfileFriendLinks != null && linkFilter != null) {
    userProfileFriendLinks.addEventListener("click", function (ev) {
      if (commonLinkFilter != null) commonLinkFilter.classList.add("common-link-filter-selected");
      linkFilter.value = "";
      filterLinks(linkFilter, true);
    });
  }
  if (userProfileLinks != null && linkFilter != null) {
    userProfileLinks.addEventListener("click", function (ev) {
      if (commonLinkFilter != null) commonLinkFilter.classList.remove("common-link-filter-selected");
      linkFilter.value = "";
      filterLinks(linkFilter, false);
    });
  }
}
addEventListeners();

/***/ }),

/***/ "./resources/assets/css/app.css":
/*!**************************************!*\
  !*** ./resources/assets/css/app.css ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/assets/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/assets/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;