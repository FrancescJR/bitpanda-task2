## PHP Technical test

you might find this solution less shocking.

## Requirements

Docker and Composer PHP

## Installation

Do:

```shell
cp .env.example .env
$composer install
vendor/bin/sail up
```

Seed the DB like this:

```shell
docker exec -ti bitpanda-task2 bash
mysql -u root -h mysql laravel < transactions.sql 

```


## Usage

`http://localhost/api/v1/transactions?source=[db|csv]`

to see the results

### Directory Structure

Similar to task 1, but this one I am respecting laravel skeleton and just building inside.

I left all the stuff that Laravel gives and that it is not going to be used at all. I just lost
the energy for doing things right.

I am building though my development code in "src" like before, still trying to be independent
of the framework.

### comments

You will see some comment in the controller, where there is some interesting logic. Instead of using
a factory pattern I used something that looks like more a strategy pattern, but well, after all
it's also a factory.
