/*jshint esversion: 6 */
(function(){
  "use strict";
  const async     = require('async');
  const camelCase = require('camelcase');
  const fs        = require('fs');
  const path      = require('path');
  const prompt    = require('prompt');
  const spawn     = require('child_process').spawn;

  module.exports  = class Streamify {
    constructor(appTitle, appDir, scopeFile)
    {
      this.separator  = '/';
      this.installDir = appDir || path.resolve(process.cwd(), '../') + this.separator;
      let length = this.installDir.length;
      if(this.installDir.charAt(length-1)!==this.separator) this.installDir+this.separator;

      this.scope      = require(scopeFile||'./scope.json');
      if(appTitle)
      {
        this.appTitle = appTitle;
        this.appName  = camelCase(appTitle);
      }
      this.appStart   = (new Date()).getTime();
      this.run       = {};
    }

    createApp(skipIfName)
    {
      if (this.appName!==null && this.installDir!==null)
      {
        if(this.installDir.indexOf(this.appName) === -1) this.installDir += this.appName+this.separator;
        return Promise.resolve(this.installDir);
      } else {
        return this.promptApp();
      }
    }

    complete(err, data)
    {
      return new Promise(promise);

      function promise(resolve, reject)
      {
        if(err)
        {
          console.error("Error:", err);
          return reject(err);
        }
        return resolve(data);
      }
    }

    done(err)
    {
      let name = (typeof this ==='string')? this: null;
      if(err) console.error(this.error || `Error in processing ${name}`, err);
      else console.log(this.success || `Successful process ${name}`);
    }

    elapse(text, until)
    {
      this.appStart = this.appStart || (new Date()).getTime();
      this.appFrom  = (until===true)? (new Date()).getTime(): (this.appFrom)? this.appFrom: (new Date()).getTime();
      let now       = (new Date()).getTime();
      console.log(`TimeStamp ${text}: start@${now-this.appStart} from@${now-this.appFrom}`);
    }

    error(err)
    {
      console.log('Promise error:', err);
    }

    exit(err, object)
    {
      object = object || '';
      console.log((typeof err === 'string')? err: "Process exit");
      if(object instanceof Function) object("Process exited");
      else console.log("Object Error:",object);
      err = typeof err === 'number'? err: 0;
      process.exit(err);
      return false;
    }

    fileDataChange(data, items, success)
    {
      return Streamify.fileDataChanges(data, items, success);
    }

    static fileDataChanges(data, items, success)
    {
      let file = (typeof success === "string")? success: "";

      return new Promise(promise);
      function promise(resolve, reject)
      {
        async.map(items, iterator, done);
        function iterator(ele, callback)
        {
          if(ele.leave && typeof ele.replace === "string") ele.replace += `\n\r${ele.search}`;// leave the search in content
          if(ele.searchIfNot)
          {//if this element is not found then replace
            if(data.search(ele.searchIfNot)===-1)
            {
              data  = data.replace(ele.search, ele.replace);
            } else {
              console.log('Replacement already exist.');
            }
          } else {
            data  = data.replace(ele.search, ele.replace);
          }//if ele.searchIfNot
          callback(null, ele);
        }

        function done(err, items)
        {
          if(err)
          {
            reject(err);
            console.error("Error:", err);
            return;
          }
          resolve(data);
          console.log(`Successful Files search and replace items ${file}`);
          if(success instanceof Function) return success(data);
        }
      }
    }

    /**
     * Iterates each file elements for search and replace
     * @param file: contains iterable file.items elements
     * @param object
     */
    fileContentChangeWrite(file, asyncFuncOrObject)
    {
      let self = this;
      let content;
      this.fileContentGet(file.path).then((data)=>
      {
        this.fileDataChange(data, file.items, file.path).then(success, self.error);
      });

      function success(data)
      {
        content = data;
        fs.writeFile(file.path, data, 'utf8', done);
      }//func done
      function done(err, results)
      {
        if(err && asyncFuncOrObject instanceof Function) return asyncFuncOrObject(err);//callback from async.map
        if(asyncFuncOrObject instanceof Function) asyncFuncOrObject(null, content);//callback from async.map
        self.done.bind(`Replace & Writing ${file.path}`)
      }
    }

    fileContentGet(path, encode)
    {
      return Streamify.fileContentGets(path, encode);
    }

    static fileContentGets(path, encode)
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
          console.log(`read file ${path}`);
          resolve(data);
        }
      }
    }

    jsonToFile(object, path)
    {
      let json = JSON.stringify(object);
      path  = path||'varDump.json';
      path  = `logs/${path}`;
      fs.writeFile(path, json, 'utf8', this.done.bind(`dump file ${path}`));
    }

    promptApp()
    {
      const self = this;
      let schemaName = {
        properties: {
          appTitle: {
            description: `What is the name of the application?`,
            required: true,
            message: 'The application name must be alpha numeric',
            pattern: /^[a-z0-9\s\-]+$/i,
            type: 'string'
          }
        }
      };

      return new Promise(promise);

      function promise(resolve, reject)
      {
        prompt.start();
        prompt.get(schemaName, setAppName);

        function setAppName(err, result)
        {
          if (err) return self.exit(1,reject);

          self.appTitle   = result.appTitle;
          self.appName    = camelCase(self.appTitle);
          self.installDir+= self.appName+self.separator;
          let schemaDir   = {
            properties: {
              answer: {
                description: `The installation path is ${self.installDir}, if correct [y=Yes or Type the directory path]?`,
                required: true,
                type: 'string'
              }
            }
          };
          console.log(`Your application title is ${self.appTitle}`);
          prompt.get(schemaDir, setAppDir);
        }

        function setAppDir(err, result)
        {
          if (err) return self.exit(1,reject);//@TODO: add validation of directory entered

          self.installDir = (['y','Y','Yes','yes'].indexOf(result.answer.trim())!==-1)? self.installDir: result.answer;
          let length = self.installDir.length;
          if(self.installDir.charAt(length-1)!==this.separator) self.installDir += this.separator;
          resolve(self.installDir);
        }
      }
    }

    runMethod(run, limit)
    {
      let all = {install:false, copy:false, shell:false, replace:false, mysql:false, migration:false};
      let not = {install:true, copy:true, shell:true, replace:true, mysql:true, migration:true};
      run = run===true? all: (run)? run: not;
      this.run = run;
      if(limit) this.limitTo = limit;
    }

    shellExec(command, arrOption)
    {
      return Streamify.shellExecs(command, arrOption);
    }

    static shellExecs(command, arrOption)
    {
      console.log(`Running command ${command}: ${arrOption}`);
      return new Promise(promise);

      function promise(resolve, reject)
      {
        let shell = spawn(command, arrOption);
        // let shell = spawn('ls', ['-lh']);

        shell.stdout.on('data', (data)=>console.log(`Standard Output: ${data}`));
        shell.stderr.on('data', (data)=>console.info(`Standard Error Output: ${data}`));
        shell.on('exit', done);
        function done(code)
        {
          if(code===0)
          {
            console.log(`Process done with code: ${code}`);
            resolve(code);
          } else{
            console.log(`Process done with ERROR code: ${code}`);
            reject(code);
          }

          // shell.stdin.end();
          if(shell) shell.kill();//'SIGHUP'
          return;
        }

      }
    }

    stdExit(code)
    {
      console.log(`StandardChild process exited with code: ${code}`);
    }

    strUpFirstLetter(string) {
      return Streamify.strUpFirstLetters(string);
    }

    static strUpFirstLetters(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }

  };

})();
