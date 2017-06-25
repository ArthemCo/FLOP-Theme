/*
	Arthem (c) 2017
	==
	run the whole shabang with `$ gulp watch` in the project directory
	install them all with
	$ npm i --save-dev gulp gulp-sass gulp-concat gulp-rename gulp-uglify browser-sync 
*/

// SCSS, HTML, JS development
const gulp = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const browserSync = require('browser-sync').create();

// environment variables
const assetDir = "assets/";

// compiles sass files to css
gulp.task('sass', function () {
	return gulp.src('scss/**/*.scss')
		.pipe(sass({ outputStyle: 'compressed' }).on('error', function (err) {
			console.error(err.message);
			browserSync.notify(err.message, 3000); // Display error in the browser
			this.emit('end'); // Prevent gulp from catching the error and exiting the watch process
		})) // Using gulp-sass
		.pipe(gulp.dest( assetDir + 'css/'))
		.pipe(browserSync.reload({
			stream: true
		}));
});

// similarly to the sass task, scripts compiles and concatinates js files and reloads the browser
gulp.task('scripts', function() {
	// script paths
	let jsSources = 'js/**/*.js',
	    jsDist = assetDir + 'js/';

  return gulp.src(jsSources)
    .pipe(concat('app.js'))
    .pipe(gulp.dest(jsDist))
		.pipe(rename('app.min.js'))
		.pipe(uglify().on('error', function (err) {
			console.error(err.message);
			browserSync.notify(err.message, 3000); // Display error in the browser
			this.emit('end'); // Prevent gulp from catching the error and exiting the watch process
		}))
		.pipe(gulp.dest(jsDist))
		.pipe(browserSync.reload({
			stream: true
		}));
});

// does browser live-reloading
// change to appropriate WordPress install directory / server configuration
gulp.task('browserSync', () => 
	browserSync.init({ proxy: 'localhost/flop/' })
)

// watches files for changes, adjust accordingly
gulp.task('watch', ['browserSync', 'sass', 'scripts'], function () {
	gulp.watch('scss/**/*.scss', ['sass']);
	gulp.watch('js/**/*.js', ['scripts']);
	gulp.watch('**/*.php', browserSync.reload);  // pages
})

// stop old version of gulp watch from running when you modify the gulpfile
gulp.watch("gulpfile.js").on( "change", () => process.exit(0) )