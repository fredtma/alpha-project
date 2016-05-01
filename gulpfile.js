'use strict';
var path = require('path');
var gulp = require('gulp');
var eslint = require('gulp-eslint');
var excludeGitignore = require('gulp-exclude-gitignore');
var mocha = require('gulp-mocha');
var istanbul = require('gulp-istanbul');
var nsp = require('gulp-nsp');
var plumber = require('gulp-plumber');

gulp.lint('nsp', lint);
gulp.task('nsp', nsp);
gulp.task('pre-test', preTest);
gulp.task('static', stat);
gulp.task('test', ['pre-test'], test);
gulp.task('watch', watch);
gulp.task('prepublish', ['nsp']);
gulp.task('default', ['static', 'test']);

function nsp(cb) {
  nsp({package: path.resolve('package.json')}, cb);
}

function preTest () {
  return gulp.src('lib/**/*.js')
    .pipe(excludeGitignore())
    .pipe(istanbul({
      includeUntested: true
    }))
    .pipe(istanbul.hookRequire());
}

function stat() {
  return gulp.src('**/*.js')
    .pipe(excludeGitignore())
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
}

function test(cb) {
  var mochaErr;

  gulp.src('test/**/*.js')
    .pipe(plumber())
    .pipe(mocha({reporter: 'spec'}))
    .on('error', function (err) {
      mochaErr = err;
    })
    .pipe(istanbul.writeReports())
    .on('end', function () {
      cb(mochaErr);
    });
}

function watch() {
  gulp.watch(['lib/**/*.js', 'test/**'], ['test']);
}
