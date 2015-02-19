/*global module:false*/
module.exports = function (grunt) {
    'use strict';

    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);


    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        // These files are only used for watching, hence the need for double declaration
        files: {
            styles: [
                'styles/scss/*.scss',
                'styles/scss/**/*.scss',
                'styles/scss/**/**/*.scss'
            ]
        },
        watch: {
            styles: {
                files: ['<%= files.styles %>'],
                tasks: ['sass:dev','autoprefixer']
            },
            scripts: {
                files: ['js/app/*.js'],
                tasks: ['uglify:angular']
            }
        }
    });

    grunt.loadTasks('grunt');

    // Default task.
//    grunt.registerTask('default', ['uglify','sass:dist','clean:svg','svgmin','rename','grunticon:dist']);
//    grunt.registerTask('svg', ['clean:svg','svgmin','rename','grunticon']);
    grunt.registerTask('styles', ['sass:dev','autoprefixer']);
    grunt.registerTask('js', ['uglify:angular']);
};
