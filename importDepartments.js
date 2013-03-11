var fs = require('fs');
var async = require('async');

async.waterfall([

    // Reading file
    function(next) {
        fs.readFile("sources/depts2012.txt", "binary", next);
    },

    // Parsing CSV
    function(fileContent, next) {

        var parsedDepartments = [];
        var departments = fileContent.split("\r\n");

        for(var i = 0 ; i < departments.length ; i++) {

            // Skip headers and empty lines
            if(i == 0 || !departments[i]) {
                continue;
            }

            // Extract main informations
            var parts = departments[i].split("\t");
            parsedDepartments.push({
                region_id: parts[0],
                code: parts[1],
                capital_zip_code: parts[2],
                name: parts[5]
            });

        }
        next(null, parsedDepartments);
    },

    // Converting into SQL
    function(departments, next) {

        var sql = 'CREATE TABLE IF NOT EXISTS `department` (\r\n' +
            '  `id` tinyint(3) unsigned NOT NULL auto_increment,\r\n' +
            '  `code` varchar(3) NOT NULL,\r\n' +
            '  `region_id` tinyint(3) unsigned NOT NULL,\r\n' +
            '  `name` varchar(255) NOT NULL,\r\n' +
            '  PRIMARY KEY  (`id`),\r\n' +
            '  UNIQUE KEY `name` (`name`)\r\n' +
            ') ENGINE=InnoDB  DEFAULT CHARSET=utf8;\r\n\r\n';

        sql += 'INSERT INTO department (id, code, region_id, name) VALUES\r\n';
        var values = [];
        departments.forEach(function(department) {
           values.push('  (NULL, "' + department.code + '", ' + department.region_id + ', "' + department.name + '")');
        });
        sql += values.join(',\r\n') + ";\r\n";
        next(null, sql);
    },

    // Writing it in output file
    function(sql, next) {
        fs.writeFile("sql/10-departments.sql", sql, function() {
            console.log("SQL file written in sql/10-departments.sql.");
        })
    }

]);