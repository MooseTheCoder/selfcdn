#SelfCDN

##### What is SelfCDN?

SelfCDN is a simple, light, esy to use, community based, community managed CDN for holding code.

TO get started, decide if you want to run a SelfCDN "relay" or want to run a SelfCDN "client".

A client acts like a static file server, it serves files on requests, simple. 

A relay acts like http://selfcdn.org/ it decides where to send users and also serves files.

##### Setup Guide

To get started with SelfCDN as a client, clone this repo and add your server to the "servers" json array.


Say the file looks like this :

`{"GB":["http:\/\/selfcdn.org\/client\/"]}`

Add your server to the correct region like this : 

`{"GB":["http:\/\/selfcdn.org\/client\/","http:\/\/yourserver.com\/"]}`
`{"GB":["http:\/\/selfcdn.org\/client\/"],"US":["http:\/\/yourserver.com\/"]}`

Point your server config to the /client/ (/var/www/selfcdn/client/ in my case).

Branch off and make a merge request, if your server works, I'll merge it in and your server will be live. 

Contact me if you want to remove your server from the list. 

##### Roadmap
- Relay Search
- Clients List
- Auto Add to servers list
- Remove from servers list
- Check server status before redirect