let mysql = require('mysql');
let config = require('./config.js');

let connection = mysql.createConnection(config);

// update statment
let sql = `UPDATE projects
           SET penarafan = ?
           WHERE id = ?`;

let data = [false, 1];

// execute the UPDATE statement
connection.query(sql, data, (error, results, fields) => {
  if (error){
    return console.error(error.message);
  }
  console.log('Rows affected:', results.affectedRows);
});

connection.end();