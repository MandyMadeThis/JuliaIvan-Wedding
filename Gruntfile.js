module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // concatenate scripts - for development only. **Don't forget to add scripts array in order of dependencies
        concat: {
            options: {
                separator: ';',
            },
            dist: {
                src: ['js//scripts.js'],
                dest: 'js/scripts.min.js'
            },
        },

        // concatenate and minify scripts - prod only. **Don't forget to add scripts array in order of dependencies
        uglify: {
            build: {
                src: ['js/scripts.js'],
                dest: 'js/scripts.min.js'
            }
        },

        // compile Sass.  Expanded for dev and compressed for prod.
        sass: {
            dev: {
                options: {
                    style: 'expand',
                    lineNumbers: true
                },
                files: {
                    'css/style.css': 'sass/style.scss'
                }
            },
            prod: {
                options: {
                    style: 'compressed',
                },
                files: {
                    'css/style.css': 'sass/style.scss'
                }
            }
        },

        // watch these files and do these tasks when something changes
        watch: {
            options: {
                livereload: true
            },

            scripts: {
                files: ['js/*.js'],
                tasks: ['concat'],
                options: {
                    spawn: false,
                },
            },

            css: {
                files: ['sass/*.scss'],
                tasks: ['sass:dev'],
                options: {
                    spawn: false,
                }
            }
        },

        //prefix anything that needs prefixing for the last 3 browser versions - production only
        autoprefixer: {
            options: {
                browsers: ['last 3 version']
            },
            your_target: {
                src: 'css/style.css',
                dest: 'css/style.css',
            },
        },

    });

    // Grunt  plug-in list.
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-autoprefixer');

    // type "grunt" into the terminal for development.
    grunt.registerTask('default', ['sass:dev', 'concat', 'watch']);

    // type "grunt prod"  into the terminal for production .
    grunt.registerTask('prod', ['sass:prod', 'autoprefixer', 'uglify']);

};