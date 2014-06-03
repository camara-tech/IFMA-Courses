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
                    style:"compact"
                },
                files:{
                    "./style.css":"./dev/scss/style.scss"
                }
            }
        },
        watch:{
        }
    });
    
grunt.loadNpmTasks('grunt-contrib-jshint');
grunt.loadNpmTasks('grunt-contrib-uglify');
grunt.loadNpmTasks('grunt-uncss');
grunt.loadNpmTasks('grunt-concurrent');
grunt.loadNpmTasks('grunt-contrib-csslint');
grunt.loadNpmTasks('grunt-contrib-sass');
grunt.loadNpmTasks('grunt-contrib-watch');

grunt.registerTask('default', ['jshint', 'uglify','sass']);
};

