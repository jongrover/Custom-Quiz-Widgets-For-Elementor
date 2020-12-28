/**
 * Create an audio version of your posts, with a selection of more than 235+ voices across more than 40 languages and variants.
 * Exclusively on Envato Market: https://1.envato.market/speaker
 *
 * @encoding        UTF-8
 * @version         3.1.0
 * @copyright       Copyright (C) 2018 - 2020 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Alexander Khmelnitskiy (info@alexander.khmelnitskiy.ua), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 **/

( function ( $ ) {

    "use strict";

    $( document ).ready( function () {

        let mdpSpeaker = window.mdpSpeaker;

        /** Show Developer tab on multiple logo clicks. */
        $( '.mdc-list .mdc-list-item.mdp-plugin-title' ).on( 'click', function () {

            let count = $( this ).data( 'count' );

            if ( typeof count === 'undefined' ) {
                count = 0;

                setTimeout( function () {
                    $( '.mdc-list .mdc-list-item.mdp-plugin-title' ).removeData( 'count' );
                }, 2000 );
            }

            count++;
            $( this ).data( 'count', count );

            if ( count > 3 ) {

                $( '.mdc-list > .mdc-list-item.mdp-developer' ).removeClass( 'mdc-hidden' ).addClass( 'mdc-list-item--activated' );

                $( '.mdc-list .mdc-list-item.mdp-plugin-title' ).removeData( 'count' );

            }

        } );

        /** Developer Tab: Reset Settings */
        $( '#mdp-dev-reset-settings-btn' ).on( 'click', function ( e ) {

            e.preventDefault();

            /** Disable button and show process. */
            $( this ).attr( 'disabled', true ).addClass( 'mdp-spin' ).find( '.material-icons' ).text('refresh');

            /** Prepare data for AJAX request. */
            let data = {
                action: 'reset_settings',
                nonce: mdpSpeaker.nonceResetSettings,
                doReset: true
            };

            /** Make POST AJAX request. */
            $.post( mdpSpeaker.ajaxURL, data, function( response ) {

                console.info( 'Settings Successfully Cleared.' );

            }, 'json' ).fail( function( response ) {

                /** Show Error message if returned some data. */
                console.error( response );
                alert( 'Looks like an Error has occurred. Please try again later.' );

            } ).always( function() {

                /** Enable button again. */
                $( '#mdp-dev-reset-settings-btn' )
                    .attr( 'disabled', false )
                    .removeClass( 'mdp-spin' )
                    .find( '.material-icons' )
                    .text('clear_all');

            } );

        } );

        /**
         * Initialize CSS Code Editor.
         **/
        function custom_css_init() {

            let $custom_css_fld = $( '#mdp_custom_css_fld' );

            if ( ! $custom_css_fld.length ) { return; }

            let editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror, {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'css'
                }
            );

            let css_editor;
            css_editor = wp.codeEditor.initialize( 'mdp_custom_css_fld', editorSettings );

            css_editor.codemirror.on( 'change', function( cMirror ) {
                css_editor.codemirror.save(); // Save data from CodeEditor to textarea.
                $custom_css_fld.change();
            } );

        }
        custom_css_init();

        /** Make Post Types select more user-friendly - Chosen. */
        let $cptSupport = $( '#mdp-speaker-post-types-settings-cpt-support' );
        $cptSupport.chosen( {
            width: '100%',
            search_contains: true,
            disable_search_threshold: 7,
            inherit_select_classes: true,
            no_results_text: 'Oops, nothing found'
        } );

        /**
         * Show or hide rows in Speech Templates table.
         **/
        function onPostTypesChange() {

            /** All selected post types. */
            let postTypes = $cptSupport.val();

            /** Hide all rows and show ony used. */
            $( '#mdp-custom-posts-tbl tr.mdc-data-table__row' ).hide( 300 );

            /** Foreach of supported post type. */
            $.each( postTypes, function( index, postType ) {

                $( '#mdp-custom-posts-tbl [data-post-type="' + postType + '"]' ).parent().parent().show( 300 );

            } );

        }
        $( document ).on( 'change', $cptSupport, onPostTypesChange );
        onPostTypesChange();

        /** Save new default speech template on list change. */
        /** For each select create change listener. */
        $( '#mdp-custom-posts-tbl .mdc-select[data-mdc-index]' ).each( function () {

            /** Get reference index in global array. */
            let index = $( this ).data( 'mdc-index' );

            /** Get select. */
            let MDCSelect;
            MDCSelect = window.MerkulovMaterial[index];

            /** Set new default ST on change. */
            MDCSelect.listen( 'MDCSelect:change', saveDefaultSpeechTemplate );

        } );

        /**
         * Send new default speech template for current post type.
         **/
        function saveDefaultSpeechTemplate( e ) {
            e.preventDefault();

            let $that = $( this );

            /** Busy flag. */
            let inProgress = $that.data( 'in-progress' );

            /** Fire and wait result. */
            if ( inProgress ) {
                return;
            } else {
                $that.data( 'in-progress', true );
            }

            /** Speech Template ID. */
            let STID = $that.find( 'input' ).val();

            /** Current Post Type. */
            let postType = $that.parent().prev().find( 'span[data-post-type]' ).data( 'post-type' );

            /** Set as default by AJAX. */
            let data = {
                action: 'set_default_st',
                nonce: mdpSpeaker.nonce,
                stid: STID,
                postType: postType,
            };

            $.post( mdpSpeaker.ajaxURL, data, function ( response ) {

                /** ST was set as default. */
                if ( response.success ) {

                    console.info( 'Default template for ' + postType + ' was changed successfully.' );

                } else {

                    /** Show Error message to user. */
                    showErrorMsg( response );

                }

            } )
            .fail( function( response ) {

                /** Show Error message to user. */
                showErrorMsg( response );

            } )
            .always( function () {

                /** Enable select for ajax. */
                $that.removeData( 'in-progress' );

            } );

        }

        /** Make table great again! */
        let $langTable = $( '#mdp-speaker-settings-language-tbl' );
        $langTable.removeClass('hidden');
        $langTable.DataTable( {

            /** Show entries. */
            lengthMenu: [ [-1], ["All"] ],

            /** Add filters to table footer. */
            initComplete: function () {
                this.api().columns().every(function () {
                    let column = this;
                    let select = $( '#mdp-speaker-language-filter' );

                    /** Create filter only for first column. */
                    if ( column[0][0] !== 0 ) { return; }

                    select.on( 'change', function () {

                        $( '#mdp-speaker-settings-language-tbl tbody' ).show();
                        $( '#mdp-speaker-settings-language-tbl_info' ).show();
                        $( '#mdp-speaker-settings-language-tbl_paginate' ).hide();
                        $( '#mdp-speaker-settings-language-tbl_length' ).hide();
                        $( '#mdp-speaker-settings-language-tbl thead' ).show();

                        let val = $.fn.dataTable.util.escapeRegex( $(this).val() );
                        if ( '0' === val ) { val = ''; }
                        column.search( val ? '^' + val + '$' : '', true, false ).draw();
                    } );

                } );

                // Hide all lines on first load.
                $( '#mdp-speaker-settings-language-tbl tbody' ).hide();
                $( '#mdp-speaker-settings-language-tbl_info' ).hide();
                $( '#mdp-speaker-settings-language-tbl_paginate' ).hide();
                $( '#mdp-speaker-settings-language-tbl_length' ).hide();
                $( '#mdp-speaker-settings-language-tbl thead' ).hide();
            }
        } );

        /** Select language. */
        $( '#mdp-speaker-settings-language-tbl tbody' ).on( 'click', 'tr', function () {
            $( '#mdp-speaker-settings-language-tbl tr.selected' ).removeClass( 'selected' );
            $( this ).addClass( 'selected' );

            let lang_code = $( '#mdp-speaker-settings-language-tbl tr.selected .mdp-lang-code' ).text();
            let voice_name = $( '#mdp-speaker-settings-language-tbl tr.selected .mdp-voice-name' ).attr("title");
            $( '.mdp-now-used strong' ).html( voice_name );
            $( '#mdp-speaker-settings-language-code' ).val( lang_code );
            $( '#mdp-speaker-settings-language' ).val( voice_name );

            // Update Audio Sample.
            let audio = $( '.mdp-now-used audio' );
            $( '.mdp-now-used audio source:nth-child(1)' ).attr( 'src', 'https://cloud.google.com/text-to-speech/docs/audio/' + voice_name + '.mp3' );
            $( '.mdp-now-used audio source:nth-child(2)' ).attr( 'src', 'https://cloud.google.com/text-to-speech/docs/audio/' + voice_name + '.wav' );
            audio[0].pause();
            audio[0].load();
        } );

        /** Select Language on load. */
        let index = $( '#mdp-speaker-language-filter' ).parent().data( 'mdc-index' );
        $langTable.DataTable().rows().every( function ( rowIdx, tableLoop, rowLoop ) {

            let row = this.data();

            if ( row[1].includes( $( '#mdp-speaker-settings-language' ).val() ) ) {

                window.MerkulovMaterial[index].value = row[0];

                // noinspection UnnecessaryReturnStatementJS
                return;

            }

        } );

        /** Drag & Drop JSON reader. */
        let $dropZone = $( '#mdp-api-key-drop-zone' );
        $dropZone.on( 'dragenter', function() {
            hideMessage();
            $( this ).addClass( 'mdp-hover' );
        } );

        $dropZone.on('dragleave', function() {
            $( this ).removeClass( 'mdp-hover' );
        } );

        /** Setup DnD listeners. */
        $dropZone.on( 'dragover', handleDragOver );

        /** Text Input to store key file. */
        let $key_input = $( '#mdp-speaker-settings-dnd-api-key' );

        /**
         * Read dragged file by JS.
         **/
        $dropZone.on( 'drop', function ( e ) {

            e.stopPropagation();
            e.preventDefault();

            // Show busy spinner.
            $( this ).removeClass( 'mdp-hover' );
            $dropZone.addClass( 'mdp-busy' );

            let file = e.originalEvent.dataTransfer.files[0]; // FileList object.

            /** Check is one valid JSON file. */
            if ( ! checkKeyFile( file ) ) {
                $dropZone.removeClass( 'mdp-busy' );
                return;
            }

            /** Read key file to input. */
            readFile( file )

        } );

        /**
         * Read key file to input.
         **/
        function readFile( file ) {

            let reader = new FileReader();

            /** Closure to capture the file information. */
            reader.onload = ( function( theFile ) {

                return function( e ) {

                    let json_content = e.target.result;

                    /** Check if a string is a valid JSON string. */
                    if ( ! isJSON( json_content ) ) {

                        showErrorMessage( 'Error: Uploaded file is empty or not a valid JSON file.' );

                        $dropZone.removeClass( 'mdp-busy' );
                        return;

                    }

                    /** Check if the key has required field. */
                    let key = JSON.parse( json_content );
                    if ( typeof( key.private_key ) === 'undefined' ){

                        showErrorMessage( 'Error: Your API key file looks like not valid. Please make sure you use the correct key.' );

                        $dropZone.removeClass( 'mdp-busy' );
                        return;

                    }

                    /** Encode and Save to Input. */
                    $key_input.val( btoa( json_content ) );

                    /** Hide error messages. */
                    hideMessage();

                    /** If we have long valid key in input. */
                    if ( $key_input.val().length > 1000 ) {

                        $( '#submit' ).click(); // Save settings.

                    } else {

                        showErrorMessage( 'Error: Your API key file looks like not valid. Please make sure you use the correct key.' );
                        $dropZone.removeClass( 'mdp-busy' );

                    }

                };

            } )( file );

            /** Read file as text. */
            reader.readAsText( file );

        }

        /**
         * Show upload form on click.
         **/
        let $file_input = $( '#mdp-dnd-file-input' );
        $dropZone.on( 'click', function () {

            $file_input.click();

        } );

        $file_input.on( 'change', function ( e ) {

            $dropZone.addClass( 'mdp-busy' );

            let file = e.target.files[0];

            /** Check is one valid JSON file. */
            if ( ! checkKeyFile( file ) ) {
                $dropZone.removeClass( 'mdp-busy' );
                return;
            }

            /** Read key file to input. */
            readFile( file );

        } );

        /** Show Error message under drop zone. */
        function showErrorMessage( msg ) {

            let $msgBox = $dropZone.next();

            $msgBox.addClass( 'mdp-error' ).html( msg );

        }

        /** Hide message message under drop zone. */
        function hideMessage() {

            let $msgBox = $dropZone.next();

            $msgBox.removeClass( 'mdp-error' ).html( '' );

        }

        /**
         * Check if a string is a valid JSON string.
         *
         * @param str - JSON string to check.
         **/
        function isJSON( str ) {

            try {

                JSON.parse( str );

            } catch ( e ) {

                return false;

            }

            return true;

        }

        function handleDragOver( e ) {

            e.stopPropagation();
            e.preventDefault();

        }

        /**
         * Check file is a single valid JSON file.
         *
         * @param file - JSON file to check.
         **/
        function checkKeyFile( file ) {

            /** Select only one file. */
            if ( null == file ) {

                showErrorMessage( 'Error: Failed to read file. Please try again.' );

                return false;

            }

            /** Process json file only. */
            if ( ! file.type.match( 'application/json' ) ) {

                showErrorMessage( 'Error: API Key must be a valid JSON file.' );

                return false;

            }

            return true;
        }

        /**
         * Show Alert with Error.
         **/
        function showErrorMsg( err ) {

            console.error( err );

            if ( err.message ) {
                window.alert( 'ERROR:\n ' + err.message );
            } else if ( err.responseText ) {
                window.alert( 'ERROR:\n ' + err.responseText );
            } else {
                window.alert( 'ERROR:\n ' + err );
            }

        }

        /** Reset Key File. */
        $( '.mdp-reset-key-btn' ).on( 'click', function () {

            $key_input.val( '' );
            $( '#submit' ).trigger( 'click' );

        } );

        /** Subscribe form. */
        let $subscribeBtn = $( '#mdp-speaker-subscribe' );
        $subscribeBtn.on( 'click', function ( e ) {

            e.preventDefault();

            let mail = $( '#mdp-speaker-subscribe-mail' ).val();
            let name = $( '#mdp-speaker-subscribe-name' ).val();
            let plugin = 'speaker';
            let mailIndex = $( '#mdp-speaker-subscribe-mail' ).parent().data( 'mdc-index' );

            if ( mail.length > 0 && window.MerkulovMaterial[mailIndex].valid ) {

                $( '#mdp-speaker-subscribe-name' ).prop( "disabled", true );
                $( '#mdp-speaker-subscribe-mail' ).prop( "disabled", true );
                $( '#mdp-speaker-subscribe' ).prop( "disabled", true );

                $.ajax( {
                    type: "GET",
                    url: "https://merkulove.host/wp-content/plugins/mdp-purchase-validator/esputnik/subscribe.php",
                    crossDomain: true,
                    data: 'name=' + name + '&mail=' + mail + '&plugin=' + plugin,
                    success: function (data) {

                        if ( true === data ) {
                            alert( 'We received your Subscription request. Now you need to confirm your subscription. Please check your inbox for an email from us.' );
                        }

                    },
                    error: function (err) {
                        alert( err );
                    }
                } );

            } else {
                window.MerkulovMaterial[mailIndex].valid = false;
            }

        } );

        /** Check for Updates. */
        let $checkUpdatesBtn = $( '#mdp_speaker_updates_settings-btn' );
        $checkUpdatesBtn.on( 'click', function ( e ) {

            e.preventDefault();

            /** Disable button and show process. */
            $checkUpdatesBtn.attr( 'disabled', true ).addClass( 'mdp-spin' ).find( '.material-icons' ).text( 'refresh' );

            /** Prepare data for AJAX request. */
            let data = {
                action: 'check_updates',
                nonce: mdpSpeaker.nonce,
                checkUpdates: true
            };

            /** Do AJAX request. */
            $.post( mdpSpeaker.ajaxURL, data, function( response ) {

                if ( response ) {
                    console.info( 'Latest version information updated.' );
                    location.reload();
                } else {
                    console.warn( response );
                }

            }, 'json' ).fail( function( response ) {

                /** Show Error message if returned some data. */
                console.error( response );
                alert( 'Looks like an Error has occurred. Please try again later.' );

            } ).always( function() {

                /** Enable button again. */
                $checkUpdatesBtn.attr( 'disabled', false ).removeClass( 'mdp-spin' ).find( '.material-icons' ).text( 'autorenew' );

            } );

        } );

    } );

} ( jQuery ) );
