#French geography

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a633701d-c418-43b6-ab56-fa010f95ee47/big.png)](https://insight.sensiolabs.com/projects/a633701d-c418-43b6-ab56-fa010f95ee47)

This repository provides a full list of regions, departments and especially cities of France in several formats.

If you just want to grab data exports, simply browse the [data folder](https://github.com/jpetitcolas/french-geography/tree/master/data). It currently supports *YAML* and *SQL* formats.

##How to generate data exports?
Else, if you want to generate data with the latest records, feel free to do so using the following command:

````bash
app/console french-geography:generate type format sourceFormat source output
````

Where:

* **type:** is the kind of entity you want to export. Correct values: [region|department|city].
* **format:** in which format you want to export. Currently supports only SQL and YAML. Correct values: [sql|yaml]
* **sourceFormat:** helps to determine entity mapping by indicating the source of your input files. Supports only `insee` value for the moment.
* **source:** filepath of your source file.
* **output:** filepath of your output file
