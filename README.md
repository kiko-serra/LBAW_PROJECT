# lbaw2222

# ER: Requirements Specification Component

> Project vision.

## A1: Project Name

The (_PROJECT_NAME) is a project developed by a group of college students as a product targeted at college students as a way of helping them integrate easier.

The main goal of the project is the development of a web-based social network for enabling students to interact with each other in an academic context. This is a tool that can be used by students and other members of the academic environment. A team of administrators is defined, which will be responsible for managing complaints and reports.

Users are able to be verified (through a whitelist of emails associated with universities) as students, associating them with their university/faculty, altough this is not mandatory, verification allows users identify people from their university. Groups can be created and managed by the users with in-group administators being able to enforce their own rules. The users will also be able to add/remove friends and create post (being able to delete them after too), those posts will appear to their friends through their timeline which can be customized by their owner, furthermore who ever sees a post can comment it and react to it. An essential part of the social network is privacy and thus users can make their profile public or private, being shown only to their friends.

The social network will have an adaptive design so that users can access it through their computer, phone or tablet and have no problems associated with it. The user interface will also be simple and as easier to navigate as possible so that the user can go straight to the point.


---


## A2: Actors and User stories

This artifact contains the specification of the actors and their user stories, serving as agile documentation of the project’s requirements.



### 1. Actors

<br>

<p align="center" justify="center">
  <img src="img/A2.png"/>
</p>
<p align="center">
  <b> Figure 1: Actors. </b>  
</p>  

| **Identifier**  |  **Description** |
|---|---|
|User|Generic user that has access to public information, such as public profiles and groups. |
|Un-authenticated User|	Unauthenticated user that can register itself (sign-up) or sign-in in the social network. |
|Authenticated User| User that has access to public information aswell as its own and its friends, can create and delete its own posts, create, leave and interact with groups, react and comment posts (aswell as delete its own comments), manage friends and manage friend requests. |
|Group Administrator| User that can manage a group, deleting posts and comments, inviting other users and accepting group access requests. |
|Verified User| User that has its account verified and therefore will be easier to identify as a student. |
|Unverified User| User that does not have its account verified, cannot be identified as a student. |
|Administrator| Can manage posts, delete/block users and receive reports and complaints. |
<p align="center">
  <b> Table 1: Actors description. </b>  
</p>  

### 2. User Stories

For the (_PROJECT_NAME) sozial network, consider the user stories that are presented in the following sections.

#### 2.1. Un-authenticated User

| **Identifier** | **Name** | **Priority** | **Description** |
|---|---|---|---|
| US001 | Sign-In | High | As an _Un-autheticated User_ I want to be able to authenticate into the social network so that I can have access to privileged information. |
| US002 | Sign-Up | High | As an _Un-autheticated User_ I want to be able to register myself into the social network so that I can authenticate and have access to privileged information. |
| US003 | Recover Password | High | As an _Un-autheticated User_ I want to be able to recover my password. |

<p align="center">
  <b> Table 2: <i> Un-authenticated User </i> user stories. </b>  
</p>  



#### 2.2. User

| **Identifier** | **Name** | **Priority** | **Description** |
|---|---|---|---|
| US101 | See Home | High | As a _User_, I want to access the Home page, so that I can see a brief presentation of the website. |
| US102 | See About Us | High | As a _User_, I want to access the About Us page, so that I can get more information about the website and its creators. |
| US103 | See Contacts | High | As a _User_, I want to access contacts, so that I can come in touch with the website creators. |
| US104 | Search | High | As a _User_, I want to be able to search through the social network's keywords so that I can find public posts. |
| US105 | View Profile | High | As a _User_, I want to be able to see a public profile. |
| US106 | See Specific Post | Low | As an _User_ I want to be able to see a specific public post. |

<p align="center">
  <b> Table 3: <i> User </i> user stories. </b>  
</p>  

#### 2.3. Authenticated User
| **Identifier** | **Name** | **Priority** | **Description** |
|---|---|---|---|
| US201 | See Timeline | High | As an _Autheticated User_ I want to be able to see my timeline, consisting of posts from my friends and the groups I belong to, aswell as deciding its order. |
| US202 | Send Friend Requests | High | As an _Autheticated User_ I want to be able to send friend requests in order to add a friend to my friends list. |
| US203 | Remove Friends | High | As an _Autheticated User_ I want to be able to remove friends from my friends list. |
| US204 | Accept Friend Requests | High | As an _Autheticated User_ I want to be able to accept a friend request. |
| US205 | Decline Friend Requests | High | As an _Autheticated User_ I want to be able to decline a friend request. |
| US206 | Create a Post | High | As an _Autheticated User_ I want to be able to create a post. |
| US207 | Edit a Post | High | As an _Autheticated User_ I want to be able to edit my own post. |
| US208 | Delete a Post | High | As an _Autheticated User_ I want to be able to delete my own post. |
| US209 | Tag Friend a Post | Low | As an _Autheticated User_ I want to be able to tag a friend on my own post. |
| US210 | Manage a Post's Visibility | Low | As an _Autheticated User_ I want to be able to manage my own post's visibility. |
| US211 | Comment on a Post | Medium | As an _Autheticated User_ I want to be able to comment on a post. |
| US212 | Edit a Comment on a Post | Medium | As an _Autheticated User_ I want to be able to edit my own comment on a post. |
| US213 | Delete a Comment on a Post | Medium | As an _Autheticated User_ I want to be able to delete my own comment on a post. |
| US214 | Tag a Friend on a Comment | Low | As an _Autheticated User_ I want to be able tag a friend on a comment. |
| US215 | Create a Group | Medium | As an _Authenticated User_ I want to be able to create my own group. |
| US216 | Invite to a Group | Medium | As an _Authenticated User_ I want to be able to invite friends to a group, if given permission by an administrator. |
| US217 | Accept a Group Invite | Medium | As an _Authenticated User_ I want to be able to accept a group invite. |
| US218 | Request to Join a Public Group | Medium | As an _Authenticated User_ I want to be able to request to join a public group. |
| US219 | Create a Post on a Group | Medium | As an _Authenticated User_ I want to be able to create a post on a group, if given permission by an administrator. |
| US220 | Leave a Group | Medium | As an _Authenticated User_ I want to be able to leave a group I belong. |
| US221 | React to a Post | Medium | As an _Authenticated User_ I want to be able to react to a post. |
| US222 | React to a Comment | Medium | As an _Authenticated User_ I want to be able to react to a comment. |
| US223 | Check my Notification | High | As an _Authenticated User_ I want to be able check my notifications. |
| US224 | Delete My Account | High | As an _Authenticated User_ I want to be able to delete my account. |
| US225 | Log Out | High | As an _Authenticated User_ I want to be able to log out. |

<p align="center">
  <b> Table 4: <i> Autheticated User </i> user stories. </b>  
</p>  

#### 2.3. Group Administrator

| **Identifier** | **Name** | **Priority** | **Description** |
|---|---|---|---|
| US301 | Edit Group Information | High | As a _Group Administrator_, I want to be able to edit the group's information. |
| US302 | Manage Member Permissions | Medium | As a _Group Administrator_, I want to be able to manage who can post, invite, etc... |
| US303 | Remove Member | High | As a _Group Administrator_, I want to be able to remove a member from the group. |
| US304 | Add to Group | High | As a _Group Administrator_, I want to be able to ???? WHAT DOES THIS MEAN?. |
| US305 | Remove Post from Group | Low | As a _Group Administrator_, I want to be able to remove a post from the group. |
| US306 | Change Group Visibility | Low | As a _Group Administrator_, I want to be able to change the group visibility. |
| US306 | Manage Join Requests | Low | As a _Group Administrator_, I want to be able to manage the group join requests (accept/decline). |
| US307 | Add Group Administrators | Low | As a _Group Administrator_, I want to be able to make a member a group administrator. |

<p align="center">
  <b> Table 4: <i> Group Administrator </i> user stories. </b>  
</p>  

#### 2.3. Administrator

| **Identifier** | **Name** | **Priority** | **Description** |
|---|---|---|---|
| US401 | Find User Account | High | As a _Administrator_, I want to be able to find an user's account. |
| US402 | View User Account | High | As a _Administrator_, I want to be able to view an user's account. |
| US402 | Edit User Account | High | As a _Administrator_, I want to be able to edit an user's account. |
| US403 | Create User Account | High | As a _Administrator_, I want to be able to create an user account. |
| US404 | Block and Unblock User Accounts | High | As a _Administrator_, I want to be able to block and unblock an user account. |
| US405 | Delete User Account | High | As a _Administrator_, I want to be able to delete an user account. |

<p align="center">
  <b> Table 5: <i> Administrator </i> user stories. </b>  
</p>  

//FAQ? Services? Numeração??

### 3. Supplementary Requirements

> Section including business rules, technical requirements, and restrictions.  
> For each subsection, a table containing identifiers, names, and descriptions for each requirement.

#### 3.1. Business rules

#### 3.2. Technical requirements

#### 3.3. Restrictions


---


## A3: Information Architecture

> Brief presentation of the artefact goals.


### 1. Sitemap

> Sitemap presenting the overall structure of the web application.  
> Each page must be identified in the sitemap.  
> Multiple instances of the same page (e.g. student profile in SIGARRA) are presented as page stacks.


### 2. Wireframes

> Wireframes for, at least, two main pages of the web application.
> Do not include trivial use cases.


#### UIxx: Page Name

#### UIxx: Page Name


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ...

***
GROUP21gg, DD/MM/2021

* André Ismael Ferraz Ávila, up202006767@edu.fe.up.pt
* Group member 2 name, email
* ...