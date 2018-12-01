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

#### Notes:
- No tests available since not being part of the requirements
- The UMS has been implemented in a modular file structure (not a bundle) as a Symfony experiment 