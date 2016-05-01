/* jshint esversion: 6 */
(function(){
  "use strict";
  const _         = require('lodash');
  const async     = require('async');
  const fs        = require('fs');
  const ncp       = require('ncp').ncp;
  const pluralize = require('pluralize');
  const rimraf    = require('rimraf');


  const Migration = require('./class.Migration');
  const Mysql     = require('./connect.mysql');
  const Streamify = require('./class.Streamify');

  module.exports  = class Laravel extends Streamify
  {
    constructor(appTitle, appDir, scopeFile)
    {
      super(appTitle, appDir, scopeFile);
      this.options  = {resources:'lib/resources/Laravel/'};
    }

    createDirectory(dir)
    {
      let self  = this;
      dir       = dir || this.installDir;
      return new Promise(promise);
      function promise(resolve, reject)
      {
        fs.access(dir, fs.F_OK | fs.W_OK, canReadInstallDir);
        function canReadInstallDir(err)
        {
          if(err && err.errno === -2) {
            fs.mkdir(dir, creatingInstallDir);
          } else if(err) {
            reject(err);
          } else {
            console.log(`Directory exists ${dir}`);
            resolve('exists');
          }
        }//end func

        function creatingInstallDir(err)
        {
          if(err)
          {
            reject(err);
            self.exit("Failed to create installation directory", err);
          }
          console.log(`Created directory ${dir}`);
          resolve('new');
        }//func
      }//func promise
    }

    createView(call)
    {
      call          = (typeof call ==='string')? {name:pluralize.singular(call), names:pluralize.plural(call), Name: this.strUpFirstLetter(pluralize.singular(call)), Names: this.strUpFirstLetter(pluralize.plural(call)) }: call;
      let self      = this;
      let container = [];
      let dir       = `${this.installDir}resources/views/${call.name}/`;
      let finalCall;

      this.createDirectory(`${this.installDir}resources/views/${call.name}`).then(copyBaseViews.bind(this));
      function copyBaseViews(exists)
      {
        if(exists==='exists') rimraf(`${dir}/*`, (err,results)=>{
          console.log(`files exists and will be removed from ${dir}`);
          self.complete(err).then(()=> ncp(`${this.options.resources}/views/baseView/.`, `${dir}.`, doneCopying));
        });
        else if(exists==='new') ncp(`${this.options.resources}/views/baseView/.`, `${dir}.`, doneCopying);
      }

      function doneCopying(err)
      {
        self.complete(err).then(()=>{
          console.log(`Created and copied template view for ${call.name}`);
          async.forEachOf({create:`${dir}create.blade.php`, edit:`${dir}edit.blade.php`, index:`${dir}index.blade.php`, show:`${dir}show.blade.php`, partial:`${dir}partial.blade.php`}, eachFiles, doneWithEachFiles);
        });
      }

      function eachFiles(file, key, callback)
      {
        finalCall     = callback;
        let element   = {path:file, items:[]};
        let name      = (call.name==='user' && false)? call.names: call.name;
        let tableNode = self.scopeFields(call.names);//gets the table node in the scope

        element.items.push({search:/_Model_s/g, replace:call.Names});
        element.items.push({search:/_Model_/g, replace:call.Name});
        element.items.push({search:/_item_/g, replace:name});
        element.items.push({search:/_items_/g, replace:call.names});

        if(key==='index') return runIndex(tableNode, element);
        else if(key==='partial') return runPartial(tableNode, element);
        container.push(element);
        finalCall();
      }

      function runIndex(node, element)
      {
        let headers = "";
        let columns = "";
        async.each(node.fields, eachFields, doneHeaders);
        function eachFields(item, callback)
        {
          if((item.label && item.label === false) || (item.name==='slug') || (item.name==='id')) return callback();
          let head = self.strUpFirstLetter(item.label || item.name);
          headers += `<th>${head}</th>`;
          columns += `<td>{{\$${call.name}->${item.name} }}</td>`;
          callback();
        }
        function doneHeaders(err){
          if(err) return finalCall(err);
          element.items.push({search:'_TableHeadings_', replace: headers});
          element.items.push({search:'_TableData_', replace: columns});
          container.push(element);
          finalCall();
        }
      }

      function runPartial(node, element)
      {
        let formElement = "";
        let listElement = "";
        async.each(node.fields, eachFields, doneField);
        function eachFields(item, callback)
        {
          if((item.name==='slug') || (item.name==='id')) return callback();
          let label = self.strUpFirstLetter(item.label || item.name);
          formElement += self.elementForm(item, call, label, node);
          listElement += self.elementList(item, call, label, node);
          callback();
        }

        function doneField(err){
          if(err) return finalCall(err);
          element.items.push({search:'_FormValues_', replace: formElement});
          element.items.push({search:'_FormHeadings_', replace: listElement});
          container.push(element);
          finalCall();
        }
      }

      function doneWithEachFiles(err, result)
      {
        self.complete(err, result).then(()=>{
          async.map(container, self.fileContentChangeWrite.bind(self), done);
        });
        function done(err, data)
        {
          self.complete(err).then(()=>{
            self.elapse('Finished file replacement');
          });
        }
      }
    }

    copyFiles()
    {
      let msg;
      let copies= [];
      let self  = this;
      return new Promise(promise.bind(this));

      function promise(resolve, reject)
      {
        if(this.run.copy===false) return resolve();
        rimraf(`${this.installDir}database/migrations/*`, this.done.bind('remove directory migration'));
        rimraf(`${this.installDir}app/User.php`, this.done.bind('remove file app/user.php'));

        ncp.clobber = true;
        copies.push({from:`${this.options.resources}routes.php`,    to:`${this.installDir}app/Http/routes.php`});
        copies.push({from:`${this.options.resources}Kernel.php`,    to:`${this.installDir}app/Http/Kernel.php`});
        copies.push({from:`${this.options.resources}styling/.`,     to:`${this.installDir}public/.`});
        copies.push({from:`${this.options.resources}controllers/.`, to:`${this.installDir}app/Http/Controllers/.`});
        copies.push({from:`${this.options.resources}requests/.`,    to:`${this.installDir}app/Http/Requests/.`});
        copies.push({from:`${this.options.resources}views/.`,       to:`${this.installDir}resources/views/.`});
        copies.push({from:`${this.options.resources}config/.`,      to:`${this.installDir}config/.`});
        copies.push({from:`${this.options.resources}middleware/.`,  to:`${this.installDir}app/Http/Middleware/.`});
        copies.push({from:`${this.options.resources}exceptions/.`,  to:`${this.installDir}app/Exceptions/.`});
        copies.push({from:`${this.options.resources}composer.json`, to:`${this.installDir}composer.json`});

        msg = {success:"Files copied finished", error:"Error with file copied"};
        async.each(copies, callme, done);

        function callme(item, callback)
        {
          callback();
          ncp(item.from, item.to, doneCopying);

          function doneCopying(err, results)
          {
            if(err)
            {
              console.log(`Failed to copy file ${item.from} to ${item.to}`,err);
              reject(err);
              return;
            }
            console.log(`Copied file ${item.from} to ${item.to}`);
          }
        }

        function done(err, results)
        {
          if(err)
          {
            console.log('error copying files', err);
            reject(err);
            return;
          }
          console.log("Files copied finished");
          resolve(true);
        }
      }
    }

    elementForm(field, call, label, node)
    {
      let type;
      let options     = null;
      let required    = "";
      let text        = "";
      let attributes  = "";

      if(field.validation && field.validation.indexOf('required')!==-1) required =  ", 'required'=>''";
      if(field.size) attributes += `, 'maxlenght'=>${field.size}`;
      switch(field.type)
      {
        case 'enum':
          type = 'checkbox';
          options = JSON.stringify(field.enum);
          break;
        case 'boolean':
          type = 'radio'; break;
        case 'email':
          type = 'email'; break;
        case 'text':
          type = 'textarea'; break;
        case 'integer':
          type = 'number'; break;
        case 'dateTime':
        case 'date':
        case 'time':
        case 'timestamp':
        default:
          if(field.size && field.size > 150) type = 'textarea';
          else type = 'text';
          break;
      }
      if(field.join)
      {
        let Parent  = this.strUpFirstLetter(pluralize.singular(field.join[0]));
        let parents = field.join[0];
        //parent      = `\$${call.name}->_${parent}`;
        text    = `<?php $values = array_merge([0=>' -- Select --'], \$${call.name}->_${parents});?>`;
        type        = 'select';
        options     = `$values`;
      }
      type = field.customType || type;
      let content = `        
        <div class="form-group">
          ${text}
          {!! Form::label('${field.name}', '${label}', array('class'=>'col-sm-2 control-label')) !!}
          <div class="col-sm-10">
          {!! Form::${type}('${field.name}', ${options}, array('class'=>'form-control'${required}${attributes})) !!}
          </div>
        </div>`;
      return content;
    }

    elementList(field, call, label)
    {
      return `
      <div class="form-group">
        <div class="col-sm-2">
          <strong>${label}</strong>
        </div>
        <div class="col-sm-10">
          {!! \$${call.name}->${field.name} !!}
        </div>
      </div>`
    }

    install()
    {
      return new Promise(promise.bind(this));

      function promise(resolve, reject)
      {
        if(this.run.install === false) return resolve(true);
        let composer = this.shellExec('composer', ['create-project', 'laravel/laravel', this.installDir, '5.1.*', '--prefer-dist']);
        console.log("Installing Laravel...");
        composer.then(resolve).catch(reject);
      }
    }

    migrationDefaults(run)
    {
      let all = {migrate:{controller:true, migration:true, model:true, request:true}, set:{roles:true, replaces:true, views:true}, replace:{routes:true, nav:true}, command:{migration:true}};
      let not = {migrate:{controller:false, migration:false, model:false, request:false}, set:{roles:false, replaces:false, views:false}, replace:{routes:false, nav:false}, command:{migration:false}};
      run = run===true? all: (run)? run: not;
      run.migrate = run.migrate || {};
      run.set     = run.set || {};
      run.replaces= run.replace || {};
      run.views   = run.view || {};
      return run;
    }

    migrationCreation(run)
    {
      if(this.run.migration===false) return;
      run               = this.migrationDefaults(run);
      let self          = this;
      let baseMigration, baseModelFile, baseModelUserFile, baseRequest, baseControllerFile, baseControllerUserFile = null;
      let replaces      = {routes:{search:"//_InsertRoute_", replace:"", leave:true}, nav:{search:"{{--_NavBar_--}}", replace:"", leave:true}};
      let roles         = {};
      let cnt           = 0;
      let tables        = this.scope.properties.tables;
      let tableTotal    = tables.items.length;
      let tableCount    = 0;
      this.elapse('Migration',true);

      readBaseFiles().then((fileContents)=>{//read file in parallel
        baseMigration           = fileContents[0];
        baseModelFile           = fileContents[1];
        baseModelUserFile       = fileContents[2];
        baseControllerFile      = fileContents[3];
        baseControllerUserFile  = fileContents[4];
        baseRequest             = fileContents[5];

        if(this.limitTo)
        {
          this.limitTo = [this.scopeFields(this.limitTo)];
        }
        async.each(this.limitTo|| tables.items, eachTables, done);//run each table
      }, this.done);

      function eachTables(table, callback)
      {
        let baseModel       = table.name==='users'? baseModelUserFile: baseModelFile;//for users model
        let baseController  = table.name==='users'? baseControllerUserFile: baseControllerFile;//for users model
        let Create          = new Migration(tables.items, self.installDir, {baseMigration, baseModel, baseRequest, baseController, table, "cnt": ++cnt});//new instance to avoid conflict
        roles[Create.name]  = true;
        Create.run({migration:run.migrate.migration, model:run.migrate.model, controller:run.migrate.controller, request:run.migrate.request});
        Create.begin(countCallBack);

        if(run.set.views) self.createView({name:Create.name, names:Create.names, Name:Create.Name, Names:Create.Names});
        if(run.set.replaces) Create.tableMigration(replaces);
        callback();
      }

      function countCallBack()
      {
        ++tableCount;
        if(tableCount===tableTotal && run.command.migration)
        {
          Streamify.shellExecs('php', [`${self.installDir}artisan`, 'migrate']).then(()=>{
            self.shellExecs('composer', ['dumpautoload', '-o', `-d=${self.installDir}`]).catch(self.error);
          }, ()=>{
            console.log("Migration failed to run, you may be requied to run it manualy ");
            self.shellExecs('composer', ['dumpautoload', '-o', `-d=${self.installDir}`]).catch(self.error);
          });
        }
      }

      function done(err, result)
      {
        self.elapse('Finished migration');
        if(err)
        {
          console.error("Failed to run through tables",err);
          return;
        }
        //EXECUTE AFTER TABLE ITERATION
        if(run.set.replaces)self.replaceContentAfterTable(replaces, run.replace);
        if(run.set.roles)   self.setMysqlRoles(roles);
        console.info("Base Template creation complete");
      }

      function readBaseFiles()
      {
        // self.fileContentGet(`${process.cwd()}/lib/resources/Laravel/baseFile/baseMigration.php`).then((migrationContent)=>{ callback(null, migrationContent); }, callback);
        return Promise.all([
          self.fileContentGet(`${process.cwd()}/lib/resources/Laravel/baseFiles/baseMigration.php`),
          self.fileContentGet(`${process.cwd()}/lib/resources/Laravel/baseFiles/baseModel.php`),
          self.fileContentGet(`${process.cwd()}/lib/resources/Laravel/baseFiles/baseModelUser.php`),
          self.fileContentGet(`${process.cwd()}/lib/resources/Laravel/baseFiles/baseController.php`),
          self.fileContentGet(`${process.cwd()}/lib/resources/Laravel/baseFiles/baseControllerUser.php`),
          self.fileContentGet(`${process.cwd()}/lib/resources/Laravel/baseFiles/baseRequest.php`)
        ]);
      }
    }

    replaceContent()
    {
      let container = [];
      let db        = this.scope.properties.database;
      let mail      = this.scope.properties.mail;
      return new Promise(promise.bind(this));

      function promise(resolve, reject)
      {
        if(this.run.replace===false) return resolve();
        //app.php
        let element   = {path:`${this.installDir}config/app.php`, items:[]};
        let rep       = `Illuminate\\View\\ViewServiceProvider::class,
        'Laracasts\\Generators\\GeneratorsServiceProvider',
        'Cartalyst\\Sentinel\\Laravel\\SentinelServiceProvider',
        'Laracasts\\Flash\\FlashServiceProvider',
        'Iber\\Generator\\ModelGeneratorProvider',
        Collective\\Html\\HtmlServiceProvider::class,`;
        element.items.push({search:/Illuminate\\View\\ViewServiceProvider::class,/, replace: rep, searchIfNot: /Laracasts\\Generators\\GeneratorsServiceProvider/});

        rep           = `
        'View'        => Illuminate\\Support\\Facades\\View::class,
        'Form'        => Collective\\Html\\FormFacade::class,
        'Html'        => Collective\\Html\\HtmlFacade::class,
        'Activation'  => 'Cartalyst\\Sentinel\\Laravel\\Facades\\Activation',
        'Reminder'    => 'Cartalyst\\Sentinel\\Laravel\\Facades\\Reminder',
        'Sentinel'    => 'Cartalyst\\Sentinel\\Laravel\\Facades\\Sentinel',
        'Flash'       => 'Laracasts\\Flash\\Flash',`;
        element.items.push({search:/\'View\'      \=\> Illuminate\\Support\\Facades\\View::class,/, replace: rep, searchIfNot: /\'Form\'      \=\> Collective\\Html\\FormFacade::class,/});

        container.push(element);
        //.env

        element   = {path:`${this.installDir}.env`, items:[]};
        element.items.push({search:/DB_HOST=(.)*/, replace: `DB_HOST=${db.host}`});
        element.items.push({search:/DB_DATABASE=(.)*/, replace: `DB_DATABASE=${db.database}`});
        element.items.push({search:/DB_USERNAME=(.)*/, replace: `DB_USERNAME=${db.user}`});
        element.items.push({search:/DB_PASSWORD=(.)*/, replace: `DB_PASSWORD=${db.password}`});
        if(mail)
        {
          element.items.push({search:/MAIL_DRIVER=(.)*/, replace: `MAIL_DRIVER=${mail.driver}`});
          element.items.push({search:/MAIL_HOST=(.)*/, replace: `MAIL_HOST=${mail.host}`});
          element.items.push({search:/MAIL_PORT=(.)*/, replace: `MAIL_PORT=${mail.port}`});
          element.items.push({search:/MAIL_USERNAME=(.)*/, replace: `MAIL_USERNAME=${mail.username}`});
          element.items.push({search:/MAIL_PASSWORD=(.)*/, replace: `DB_PASSWORD=${mail.password}`});
          element.items.push({search:/MAIL_ENCRYPTION=(.)*/, replace: `MAIL_ENCRYPTION=${mail.encryption}`});
        }

        container.push(element);
        async.map(container, this.fileContentChangeWrite.bind(this), done);
        function done(err, results)
        {
          if(err)
          {
            console.log("FILE REPLACEMENT FAILED");
            return reject(err);
          }
          console.log("FILE REPLACEMENT successful");
          return resolve();
        }
      }

    }

    replaceContentAfterTable(replaces, replace)
    {
      let self      = this;
      let container = [];
      let routes    = {path:`${this.installDir}app/Http/routes.php`, items:[]};
      let nav       = {path:`${this.installDir}/resources/views/navigation.blade.php`, items:[]};
      let element   = {routes, nav};
      let msg       = 'replacement of routes.php';

      async.forEachOf(replaces, iterator, done);
      function iterator(item, key, callback)
      {//item: contains {search,replace} items from table loop
        if(replace[key] === false) return callback();//skip

        element[key].items.push(item);
        container.push(element[key]);
        callback();
      }
      function done(err)
      {
        self.complete(err).then(()=>async.map(container, self.fileContentChangeWrite.bind(self), self.done.bind("file replacement")) );
      }

    }

    scopeFields(scope)
    {
      scope       = pluralize.plural(scope).toLowerCase();
      let element = _.find(this.scope.properties.tables.items, ['name', scope]);
      return element;
    }

    setMysql(query)
    {
      return new Promise(promise.bind(this));
      let self  = this;
      let db    = this.scope.properties.database;
      let mysql = new Mysql({user:db.user, password:db.password, host:db.host, port:db.port});

      function promise(resolve, reject)
      {
        if(this.run.mysql===false) return resolve();
        if(!query) mysql.db.query(`CREATE DATABASE IF NOT EXISTS ${db.database}`, dbCreateResult);
        else if(query) return mysql.query(query);

        function dbCreateResult(err, results, fields)
        {
          if(err)
          {
            reject(err);
            console.log(`Failed to create database ${db.database}`, err);
            mysql.end();
            return false;
          }
          console.log(`Database ${db.database} created`);
          mysql.end();
          dbReady();
        }

        function dbReady()
        {
          let mysql   = new Mysql({database: db.database,  user:db.user, password:db.password, host:db.host, port:db.port, multipleStatements:true});
          self.mysql  = mysql;

          mysql.executeFile(`${self.options.resources}baseDatabase.sql`).then(()=>{
            resolve();
            console.log("File loaded baseDatabase.sql");
            mysql.end();
          }, reject);
          // mysql.executeFile(`${self.options.resources}foodiebaseDatabase.sql`).then(()=>console.log("File loaded foodiebaseDatabase.sql"));
        }
      }
    }

    setMysqlRoles(roles)
    {
      roles.dashboard = true;
      let self  = this;
      let perm  = JSON.stringify(roles);
      if(!this.mysql)
      {
        let db      = this.scope.properties.database;
        this.mysql  = new Mysql({database: db.database,  user:db.user, password:db.password, host:db.host, port:db.port, multipleStatements:true});
      }
      this.mysql.query(`SELECT id FROM roles WHERE id=1`).then(foundRoles);
      function foundRoles(results)
      {
        let date = new Date();
        if(results.rows.length) self.mysql.query(`UPDATE roles SET permissions =? `, [perm]);
        else self.mysql.query(`INSERT INTO roles SET ?`, {id:1, slug:'administrator', name:'Administrator', permissions:perm, created_at: date, updated_at: date});
        self.mysql.end();
      }
    }

    shellCommands()
    {
      let composer, msg;
      let self = this;
      return new Promise(promise.bind(this));

      function promise(resolve, reject)
      {
        if(this.run.shell===false) return resolve();
        composer= self.shellExec('composer', ['update', `-d=${self.installDir}` ]);
        console.log("Updating composer...");

        composer.then(success).catch(failed);

        function success(results)
        {
          resolve();
          console.log("Composer updated successfully");
        }
        function failed()
        {
          reject(err);
          console.error("failed to update composer");
        }
      }

    }


  };

})();
