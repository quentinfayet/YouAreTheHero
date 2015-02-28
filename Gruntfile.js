module.exports = function(grunt) {
    // Chargement automatique de tous nos modules
    require('load-grunt-tasks')(grunt);

    // Configuration des plugins
    grunt.initConfig({
        compass: {
            sass_front: {
                options: {
                    sassDir: 'app/Resources/sass/front',
                    cssDir: '.tmp/css/front',
                    importPath: 'app/Resources/libs',
                    outputStyle: 'expanded',
                    noLineComments: true
                }
            },
            sass_back: {
                options: {
                    sassDir: 'app/Resources/sass/back',
                    cssDir: '.tmp/css/back',
                    importPath: 'app/Resources/libs',
                    outputStyle: 'expanded',
                    noLineComments: true
                }
            }
        }, // End compass
        cssmin: {
            combine: {
                options: {
                    report: 'gzip',
                    keepSpecialComments: 0
                },
                files: {
                    'web/built/front.min.css': [
                        '.tmp/css/front/**/*.css',
                        'app/Resources/css/front/*.css',
                        'app/Resources/css/front/themes/red.css',
                        'app/Resources/libs/font-awesome/css/font-awesome.min.css'
                    ],
                    'web/built/back.min.css': [
                        '.tmp/back/css/**/*.css',
                        'app/Resources/libs/simple-line-icons/simple-line-icons.css'
                    ]
                }
            }
        }, // End cssmin
        uglify: {
            options: {
                mangle: false,
                sourceMap: true,
                sourceMapName: 'web/built/app.map'
            },
            dist: {
                files: {
                    'web/built/front.min.js': [
                        'app/Resources/js/common/metronic.js',
                        'app/Resources/js/front/*.js',
                        '.tmp/js/front/**/*.js'
                    ],
                    'web/built/back.min.js': [
                        'app/Resources/js/common/metronic.js',
                        'app/Resources/js/back/*.js',
                        '.tmp/js/back/**/*.js'
                    ],
                    'web/built/bootstrap.min.js': [
                        'app/Resources/libs/bootstrap-sass-official/assets/javascripts/bootstrap.js'
                    ],
                    'web/built/jquery.min.js': [
                        'app/Resources/libs/jquery/jquery.js'
                    ]
                }
            }
        }, // End uglify
        copy: {
            dist: {
                files: [{
                    expand: true,
                    cwd: 'app/Resources/lib/Fontello/fonts',
                    dest: 'web/fonts',
                    src: ['**']
                },
                {
                    expand: true,
                    cwd: 'app/Resources/lib/simple-line-icons/fonts',
                    dest: 'web/fonts',
                    src: ['**']
                },
                {
                    expand: true,
                    cwd: 'app/Resources/lib/font-awesome/fonts',
                    dest: 'web/fonts',
                    src: ['**']
                },
                {
                    expand: true,
                    cwd: 'app/Resources/lib/images/',
                    dest: 'web/images',
                    src: ['**']
                },
                {
                    expand: true,
                    cwd: 'app/Resources/images',
                    dest: 'web/images',
                    src: ['**']
                }
                ]
            }
        }
    });

    // Déclaration des différentes tâches
    grunt.registerTask('default', ['css', 'javascript']);
    grunt.registerTask('javascript', ['uglify']);
    grunt.registerTask('css', ['compass', 'cssmin']);
    grunt.registerTask('cp', ['copy'])
};