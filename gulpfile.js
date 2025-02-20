import path from 'path';
import fs from 'fs';
import {glob} from 'glob';
import pkg from 'gulp';
const {src, dest, watch, series, parallel} = pkg;
import * as dartSass from 'sass'
import GulpSass from 'gulp-sass';
import terser from 'gulp-terser';
import sharp from 'sharp';
import concat from "gulp-concat";
import webp from 'gulp-webp';
import notify from 'gulp-notify';
import rename from 'gulp-rename';
import cache from 'gulp-cache';
import cssnano from 'cssnano';
import postcss from 'gulp-postcss';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'autoprefixer';
import imagemin from 'gulp-imagemin';




const sass = GulpSass(dartSass);


const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
}


export function css(done) {
    src(paths.scss)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss([autoprefixer(), cssnano()]))
    // .pipe(postcss([autoprefixer()]))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('./public/build/css'));
    done();
}


export function javascript(done) {
    src(paths.js)
    .pipe(sourcemaps.init())
    .pipe(concat('bundle.js'))
    .pipe(terser())
    .pipe(sourcemaps.write('.'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(dest('./public/build/js'))
    done();
}


export function imagenes(done) {
    src(paths.imagenes)
    .pipe(cache(imagemin({ optimizationLevel: 3 })))
    .pipe(dest('./public/build/img'))
    .pipe(notify('Imagen Completada' ));
    done();
}


export function versionWebp(done) {
    src(paths.imagenes)
    .pipe(webp())
    .pipe(dest('./public/build/img'))
    .pipe(notify({ message: 'Imagen Completada' }));
    done()
}


function watchArchivos() {
    watch(paths.scss, css);
    watch(paths.js, javascript);
    watch(paths.imagenes, imagenes);
    watch(paths.imagenes, versionWebp);
}


export default parallel(css, javascript, imagenes, versionWebp, watchArchivos);
