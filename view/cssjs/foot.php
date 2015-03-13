<?php
// chargement des scripts du footer
$all_foots = $this->getModel('cssjs')->get_foots();
foreach ($all_foots as $foot) {
    if (is_array($foot)) {
?>
        <script type="text/javascript" <?php
$attrs = array('src', 'async', 'defer');
foreach ($attrs as $attr) {
    if (!empty($foot[$attr])) {
        echo ' ' . $attr . '="' . $foot[$attr] . '" ';
    }
}
?>></script>
<?php
    } else {
        echo $foot . "\n";
    }
}
