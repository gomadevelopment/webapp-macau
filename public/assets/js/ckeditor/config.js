/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {
    // Define changes to default configuration here.
    // For complete reference see:
    // https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.toolbarGroups = [
        { name: "clipboard", groups: ["clipboard", "undo"] },
        {
            name: "editing",
            groups: ["find", "selection", "spellchecker", "editing"]
        },
        { name: "links", groups: ["links"] },
        { name: "insert", groups: ["insert"] },
        { name: "forms", groups: ["forms"] },
        { name: "others", groups: ["others"] },
        { name: "basicstyles", groups: ["basicstyles", "cleanup"] },
        { name: "document", groups: ["mode", "document", "doctools"] },
        {
            name: "paragraph",
            groups: ["list", "indent", "blocks", "align", "bidi", "paragraph"]
        },
        { name: "colors", groups: ["colors"] },
        { name: "styles", groups: ["styles"] },
        { name: "tools", groups: ["tools"] },
        { name: "about", groups: ["about"] }
    ];

    config.removeButtons =
		"Subscript,Superscript,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,About,Scayt,Link,Unlink,Anchor,Source,RemoveFormat";
	
    // Set the most common block elements.
    config.format_tags = "p;h1;h2;h3;pre";

    // Simplify the dialog windows.
    config.removeDialogTabs = "image:advanced;link:advanced";
};
