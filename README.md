# Device Tracker

## Table of Contents

- [Background and Problem Statement](#background-and-problem-statement)
- [Proposed Solution](#proposed-solution)
- [Access Levels](#access-levels)
- [Installation](#installation)
- [System Requirements](#system-requirements)

## Background and Problem Statement

In the company, there is a shared pool of devices (smartphones, tablets) that employees (developers, testers, project managers) periodically borrow for work-related tasks, both within the office and for remote use at home. These devices are often "lost," and those in need of them must inquire in various work-related chats/offices to find out who had the required device last.

## Proposed Solution

The proposed solution is to provide all interested employees with a centralized web interface to track the status (available/occupied/inactive, e.g., if the device is under repair and in service), location, and (if the device is occupied) the current user of any shared device. Users should be able to take an available device on rent and, if necessary, return the device to the shared pool or transfer responsibility for a previously rented device to another user.

## Access Levels

### Employee

- View the list of devices.
- View device details.
- Ability to rent an available device.
- Ability to "return" a previously rented device.

### Administrator

- Create, Read, Update, Delete (CRUD) users.
- CRUD devices.
- Change the status of inactive devices.
- Access all functionalities available to employees.

## Installation

1. Run `composer install`.
2. Run `npm install && npm run dev`.
3. Execute `php artisan storage:link`.
4. Set up the environment in the `.env` file.
5. Run `php artisan migrate --seed`.

## System requirements

1. PHP:
- Version: 8.1 or higher
- Required PHP Extensions:
  - intl
  - opcache
  - pdo_mysql
  - gd
  - bcmath
  - zip
  - soap
  - sockets
  - exif
2. MySQL:
- Version: 8.0
3. Nginx:
- Version: 1.23.1
4. Node.js and npm:
- Node.js Version: 18.17.1
- npm Version: 10.2.1
