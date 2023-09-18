<?php
    if(isset($_SESSION['status']) && $_SESSION['status_code'] !='' ){
?>
<script>
    setTimeout(function() {
        swal({
            title: "<?php echo $_SESSION['status']; ?>",
            icon: "<?php echo $_SESSION['status_code']; ?>",
            timer: 2500,
            button: false,
            content: {
                element: "span",
                attributes: {
                    innerHTML: "<br>",
                },
            },
        });
    });
</script>
<?php
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}
?>