/* jshint esversion: 6 */
(function(){
  "use strict";
  const async     = require('async');
  const camelCase = require('camelcase');
  const fs        = require('fs');
  const pluralize = require('pluralize');

  const Streamify = require('./class.Streamify');

  module.exports = class Migration
  {
    constructor(tables, installDir, options, source)
    {
      this.installDir = installDir;
      this.source     = source || 'Laravel';
      this.tables     = tables;
      this.cnt        = options.cnt || 0;
      if(options.baseMigration)   this.baseMigration  = options.baseMigration;
      if(options.baseModel)       this.baseModel      = options.baseModel;
      if(options.baseRequest)     this.baseRequest    = options.baseRequest;
      if(options.baseController)  this.baseController = options.baseController;
      if(options.table)           this.table          = options.table;
      this.name       = pluralize.singular(this._table.name);
      this.names      = this._table.name;
      this.Name       = Streamify.strUpFirstLetters(this.name);
      this.Names      = Streamify.strUpFirstLetters(this._table.name);
      this.run(options.tasks);
    }

    begin(countCallBack)
    {
      let self  = this;
      let tasks = {};
      let total = 0;
      let fields= false;
      if(this.tasks.migration)  {++total; fields=true; tasks.migration = this.migrations.bind(this);}
      if(this.tasks.model)      {++total; fields=true; tasks.model = this.models.bind(this);}
      if(this.tasks.request)    {++total; fields=true; tasks.request = this.requests.bind(this);}
      if(this.tasks.controller) {++total; fields=true; tasks.controller = this.controllers.bind(this);}

      async.parallel(tasks, taskDone);

      function taskDone(err, results)
      {
        if(err)
        {
          console.log('Error on task', err);
          return;// callback(err);
        }
        if(fields && true) async.each(self._table.fields, self.fields.bind(self), fieldDone);
        else fieldDone();
      }

      function fieldDone(err, results)
      {
        let cnt = 0;
        if(err)
        {
          console.log('Error on field done', err);
          return;// callback(err);
        }
        if(self.migrate)
        {
          self.migrate.replaces.push({search:'{fields}', replace:self.migrate.content});
          self.migrate.replaces.push({search:'{foreign}', replace:self.migrate.references});
          Streamify.fileDataChanges(self.baseMigration, self.migrate.replaces, self.migrate.file)
            .then((data)=>self.writeBaseData(data, self.migrate.file))
            .then(done).catch(error);
        }
        if(self.model)
        {
          self.model.replaces.push({search:'{related}', replace:self.model.references});
          self.model.replaces.push({search:'{fillable}', replace: JSON.stringify(self.model.fillable)});
          Streamify.fileDataChanges(self.baseModel, self.model.replaces, self.model.file)
            .then((data)=>self.writeBaseData(data, self.model.file))
            .then(done).catch(error);
        }
        if(self.request)
        {
          self.request.replaces.push({search:'{requirements}', replace:self.request.content});
          self.request.replaces.push({search:'{attributes}', replace: self.request.attributes});
          Streamify.fileDataChanges(self.baseRequest, self.request.replaces, self.request.file)
            .then((data)=>self.writeBaseData(data, self.request.file))
            .then(done).catch(error);
        }
        if(self.controller)
        {
          self.controller.replaces.push({search:/\/\/\{children-relation\}/g, replace:self.controller.children});
          self.controller.replaces.push({search:/\/\/\{parent-relation\}/g, replace:self.controller.parent});
          self.controller.replaces.push({search:/\/\/\{parents-relation\}/g, replace:self.controller.parents});
          Streamify.fileDataChanges(self.baseController, self.controller.replaces, self.controller.file)
            .then((data)=>self.writeBaseData(data, self.controller.file))
            .then(done).catch(error);
        }
        function done()
        {//when all the migration, model, controller and request have been created: run php artisan migrate
          ++cnt;
          if(cnt===total)
          {
            countCallBack();//runs each time, migration, model, req, ctrl are done. used 4 table count
          }
        }
        function error(err)
        {
          console.log("Promissing error", err);
        }
      }
    }

    controllers(callback)
    {
      let name        = pluralize.singular(this._table.name);
      let names       = this._table.name;
      let Name        = Streamify.strUpFirstLetters(name);
      let Names       = Streamify.strUpFirstLetters(this._table.name);
      let Eloquent    = Name;
      this.controller = {
        file: `${this.installDir}app/Http/Controllers/${Name}Controller.php`,
        name, names, Name, Names,
        replaces:[],
        skip: (this._table.controller && typeof this._table.controller.skip !== "undefined")? this._table.controller.skip: false,
        links: "",
        children: "",
        parent: "",
        parents: ""
      };

      if(this.Name==='Request')
      {
        Eloquent = 'Model';
      }
      this.controller.replaces.push({search:/\{Model\}/g, replace:this.Name});
      this.controller.replaces.push({search:/\{Models\}/g, replace:this.Names});
      this.controller.replaces.push({search:/\{model\}/g, replace:this.name});
      this.controller.replaces.push({search:/\{models\}/g, replace:this.names});
      this.controller.replaces.push({search:/\{Eloquent\}/g, replace:Eloquent});
      if(this.controller.skip===true) return this.controller = false;

      callback();
    }

    done(err)
    {
      let name = (typeof this ==='string')? this: null;
      if(err) console.error(this.error || `Error in processing ${name}`, err);
      else console.log(this.success || `Successful process ${name}`);
    }

    elapse(until)
    {
      this.appStart = this.appStart || (new Date()).getTime();
      this.appFrom  = (until===true)? (new Date()).getTime(): (this.appFrom)? this.appFrom: (new Date()).getTime();
      let now       = (new Date()).getTime();
      console.log(`TimeStamp on Migration: start@${now-this.appStart} from@${now-this.appFrom}`);
    }

    fields(field, calldone)
    {
      let calls = {};
      let self  = this;
      if(this.migrate)    calls.migrate   = (callback)=>self.fieldMigrate(field, callback);
      if(this.model)      calls.model     = (callback)=>self.fieldModel(field, callback);
      if(this.request)    calls.request   = (callback)=>self.fieldRequest(field, callback);
      if(this.controller) calls.controller= (callback)=>self.fieldController(field, callback);

      async.parallel(calls, calldone);
    }

    fieldController(field, callmain)
    {
      let self  = this;
      async.parallel([join, children, gerund], callmain);

      function join(callback)
      {
        if(field.join)
        {
          let parents = field.join[0];
          let parent  = pluralize.singular(parents);
          let Parent  = Streamify.strUpFirstLetters(parent);
          self.controller.parent  += `\t\t\$${self.name}->_${parent}  = \$${self.name}->_${parent}()->select('id','name')->orderBy('name')->first();\n`;
          self.controller.parents += `\t\t\$${self.name}->_${parents} = \\App\\${Parent}::select('id','name')->orderBy('name')->get();\n`;
        }
        callback(null, 'join');
      }

      function children(callback)
      {
        if(field.children)
        {
          async.each(field.children, iterator, done);
        } else {
          callback(null,'children');
        }

        function iterator (item, callme)
        {
          if(typeof item === "string") item = {"name":item};
          let names   = item.name;
          let content = `\t\t\$${self.name}->_${names}`;
          if(item.fields)
          {
            let order = (item.fields[0]!=='id' || item.fields[0]!=='slug')? item.fields[0]:
              (item.fields[1])? item.fields[1]:
                item.fields[0];
            content   = `\t\t\$${self.name}->_${names} = \$${self.name}->_${names}()->select('${item.fields.join("','")}')->orderBy('${order}')->get()`;
          }
          self.controller.children  += `${content};\n`;
          callme();
        }
        function done(err)
        {
          callback(err,'children');
        }
      }//endfunc

      function gerund(callback)
      {
        if(field.gerund)
        {
          async.each(field.gerund, iterator, done);
        } else {//endif
          callback(null, 'gerund');
        }
        function iterator (item, callme)
        {
          if(item instanceof Object)
          {
            let parents = item.name || item.table;
            let parent  = pluralize.singular(parents);
            let Parent  = Streamify.strUpFirstLetters(parent);

            // self.controller.children+= `\t\t\$${self.name}->_${parent}  = \$${self.name}->_${parent}Link()->select('${parent}.id','${parent}.name')->orderBy('name')->get();\n`;
            self.controller.children+= `\t\t\$${self.name}->_${parent}  = \$${self.name}->_${parent}Link;\n`;
            self.controller.parents += `\t\t\$${self.name}->_${parents} = \\App\\${Parent}::select('id','name')->orderBy('name')->get();\n`;
            return callme();
          }
          callme('not an object');
        }
        function done(err)
        {
          callback(err,'gerund');
        }
      }//endfunc
    }

    fieldMigrate(field, callmain)
    {
      if( (field.migration && field.migration.skip) || field.name==='id' ) return callmain(null, 'migrate');
      let declaration = ``;
      let foreign     = ``;
      let defaults    = (field.default)? `->default('${field.default}')`: '';
      let index       = (field.validation && field.validation.indexOf('index') !==-1 )? '->index()': '';
      let required    = (field.validation && field.validation.indexOf('required') !==-1 )? '': '->nullable()';
      let unique      = (field.validation && field.validation.indexOf('unique') !==-1 )? '->unique()': '';
      let unsigned    = (field.join)? '->unsigned()': '';

      switch(field.type)
      {
        case 'double':
        case 'decimal': declaration += `$table->${field.type}('${field.name}',${field.size||12},${field.decimal||2})`; break;
        case 'char':    declaration += `$table->char('${field.name}',${field.size||45})`; break;
        case 'string':  declaration += `$table->string('${field.name}',${field.size||45})`; break;
        case 'enum':    declaration += `$table->string('${field.name}',${field.enum})`; break;
        default: declaration += `$table->${field.type}('${field.name}')`; break;
      }
      declaration = `\t\t\t${declaration}${defaults}${index}${required}${unique}${unsigned};\n`;
      if(field.join)
      {
        foreign  += `\t\t\t$table->foreign('${field.name}')->references('${field.join[1]||'id'}')->on('${field.join[0]}')->onDelete('cascade');\n`;
      }
      this.migrate.content    += (declaration)? declaration: "";
      this.migrate.references += (foreign)? foreign: "";
      callmain(null, 'migrate');
    }

    fieldModel(field, callmain)
    {
      let self = this;
      async.parallel([fill, join, children, gerund], callmain);

      function fill(callback)
      {
        if( field.name!=='id' && field.name!=='slug' ) self.model.fillable.push(field.name);
        callback(null,'fill');
      }//endfunc

      function join(callback)
      {
        if(field.join)
        {
          let name    = pluralize.singular(field.join[0]);
          let parent  = Streamify.strUpFirstLetters(name);
          let ref     = field.join[1] || 'id';
          self.model.references += `\tfunction _${name}() { return $this->belongsTo('App\\${parent}', '${ref}');}\n`;
        }
        callback(null, 'join');
      }//endfunc

      function children(callback)
      {
        if(field.children)
        {
          async.each(field.children, iterator, done);
        } else {
          callback(null,'children');
        }
        function iterator (item, callme)
        {
          if(typeof item === "string") item = {"name":item};
          let names = item.name;
          let Child = Streamify.strUpFirstLetters(pluralize.singular(names));
          let ref   = item.id || 'id';
          self.model.references += `\tfunction _${names}() { return $this->hasMany('App\\${Child}', '${ref}');}\n`;
          callme();
        }
        function done(err)
        {
          callback(err,'children');
        }
      }//endfunc

      function gerund(callback)
      {
        if(field.gerund)
        {
          async.each(field.gerund, iterator, done);
        } else {//endif
          callback(null, 'gerund');
        }
        function iterator (item, callme)
        {
          if(item instanceof Object)
          {
            let name    = pluralize.singular(item.name || item.table);
            let parent  = Streamify.strUpFirstLetters(name);
            let gerunds = item.link || '';
            let gerund  = gerunds? pluralize.singular(Streamify.strUpFirstLetters(gerunds)): '';
            self.model.references += `\tfunction _${name}Link() { return $this->belongsToMany('App\\${parent}', '${gerunds}');}\n`;
            return callme();
          }
          callme('not an object');
        }
        function done(err)
        {
          callback(err,'gerund');
        }
      }//endfunc
    }

    fieldRequest(field, callmain)
    {
      if( (field.request && field.request.skip) || field.name==='id' || field.name==='slug' ) return callmain(null, 'request');
      let validation  = [];

      if(field.validation instanceof Array)
      {
        let index = field.validation.indexOf('index');
        if(index!==-1) field.validation.splice(index,1);
        validation = field.validation;
      }

      if(validation.length) this.request.content += `\t\t\t"${field.name}" => "${validation.join('|')}"\n`;
      callmain(null, 'request');
    }

    migrations(callback)
    {
      let now         = new Date();
      let num         = (this.cnt<=9)? `0${this.cnt}`: this.cnt;
      let fileDate    = `${num}-${now.getFullYear()+1}_${now.getMonth()}_${now.getDate()}_${now.getHours()}${now.getMinutes()}${now.getMilliseconds()}`;

      this.migrate    = {
        create: (this._table.migration && typeof this._table.migration.create !== "undefined")? this._table.migration.create: true,
        skip:   (this._table.migration && typeof this._table.migration.skip !== "undefined")? this._table.migration.skip: false,
        replaces: [],
        content: "",
        references: ""
      };
      this.migrate.file    = (this.migrate.create)? `${this.installDir}database/migrations/${fileDate}_create_${this._table.name}_table.php`: `${this.installDir}database/migrations/${fileDate}_update_${this._table.name}_table.php`;

      if(this.migrate.skip===false)
      {
        if(this.migrate.create!==true) this.migrate.replaces.push({search: 'create', replace: 'table'});
        this.migrate.replaces.push({search: 'ClassNameTableName', replace: `Create${Streamify.strUpFirstLetters(camelCase(this._table.name))}Table`});
        this.migrate.replaces.push({search: /\{tables\}/g, replace: this._table.name});
      } else {
        this.migrate = false;
      }
      callback();
    }

    models(callback)
    {
      let modelName = pluralize.singular(this._table.name);
      let capName   = Streamify.strUpFirstLetters(modelName);
      this.model = {
        capName,
        file: `${this.installDir}app/${capName}.php`,
        fillable: [],
        modelName,
        replaces: [],
        references: ``,
        skip: (this._table.model && typeof this._table.model.skip !== "undefined")? this._table.model.skip: false,
      };

      this.model.replaces.push({search:'{Model}', replace:this.Name});
      this.model.replaces.push({search:'{Models}', replace:this.Names});
      this.model.replaces.push({search:'{model}', replace:this.name});
      this.model.replaces.push({search:'{models}', replace:this.names});
      if(this.model.skip===true) this.model = false;
      callback();
    }

    requests(callback)
    {
      let name        = pluralize.singular(this._table.name);
      let names       = this._table.name;
      let Name        = Streamify.strUpFirstLetters(name);
      let Names       = Streamify.strUpFirstLetters(this._table.name);
      this.request = {
        file: `${this.installDir}app/Http/Requests/${Name}Request.php`,
        name, names, Name, Names,
        replaces:[],
        skip: (this._table.request && typeof this._table.request.skip !== "undefined")? this._table.request.skip: false,
        content: "",
        attributes: ""
      };

      this.request.replaces.push({search:/\{model\}/g, replace:name});
      this.request.replaces.push({search:/\{Model\}/g, replace:Name});
      if(this.request.skip===true) return this.request = false;
      if(this._table.request && this._table.request.label)
      {
        async.forEachOf(this._table.request.label,(item,key,call)=>{
          this.request.attributes += `\t\t\t'${key}' => '${item.label}'\n`;
          call();
        },callback);
      } else {
        callback();
      }
    }

    tableMigration(replaces)
    {
      replaces.routes.replace += `\tRoute::resource('${this.name}', '${this.Name}Controller');\n`;
      replaces.nav.replace    += `\t\t\t\t@if($user->hasAccess(['${this.name}'])) <li class="<?=in_array('${this.name}',$view)?'active':''?>"> <a href="{{url('${this.name}')}}"><em class="fa fa-th"></em> <span>${this.Names}</span></a></li>@endif\n`;
    }

    run(options)
    {
      options               = options || {};
      this.tasks            = this.tasks || {};
      this.tasks.migration  = options.migration || false;
      this.tasks.model      = options.model || false;
      this.tasks.controller = options.controller || false;
      this.tasks.request    = options.request || false;
    }

    writeBaseData(data, file)
    {
      let self = this;
      return new Promise(promise);

      function promise(resolve, reject)
      {
        fs.writeFile(file, data, 'utf8', done);

        function done(err)
        {
          if(err)
          {
            reject(err);
            console.error(`Failed to write ${file}`, err);
            return;
          }
          resolve(file);
          console.log(`Successfully wrote ${file}`);
        }
      }//promise
    }

    set table (name) {this._table = name;}

  }
})();
