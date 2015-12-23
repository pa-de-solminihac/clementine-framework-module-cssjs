<?php
// chargement des css
$all_css = Clementine::getModel('cssjs')->get_css();
foreach ($all_css as $key => $css) {
    if (is_array($css)) {
?>
        <link
            rel="<?php echo (isset($css['rel'])) ? $css['rel'] : 'stylesheet'; ?>"
            type="<?php echo (isset($css['type'])) ? $css['type'] : 'text/css'; ?>"
            media="<?php echo (isset($css['media'])) ? $css['media'] : 'screen'; ?>"
            href="<?php echo $css['src']; ?>"
            data-key="<?php echo $key; ?>" />
<?php
    } else {
        echo $css . "\n";
    }
}
// chargement des js
$all_js = Clementine::getModel('cssjs')->get_js();
foreach ($all_js as $key => $js) {
    if (is_array($js)) {
?>
        <script type="text/javascript" <?php
$attrs = array('src', 'async', 'defer');
foreach ($attrs as $attr) {
    if (!empty($js[$attr])) {
        echo ' ' . $attr . '="' . $js[$attr] . '" ';
    }
}
?> data-key="<?php echo $key; ?>" ></script>
<?php
    } else {
        echo $js . "\n";
    }
}
// chargement des scripts du head
$all_heads = Clementine::getModel('cssjs')->get_heads();
foreach ($all_heads as $head) {
    echo $head . "\n";
}
