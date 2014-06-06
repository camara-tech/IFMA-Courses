module.exports = function(grunt) {

    // Project configuration.
    
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        jshint: {
            all:['Gruntfile.js','./dev/js/*.js']
        }, 
        uglify: {
            dist: {
                files: {
                "./js/index.min.js":['./dev/js/*.js']
                }
            }
        },
        uncss: {
        },
        concurrent: {
        },
        sass:{
            dist: {
                options:{
                    style:"compressed",
                    banner:"/* Theme Name: IFMA Courses Theme\n URI: http://github.com/italy-portugal/IFMA-Courses \n Description: Theme for IFMA Courses Website \n Author: Jonathan Camara \n Author URI: http://www.ifma.org \n Version: 0.0.4 \n Tags: IFMA, white, bootstrap, responsive \n GitHub Theme URI: https://github.com/italy-portugal/IFMA-Courses \n GitHub Branch: develop \n */"
                },
                files:{
                    "./style.css":"./dev/scss/style.scss"
                }
            }
        },
        watch:{
          config:{
            files:['Gruntfile.js'],
            tasks:['jshint'],
            options:{
              reload:true
            }
          },
          scripts:{
            files: ['./dev/js/*.js'],
            tasks: ['jshint','uglify'],
            options:{
              livereload:true
            } 
          },
          css:{
            files:['./dev/scss/*.scss'],
            tasks:['sass'],
            options:{
              livereload: true
            }
          },
          php:{
            files:['./templates/*.php','*.php'],
            options:{
              livereload: true
            }
          }
        }
    });
    
grunt.loadNpmTasks('grunt-contrib-jshint');
grunt.loadNpmTasks('grunt-contrib-uglify');
grunt.loadNpmTasks('grunt-uncss');
grunt.loadNpmTasks('grunt-concurrent');
grunt.loadNpmTasks('grunt-contrib-csslint');
grunt.loadNpmTasks('grunt-contrib-sass'); //fully configured, may change the banner option in order to make compression easier.
grunt.loadNpmTasks('grunt-contrib-watch');


// grunt tasks: default, watch, dist, deploy

// default: run through all the configured tasks once
grunt.registerTask('default', ['jshint', 'uglify','sass']);

// watch: run tasks when a file change and live reload if possible
grunt.registerTask('devel',['watch']);

// dist: generate a non-development version that can be distributed separate from the codebase

// deploy: generate the correct files and push up to Github
};

