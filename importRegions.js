var fs = require('fs');
var async = require('async');

async.waterfall([

    // Reading file
    function(next) {
        fs.readFile("sources/reg2012.txt", "binary", next);
    },

    // Parsing CSV
    function(fileContent, next) {

        var parsedRegions = [];
        var regions = fileContent.split("\r\n");

        for(var i = 0 ; i < regions.length ; i++) {

            // Skip headers and empty lines
            if(i == 0 || !regions[i]) {
                continue;
            }

            // Extract main informations
            var parts = regions[i].split("\t");
            parsedRegions.push({
                id: parts[0],
                capital_zip_code: parts[1],
                name: parts[4]
            });

        }
        next(null, parsedRegions);
    },

    // Converting into SQL
    function(regions, next) {

        var sql = 'CREATE TABLE IF NOT EXISTS `region` (\r\n' +
            '  `id` tinyint(3) unsigned NOT NULL auto_increment,\r\n' +
            '  `name` varchar(255) NOT NULL,\r\n' +
            '  PRIMARY KEY  (`id`),\r\n' +
            '  UNIQUE KEY `name` (`name`)\r\n' +
            ') ENGINE=InnoDB  DEFAULT CHARSET=utf-8;\r\n\r\n';

        sql += 'INSERT INTO french_geography_regions (id, name) VALUES\r\n';
        var values = [];
        regions.forEach(function(region) {
           values.push('  (' + region.id + ', "' + region.name + '")');
        });
        sql += values.join(',\r\n') + ";\r\n";
        next(null, sql);
    },

    // Writing it in output file
    function(sql, next) {
        fs.writeFile("sql/00-regions.sql", sql, function() {
            console.log("SQL file written in sql/00-regions.sql.");
        })
    }

]);