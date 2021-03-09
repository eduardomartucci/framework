module.exports = function( grunt ) {

    grunt.initConfig({   
      
        // Leitura do arquivo do projeto
        pkg: grunt.file.readJSON('package.json'),

        //     
        // BUILD PARA O SISTEMA ADMINISTRATIVO UTILIZANDO O SB ADMIN
        // 

        // Configuração das tarefas dividias por plugin

        // concat - concatenar js e css
        concat: {
          concatenar_js: {
            src: [
                'bower_components/jquery/dist/jquery.min.js',
                'bower_components/bootstrap/dist/js/bootstrap.min.js',
                'bower_components/metisMenu/dist/metisMenu.min.js',
                'bower_components/datatables/media/js/jquery.dataTables.min.js',
                'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js',
                'bower_components/datatables-responsive/js/dataTables.responsive.js',
                'bower_components/flot/excanvas.min.js',
                'bower_components/flot/jquery.flot.js',
                'bower_components/flot/jquery.flot.pie.js',
                'bower_components/flot/jquery.flot.resize.js',
                'bower_components/flot/jquery.flot.time.js',
                'bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js',
                'bower_components/raphael/raphael-min.js',
                'bower_components/morrisjs/morris.min.js',
                'bower_components/startbootstrap-sb-admin-2/dist/js/sb-admin-2.js',
                'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
                'bower_components/jquery.maskedinput/dist/jquery.maskedinput.min.js',
                'bower_components/jquery-maskmoney/dist/jquery.maskMoney.min.js',
                'bower_components/tinymce/jquery.tinymce.min.js',   
                'bower_components/tinymce/tinymce.min.js',                                                              
                'bower_components/jquery-ui/jquery-ui.min.js'                    
                ],
            dest: 'public_html/sys/assets/js/componentes.js'      
          },
          concatenar_css: {
            src: ['bower_components/bootstrap/dist/css/bootstrap.css',
                  'bower_components/metisMenu/dist/metisMenu.css',
                  'bower_components/font-awesome/css/font-awesome.css',
                  'bower_components/bootstrap-social/bootstrap-social.css',
                  'bower_components/morrisjs/morris.css',
                  'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css',
                  'bower_components/datatables-responsive/css/dataTables.responsive.css',
                  'bower_components/startbootstrap-sb-admin-2/dist/css/timeline.css',
                  'bower_components/startbootstrap-sb-admin-2/dist/css/sb-admin-2.css',
                  'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
                  'bower_components/jquery-ui/themes/cupertino/jquery-ui.min.css'                  
                  
                ],
            dest: 'public_html/sys/assets/css/componentes.css'
          }
        },
        // > concat


        // < uglify - minificar js
        uglify : {
            options : {
                mangle : false
            },
            minificar_js : {
                files : {
                  'public_html/sys/assets/js/componentes.min.js' : [ 'public_html/sys/assets/js/componentes.js']
                }
            }
        },
        // > uglify

        // < cssmin - minificar css
        cssmin: {
            minificar_css: {
                options: {
                    keepSpecialComments: 0,  
                },
                files: {
                    'public_html/sys/assets/css/componentes.min.css': ['public_html/sys/assets/css/componentes.css']
                }
            }
        } 

    //     
    // BUILD PARA AREA PUBLICA
    //
    
    

    });

// Carregamento dos plugins necessários para as tarefas
grunt.loadNpmTasks('grunt-contrib-concat');
grunt.loadNpmTasks('grunt-contrib-uglify');
grunt.loadNpmTasks('grunt-contrib-cssmin');

// Tarefas que serão executadas de forma sequencial
grunt.registerTask( 'default', ['concat','uglify','cssmin'] );

};
