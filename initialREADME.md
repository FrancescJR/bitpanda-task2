## PHP Technical test

### 2.

Create a new Laravel project using composer

Attached you will find a DB dump and a .csv file.

Create a DB connection in laravel using the .env file.

Seed the DB based on the dump

In the resulted DB you will have these 1 table: `transactions`.
```
* transactions: id, code, amount, user_id, created_at, updated_at
```

You have two sources. One DB and one is the .csv file

Write two services(classes) that implement an interface which will allow you to retrieve the data.

1. Create an endpoint which will return the transactions in a json with an extra parameter which will specify the source

endpoints:
* .../transactions?source=db
* .../transactions?source=csv

Some ideas:
- you can create a factory to determine the class handler
- you can also validate the source value and if the value is unknown throw an exception (eg: /transactions?source=html)
