# Ignite Forum: Ignite a conversation [![Build Status](https://travis-ci.com/Thavarshan/ignite.svg?branch=master)](https://travis-ci.com/Thavarshan/ignite)

A plateform to get people into the conversation. This is an open source forum application built using Laravel, by **Thavarshan**.

## Installation

### Prerequisites

* To run this project, you must have PHP 7.2 or higher installed.
* You should setup a host on your web server for your local domain. For this you could also configure Laravel Homestead or Valet. 
* If you want use Redis as your cache driver you need to install the Redis Server. You can either use homebrew on a Mac or compile from source (https://redis.io/topics/quickstart). 

### Step 1

Begin by cloning this repository to your machine, and installing all Composer & NPM dependencies.

```bash
git clone https://github.com/Thavarshan/ignite
cd ignite && composer install && npm install
php artisan ignite:install
npm run dev
```

### Step 2

Next, boot up a server and visit your forum. If using a tool like Laravel Valet, of course the URL will default to `http://ignite.test`. 

1. Visit: `http://ignite.test/register` to register a new forum account.
2. Edit `config/ignite.php`, and add any email address that should be marked as an administrator.
3. Visit: `http://ignite.test/admin/channels` to seed your forum with one or more channels.
