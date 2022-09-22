# Web_Application
As part of the ZWA (web application foundations or zaklady webovych aplikaci) subject, a dynamic website was created where users can register, log in, publish articles on the site, each article can only be commented by a registered user. All fields are protected from sql injection or XSS scripting. There were three sql tables where the data was stored. 

1) User data - login and password were stored in sql table (passwords were hashed and salted)
2) Data with published articles
3) Data with comments for each article
