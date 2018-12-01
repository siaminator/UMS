# UMS - User Management System
Symfony simple User Management System

This is just a test for myself developing a simple UMS on Symfony 4 + adding some APIs

Below are the Some UML Models of the project:

### A simple Domain Model

![Screenshot](./images/Simple%20Domain%20Model.jpg)

### An Extended Domain Model

![Screenshot](./images/Extended%20Domain%20Model.jpg)
This domain is just an extension to the main model which adds illustrations for following defined stories:
- As an admin I can add users — a user has a name.
- As an admin I can delete users.
- As an admin I can assign users to a group they aren’t already part of.
- As an admin I can remove users from a group.
- As an admin I can create groups.
- As an admin I can delete groups when they no longer have members.

### And Finally the Data Model

![Screenshot](./images/Data%20Model.jpg)


### APIs:
##### Add user:
POST /api/ums/users HTTP/1.1  
Content-Type: application/json  
Authorization: Basic YWRtaW46cGFzc3dvcmQ=  
body:  
{
  "name": string
}
##### Delete user:
DELETE /api/ums/users/{userId} HTTP/1.1  
Content-Type: application/json  
Authorization: Basic YWRtaW46cGFzc3dvcmQ=  
body:  
{
  
}
##### Add user:
POST /api/ums/groups HTTP/1.1  
Content-Type: application/json  
Authorization: Basic YWRtaW46cGFzc3dvcmQ=  
body:  
{
  
}
##### Delete user:
DELETE /api/ums/groups/{groupId} HTTP/1.1  
Content-Type: application/json  
Authorization: Basic YWRtaW46cGFzc3dvcmQ=  
body:  
{
  
}
##### Assign user (member) to group :
POST /api/ums/groups/{groupId}/users HTTP/1.1  
Content-Type: application/json  
Authorization: Basic YWRtaW46cGFzc3dvcmQ=  
body:  
{
  "userId": int
}
##### Remove user (member) from group :
DELETE /api/ums/groups/{groupId}/users/{userId} HTTP/1.1  
Content-Type: application/json  
Authorization: Basic YWRtaW46cGFzc3dvcmQ=  
body:  
{
  
}
#### Notes:
- No tests available since not being part of the requirements
- The UMS has been implemented in a modular file structure (not a bundle) as a Symfony experiment
- Authorization and Authentication are handled through hard coded username & password in security.yaml (http_basic):
ADMIN: username=>admin password=>admin_pass (password is set in .env)
USER: username=>admin password=>admin_pass (password is set in .env)
so that if you use the user you would not be authorized to use APIs ()

