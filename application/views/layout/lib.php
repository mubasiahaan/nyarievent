<?php
render_html_title($html_title);
render_html_metalink($html_meta);
render_html_metalink($seo);
//render_html_metalink($html_link, 'link');
//render_html_metalink($html_script, 'script');
?>

<meta property="og:url"           content="<?php echo!empty($link) ? $link : site_url(); ?>" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="<?php echo!empty($link) ? $rec_detail->title : 'NyariEvent'; ?>" />
<meta property="og:description"   content="<?php echo!empty($link) ? $rec_detail->preface : "Tempat mencari dan berbagi event"; ?>" />
<meta property="og:image"         content="<?php echo!empty($link) ? ASSETS_PATH . 'uploads/images/content/' . $rec_detail->image : BASE_URL . 'assets/img/nyarievent-logo.png'; ?>" />

<link rel="stylesheet" href="<?= ASSETS_PATH; ?>css/bootstrap.css">
<link rel="stylesheet" href="<?= ASSETS_PATH; ?>css/style.css">
<script src="<?= ASSETS_PATH; ?>js/jquery-1.11.0.min.js"></script>
<script src="<?= ASSETS_PATH; ?>js/bootstrap.js"></script>


