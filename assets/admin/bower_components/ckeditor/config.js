/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.tabSpaces = 4;
	config.removeButtons = 'ShowBlocks,About,Iframe,Flash,Anchor,Language,CreateDiv,HiddenField,ImageButton,Button,Select,Textarea,TextField,Radio,Checkbox,Form,Scayt,Print,Preview,NewPage,Save';
};
