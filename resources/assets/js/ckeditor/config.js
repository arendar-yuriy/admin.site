/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

    config.filebrowserBrowseUrl = '/elfinder/ckeditor';
    config.allowedContent = true;
    config.language = document.getElementsByTagName("html")[0].getAttribute("lang");
    config.extraAllowedContent = 'span(*)';
    config.extraPlugins += (config.extraPlugins ? ',codesnippet' : ',codesnippet' );
    config.codeSnippet_theme = 'pojoaque';

    config.codeSnippet_languages = {
        javascript: 'JavaScript',
        php: 'PHP',
        HTML : 'HTML',
        SQL : 'SQL',
        CSS : 'CSS'
    };

};

$.each(CKEDITOR.dtd.$removeEmpty, function (i, value) {
    CKEDITOR.dtd.$removeEmpty[i] = false;
});
