<?php echo isset($info_messages) ? $info_messages : ''; ?>
<?php $this->load->view('admin/info/about'); ?>
<?php $this->load->view('admin/info/contact'); ?>
<?php $this->load->view('admin/info/faq'); ?>
<?php $this->load->view('admin/info/gold'); ?>
<script>
    function send_data(main) {
        image = $('#image').val();
        var value = image + main + ';';
//        var value = main;
        $('#image').val(value);
        $('#myModal').modal('hide');
    }
</script>
<script>
    // Tiny MCE
    tinymce.init({
        selector: ".txt_detail",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]
    });

</script>
