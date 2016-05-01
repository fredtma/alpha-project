/* jshint esversion: 6 */
/* jshint esnext: true */
(function(){
  "use strict";
  const mysql = require('mysql');
  const fs    = require('fs');

  module.exports = class Mysql
  {
    constructor(config)
    {
      this.db  = mysql.createConnection(config);
      this.connect();
    }

    connect()
    {
      let self = this;
      self.db.connect(connection);

      function connection(err)
      {
        if(err)
        {
          console.log("Failed to connect to the DB ", err);
          return false;
        }
        console.log(`Connection established @ThreadID ${self.db.threadId}`);
      }//func
    }

    end()
    {
      this.db.end((err)=>{
        console.log("Connection has terminated gracefully");
      });
    }//func

    executeFile(path)
    {
      let self = this;
      return new Promise(promise);
      function promise(resolve, rejected)
      {
        self.fileContentGet(path).then((sql)=>{
          self.query(sql).then(resolve, rejected);
        });
      }
    }


    fileContentGet(path, encode)
    {
      return new Promise(promise);
      function promise(resolve, reject)
      {
        fs.readFile(path, encode||'utf8', done);
        function done(err, data)
        {
          if(err)
          {
            console.error(`Error reading file ${path}`, err);
            reject(err);
            return;
          }
          resolve(data);
        }//func
      }//promise
    }

    query(sql, params)
    {
      let msg;
      let self  = this;
      params    = params || [];
      return new Promise(promise);

      function promise(resolve, reject)
      {
        self.db.query(sql, params, queryResult);
        function queryResult(err, rows, fields)
        {
          if(err)
          {
            console.log(`Error in executing query ${sql}`, err);
            reject(err);
            return;
          }
          msg = sql.length>100? 'query file': sql;
          console.log(`Successful query: ${sql}`);
          resolve({rows, fields});
        }
      }
    }
  };

})();
