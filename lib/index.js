/* jshint esversion: 6 */
(function(){
  'use strict';
  const Streamify = require('./class.Streamify');
  const Laravel   = require('./class.Laravel');
  const argv      = require('./helpers/arguments');

  let toRun       = {mysql:argv.mysql, install:argv.install, copy:argv.copy, replace:argv.transfer, shell:argv.shell, migration:argv.migration};
  let migration   = argv.migration;//request, controller, model, migration
  let set         = argv.set;//roles, views, replace
  let replace     = argv.replace;//nav, routes

  let laravel     = new Laravel('ipv','/Users/fredtma/Documents/www/PHP/streamSource/ipv/');
  laravel.runMethod(toRun, argv.limit);
  laravel.createApp()
    .then((dir)=>laravel.createDirectory(dir))
    .then(()=>{
      laravel.setMysql();
      return laravel.install();
    })
    .then(()=>laravel.copyFiles())
    .then(()=>laravel.replaceContent())
    .then(()=>{
      laravel.shellCommands();//composer update
      laravel.migrationCreation({migrate:migration, set:set, replace:replace, command:{migration:argv.command}});
    });
    // laravel.createView('users');

  process.on('uncaughtException', (err) => console.log("Exception:", err));
  process.on('unhandledRejection', (reason, p) => console.log("Unhandled Rejection at: Promise ", p, " reason: ", reason));
})();
