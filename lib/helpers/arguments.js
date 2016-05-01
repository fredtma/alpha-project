/* jshint esversion: 6 */
(function(){
  "use strict";
  const argv = require('yargs')
    .usage('usage: $0 <command>')
    .options('all',     {alias:"a",   default:false,   describe:"Run all functions", string:"n"}).boolean('all')
    .options('name',    {alias:"n",   default:"",     describe:"The name of the application", string:"n"}).global(['name','n'])
    .options('limit',   {alias:"l",   default:"",     describe:"If you want to limit the script to a specific table"})
    .options('dir',     {alias:"d",   default:"",     describe:"The directory path", string:"d"}).completion('dir').completion('d ').global(['dir','d'])
    .options('mysql',   {alias:"m",   default:false,  describe:"Run mysql migration"}).boolean(['mysql','m'])
    .options('install', {alias:"i",   default:false,  describe:"Run composer laravel install"}).boolean(['install','i'])
    .options('copy',    {alias:"c",   default:false,  describe:"Copy files from  base resource to the new installation"}).boolean(['copy','c'])
    .options('transfer',{alias:"t",   default:false,  describe:"Replace content of certain files (.env, config/app.php)"}).boolean(['transfer','t'])
    .options('shell',   {alias:"s",   default:false,  describe:"Update composer and dumpautoloader in a shell command"}).boolean(['shell','s'])
    .options('migrate', {alias:"g",   describe:"Create new controller, model, request and all the migration"}).array('migrate',['request','model','migration','controller']).array('g',['request','model','migration','controller']).example('migrate', '--migrate request model')
    .options('set',     {alias:"ss",  describe:"Set new roles in the DB and create all the views"}).array('set',['roles','views']).array('r',['roles','views'])
    .options('replace', {alias:"r",   describe:"Replace content in the routes.php, create the navigation"}).array('replace',['route','nav']).array('r',['route','nav']).example('replace','--replaces route')
    .options('command', {alias:"com", default:false,  describe:"Command to run migration"})
    .example('all', '--all')
    .help('h').alias('h','help')
    .fail(function (msg, err) {
      if (err) throw err // preserve stack
      console.error('You broke it!');
      console.error(msg);
      process.exit(1)
    })
    .showHelpOnFail(false, 'Specify --help for available options')
    .argv;

  let run = {name:"", dir:"", mysql:false, install:false, copy:false, transfer:false, shell:false, migration:{controller:false, migration:false, model:false, request:false}, set:{roles:false, replaces:false, views:false}, replace:{routes:false, nav:false}, command:{migration:false}};

  if(argv.all)
  {
    run = {name:"", dir:"", mysql:true, install:true, copy:true, transfer:true, shell:true, migration:{controller:true, migration:true, model:true, request:true}, set:{roles:true, replaces:true, views:true}, replace:{routes:true, nav:true}, command:{migration:true}};
  } else{
    run.name    = argv.name;
    run.dir     = argv.dir;
    run.limit   = argv.limit;
    run.mysql   = argv.mysql;
    run.install = argv.install;
    run.copy    = argv.copy;
    run.transfer= argv.transfer;
    run.shell   = argv.shell;
    if(argv.migrate instanceof Array) argv.migrate.forEach((value, key)=> run.migration[value] = true);
    if(argv.set instanceof Array)     argv.set.forEach((value, key)=> run.set[value] = true);
    run.set['replaces'] = argv.replace? true: false;
    if(argv.replace instanceof Array) argv.replace.forEach((value, key)=> run.replace[value] = true);
    run.command = argv.command;
  }

  module.exports = run;
})();
