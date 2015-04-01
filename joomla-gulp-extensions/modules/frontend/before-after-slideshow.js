var gulp = require('gulp');

var config = require('../../../gulp-config.json');

var extPath   = './extensions/modules/site/before-after-slideshow';
var mediaPath = extPath + '/media/mod_before_after_slideshow';

// Dependencies
var browserSync = require('browser-sync');
var minifyCSS   = require('gulp-minify-css');
var rename      = require('gulp-rename');
var del         = require('del');
var vinylPaths  = require('vinyl-paths');
var sass        = require('gulp-ruby-sass');
var uglify      = require('gulp-uglify');
var concat      = require('gulp-concat');
var zip         = require('gulp-zip');

// Clean
gulp.task('clean:modules.frontend.before-after-slideshow', ['clean:modules.frontend.before-after-slideshow:media'], function() {
	return gulp.src(config.wwwDir + '/modules/mod_before_after_slideshow', { read: false })
		.pipe(vinylPaths(del));
});

// Clean: media
gulp.task('clean:modules.frontend.before-after-slideshow:media', function() {
	return gulp.src(config.wwwDir + '/media/mod_before_after_slideshow', { read: false })
		.pipe(vinylPaths(del));
});

// Copy
gulp.task('copy:modules.frontend.before-after-slideshow',
	[
		'copy:modules.frontend.before-after-slideshow:module',
		'copy:modules.frontend.before-after-slideshow:media'
	],
	function() {
});

// Copy module
gulp.task('copy:modules.frontend.before-after-slideshow:module', ['clean:modules.frontend.before-after-slideshow', 'copy:modules.frontend.before-after-slideshow:media'], function() {
	return gulp.src([
		extPath + '/**',
		'!' + extPath + '/media',
		'!' + extPath + '/media/**'
	])
	.pipe(gulp.dest(config.wwwDir + '/modules/mod_before_after_slideshow'));
});

// Copy media
gulp.task('copy:modules.frontend.before-after-slideshow:media', ['clean:modules.frontend.before-after-slideshow:media'], function() {
	return gulp.src([
			mediaPath + '/**'
		])
		.pipe(gulp.dest(config.wwwDir + '/media/mod_before_after_slideshow'));
});

// Sass
gulp.task('sass:modules.frontend.before-after-slideshow', function () {
		return sass(mediaPath + '/scss/style.scss')
			.on('error', function (err) {
				console.error('Error!', err.message);
		})
		.pipe(gulp.dest(mediaPath + '/css'))
		.pipe(gulp.dest(config.wwwDir + '/media/mod_before_after_slideshow/css'))
		.pipe(minifyCSS())
		.pipe(rename(function (path) {
				path.basename += '.min';
		}))
		.pipe(gulp.dest(mediaPath + '/css'))
		.pipe(gulp.dest(config.wwwDir + '/media/mod_before_after_slideshow/css'));
});

// Compile scripts
gulp.task('scripts:modules.frontend.before-after-slideshow', function () {
	return gulp.src([
			mediaPath + '/js/**/*.js',
			'!' + mediaPath + '/js/**/*.min.js',
			'!' + mediaPath + '/js/**/*-min.js'
		])
		.pipe(gulp.dest(config.wwwDir + '/media/mod_before_after_slideshow/js'))
		.pipe(concat('script.js'))
		.pipe(uglify())
		.pipe(rename(function (path) {
				path.basename += '.min';
		}))
		.pipe(gulp.dest(mediaPath + '/js'))
		.pipe(gulp.dest(config.wwwDir + '/media/mod_before_after_slideshow/js'));
});

// Watch
gulp.task('watch:modules.frontend.before-after-slideshow',
	[
		'watch:modules.frontend.before-after-slideshow:module',
		'watch:modules.frontend.before-after-slideshow:scripts',
		'watch:modules.frontend.before-after-slideshow:sass'
	],
	function() {
});

// Watch: Module
gulp.task('watch:modules.frontend.before-after-slideshow:module', function() {
	gulp.watch([
			extPath + '/**',
			'!' + mediaPath,
			'!' + mediaPath + '/**'
		],
		['copy:modules.frontend.before-after-slideshow:module', browserSync.reload]);
});

// Watch: Scripts
gulp.task('watch:modules.frontend.before-after-slideshow:scripts',
	function() {
		gulp.watch([
			mediaPath + '/js/**/*.js',
			'!' + mediaPath + '/js/**/*.min.js'
		],
		['scripts:modules.frontend.before-after-slideshow', browserSync.reload]);
});

// Watch: Styles
gulp.task('watch:modules.frontend.before-after-slideshow:sass',
	function() {
		gulp.watch(
			[
				mediaPath + '/scss/**'
			],
			['sass:modules.frontend.before-after-slideshow', browserSync.reload]
		);
});