/**
 * Created by Clarissa on 28.08.2017.
 */
/*
 @preserve jQuery.PrettyTextDiff 1.0.2
 See https://github.com/arnab/jQuery.PrettyTextDiff/

 Modified to show with and without HTML: Mark Dexter, Joomla Project.
 */

jQuery(document).ready(function () {
        var dmp = new diff_match_patch(),
            text1 = document.getElementById("diff_area").innerHTML,
            text2 = parent.document.getElementById("jform_articletext_ifr").contentDocument.getElementById("tinymce").innerHTML,
            innerHTML = '',
            innerText = '',
            diff_text,
            diff_html;

        parent.window.onresize = styling_things;
        styling_things();

        diff_html = dmp.diff_main(text1, text2);
        diff_html.forEach(function (elem) {
            innerHTML += make_pretty_diff(elem);
        });
        diff_text = dmp.diff_main(clean_tags(text1), clean_tags(text2));
        console.log(diff_text);
        diff_text.forEach(function (elem) {
            innerText += make_pretty_diff(elem);
        });
        document.getElementById("diff_area").innerHTML = '<div class="diffhtml" style="display: none">'  + innerHTML + '</div> <div class="difftext" style="display: table-cell">'+ innerText + '</div>';

    }
);

function clean_tags(text){
    text_clean = new String(text);
    var regexp = new RegExp('<.*?>');

    while (regexp.test(text_clean)){
         text_clean = text_clean.replace(regexp.exec(text_clean).toString(), '');
    }
    return text_clean;
}

function make_pretty_diff(diff) {
    var data, html, operation, pattern_amp, pattern_gt, pattern_lt, pattern_para, text;
    html = [];
    pattern_amp = /&/g;
    pattern_lt = /</g;
    pattern_gt = />/g;
    pattern_para = /\n/g;
    operation = diff[0], data = diff[1];
    text = data.replace(pattern_amp, '&amp;').replace(pattern_lt, '&lt;').replace(pattern_gt, '&gt;').replace(pattern_para, '<br>');
    switch (operation) {
        case DIFF_INSERT:
            return '<ins>' + text + '</ins>';
        case DIFF_DELETE:
            return '<del>' + text + '</del>';
        case DIFF_EQUAL:
            return '<span>' + text + '</span>';
    }
}

/*
/ positioning of the show-diff-popup.
 */
function styling_things() {
    var popupContainer = parent.document.getElementsByClassName("mce-floatpanel")[0],
        popupBody = popupContainer.getElementsByClassName("mce-container-body")[0],
        popupFoot = popupContainer.getElementsByClassName("mce-foot")[0],
        popupFootChild = popupFoot.firstChild,
        popupFootChildBtn = popupFootChild.getElementsByClassName("mce-btn")[0],
        editor = parent.document.getElementById("jform_articletext_ifr").parentNode,
        editTop = editor.getBoundingClientRect().top,
        editWidth = (editor.offsetWidth) - 30;

    popupContainer.style.top = editTop + 'px';
    popupContainer.style.left = '15px';
    popupContainer.style.width = editWidth + 'px';
    popupBody.style.width = editWidth + 'px';
    popupFoot.style.width = editWidth + 'px';
    popupFootChild.style.width = editWidth + 'px';
    popupFootChildBtn.style.left = "unset";
    popupFootChildBtn.style.right = 0;

}