<?php
$simple = 'simple string';
$complex = array('more', 'complex', 'object', array('foo', 'bar'));
?>
<script type="text/javascript">
    var simple = '<?php echo $simple; ?>';
    var complex = <?php echo json_encode($complex); ?>;
</script>