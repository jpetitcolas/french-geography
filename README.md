# French geography

This repository provides a full list of regions, departments and cities in France, in various formats.

If you just need to grab data exports, simply browse [data folder](https://github.com/jpetitcolas/french-geography/tree/master/data).
It currently supports *YAML* and *SQL* formats.

## How to generate data exports?

First, you need to install all dependencies:

``` sh
composer install
```

Then, in order to re-generate all the data from the latest yearly official data, just use:

``` sh
make generate
```

## License

This project is released under [MIT licence](http://opensource.org/licenses/MIT).
