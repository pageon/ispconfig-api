# Wrapper for ispconfig

If you want to automate your account but don't have access to the usual remote endpoints you can use this library

## Dependencies

**Remark**: You should install our dependencies. The dependencies are handled by [composer](http://getcomposer.org/)

To install the dependencies, you can run the command below in the document-root:

	composer install -o

## Security

If you discover any security related issues, please email info@pageon.be instead of using the issue tracker.

## Bugs

If you encounter any bugs, please create an issue on [Github](https://github.com/pageon/ispconfig-api/issues).

## Running the tests

We use phpunit as a test framework. It's installed when using composer install.

Running the tests:

    ./vendor/bin/phpunit


In order to run the tests you will need to make sure the following environment vars are available
* **PAGEON_ISPCONFIG_TEST_ENDPOINT** (the url of ispconfig without the index.php on the end)
* **PAGEON_ISPCONFIG_TEST_USERNAME** (the username of your test account)
* **PAGEON_ISPCONFIG_TEST_PASSWORD** (the password of your test account)
