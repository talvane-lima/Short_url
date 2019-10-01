# Short_url
An API RESTful to shorten url.

## Install and run
#### Dependencies

  - [Docker](https://www.docker.com/)
  - [Docker-compose](https://docs.docker.com/compose/)

#### Installation

```sh
$ sudo apt-get update
$ sudo apt-get install docker.io
$ sudo systemctl start docker
```

Testing installation...

```sh
$ sudo docker --version
$ Docker version 18.09.5, build e8ff056
```

Docker-compose
```sh
$ sudo curl -L "https://github.com/docker/compose/releases/download/1.24.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
$ sudo chmod +x /usr/local/bin/docker-compose
$ sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose

```

#### Running
```sh
$ git clone https://github.com/talvane-lima/Short_url.git
$ cd Short_url
```
Starting the server...

```sh
$ sudo docker-compose -f run.yml up
```
Verify the deployment by navigating to your server address in your preferred browser.

```sh
http://localhost:81/info.php
```

#### How to use

On browser, request http://localhost:81/mmore_api.php?user_id='[0-9A-Z]'&url='http[s]*://url'.

user_id = Your use ID (default is NULL)
url = Your original or tiny URL (default is NULL)

##### Examples:
###### Insert a new URL

http://localhost:81/mmore_api.php?user_id=mm001&url=http://www.google.com

###### Get all URLs of the user

http://localhost:81/mmore_api.php?user_id=mm001

###### Get original URL

http://localhost:81/mmore_api.php?url=https://mmore/cfce12ba

[![IMAGE ALT TEXT HERE](https://img.youtube.com/vi/sxFABvpFVAg/0.jpg)](https://www.youtube.com/watch?v=sxFABvpFVAg)

### Todos

 - Write MORE Tests
 