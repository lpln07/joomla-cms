/**
 * Created by Clarissa on 28.08.2017.
 */
/*
 @preserve jQuery.PrettyTextDiff 1.0.2
 See https://github.com/arnab/jQuery.PrettyTextDiff/

 Modified to show with and without HTML: Mark Dexter, Joomla Project.
 */

dmp = new diff_match_patch();
text1 = "Hallo Welt";
text2 = "Hallo Welt das ist neu";

diff_text = dmp.diff_main(text1, text2);
diff_text = make_pretty_diff(diff_text);
document.getElementById("diff_area").innerHTML = diff_text;

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