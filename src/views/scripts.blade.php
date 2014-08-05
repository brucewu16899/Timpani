{{ HTML::script('/packages/thyyppa/timpani/ace-builds/src-noconflict/ace.js') }}

        <script>
            $(function(){

                $('div[data-timpani-editor]').each(function(){

                    var editor = ace.edit( this );
                    var textarea = $( 'textarea[name="' + $(this).data('timpani-editor') + '"]' );

                    editor.getSession().setMode( "ace/mode/" + $(this).data('timpani-editor-mode') );
                    editor.setTheme( "ace/theme/" + $(this).data('timpani-editor-theme') );
                    editor.getSession().setUseWrapMode( true );
                    editor.getSession().setUseSoftTabs( true );
                    editor.getSession().setValue( textarea.val() );
                    editor.getSession().on( 'change', function() {
                        textarea.val( editor.getSession().getValue() );
                    });

                });

            });
        </script>
