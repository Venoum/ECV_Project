// Include gulp
const gulp = require('gulp')

// Include Our Plugins
const sass = require('gulp-sass')
const concat = require('gulp-concat')
const rename = require('gulp-rename')
const babel = require('gulp-babel')
const livereload = require('gulp-livereload')
const autoprefixer = require('gulp-autoprefixer')

const source = 'dev/'
const dest = 'dest/assets/'

// Compile Our Sass
gulp.task('scss', function () {
  return gulp.src(source + 'scss/*.scss')
      .pipe(sass().on('error', sass.logError))
      .pipe(autoprefixer({
        browsers: ['since 2012'],
        cascade: false
      }))
      .pipe(rename('all.css'))
      .pipe(gulp.dest(dest + 'css/'))
      .pipe(livereload())
})

// Concatenate & Minify JS
gulp.task('scripts', function () {
  return gulp.src(source + 'js/*.js')
      .pipe(babel())
      .pipe(concat('all.js'))
      .on('error', showError)
      .pipe(gulp.dest(dest + 'js/'))
      .pipe(livereload())
})

// Watch Files For Changes
gulp.task('watch', function () {
  livereload.listen()
  gulp.watch(source + 'scss/*.scss', ['scss'])
  gulp.watch(source + 'js/*.js', ['scripts'])
})

// Default Task
gulp.task('default', ['scss', 'scripts', 'watch'])

// Show error
function showError (error) {
  console.log(error.toString())
  this.emit('end')
}
