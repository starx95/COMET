var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "comet"
});

con.connect(function(err) {
  if (err) throw err;
  con.query("SELECT email, tahap FROM users", function (err, result, fields) {
    if (err) throw err;
    console.log(result.tahap);
 });
});