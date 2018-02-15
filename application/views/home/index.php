<div class="container">
    <div class="text-center">
        <?php if ($this->session->userdata('sess-id')) { ?>
            <a class="signupp" href="<?= site_url('member_area') ?>">My Event</a>
        <?php } else { ?>
            <a class="signupp" href="<?= site_url('register') ?>">Sign Up</a>
        <?php } ?>
    </div>
    <div class="banner-search">
        <form  action="<?php echo site_url('event/search'); ?>" method="post" >
            <div class="input-box">
                <div class="icon icon-grid-view"><span class="glyphicon glyphicon-book"></span></div>
                <select name="event_category">
                    <option value="">Event Type</option>
                    <?php foreach ($list_category as $key => $value) { ?>
                        <option <?= ($key == $event_category) ? "selected" : "" ?> value="<?= $key; ?>"><?= $value ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box location">
                <div class="icon icon-location-1"><span class="glyphicon glyphicon-map-marker"></span></div>
                <select  name="event_city">
                    <option value="">Event Location</option>
                    <?php foreach ($list_city as $key => $value) { ?>
                        <option <?= ($key == $event_city) ? "selected" : "" ?> value="<?= $key; ?>"><?= $value ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-box date">
                <div class="icon icon-calander-month"><span class="glyphicon glyphicon-time"></span></div>
                <input type="text" placeholder="Select Date" id="datepick" name="event_date" class="datepick">
            </div>
            <div class="submit-slide">
                <input type="submit" value="Search Now" name="sumit_home" class="btn style2">
            </div>
        </form>
    </div>
</div>

<div class="bg">
    <?php $this->load->view('home/category'); ?>
    
    <div id="gold">
        <div class="hdr"><img src="<?= ASSETS_PATH; ?>img/h-make.png" alt="" /></div>
        <div id="wrap">
            <section>
                <div class="col-lg-8 col-md-9">
                    <div id="showcase" class="noselect"> 
                        <?php foreach ($rec_main_page as $row) { ?>
                            <div class="cloud9-item"  alt="Firefox">
                                <img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" alt="" />
                            </div>
                        <?php } ?>
                    </div>
                    <div class="navi noselect">
                        <button class="left"> <span class="glyphicon glyphicon-chevron-left"></span> </button>
                        <button class="right"> <span class="glyphicon glyphicon-chevron-right"></span> </button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3">
                    <div id="showcaset" class="noselect"> 
                        <?php foreach ($rec_main_page as $row) { ?>
                            <div class="cloud9-item">
                                <div class="desk">
                                    
                                    <a href="<?= site_url('event/detail/' . $row->id); ?>" ><h2><?= $row->title ?></h2></a>
                                    <p><span class="glyphicon glyphicon-time"></span><?php echo date_format(date_create($row->event_date), "d M Y"); ?>&emsp;|&emsp;<span class="glyphicon glyphicon-map-marker"></span><?= $list_city[$row->city_id] ?></p>
                                    <p><span class="glyphicon glyphicon-book"></span><?= $list_category[$row->category_id] ?>&emsp;|&emsp;<span class="glyphicon glyphicon-user"></span><a href="<?= site_url('event/users/'.$row->insert_user)?>"><?= $row->name ?></a></p>
                                    <!--<div class="star">
                                        <ul class="rating <?= create_rating($row->rating) ?>">
                                            <li class="one"><a href="#" title="1 Star">1</a></li>
                                            <li class="two"><a href="#" title="2 Stars">2</a></li>
                                            <li class="three"><a href="#" title="3 Stars">3</a></li>
                                            <li class="four"><a href="#" title="4 Stars">4</a></li>
                                            <li class="five"><a href="#" title="5 Stars">5</a></li>
                                        </ul>
                                    </div>-->
                                    <a href="<?= site_url('event/detail/' . $row->id); ?>" class="btn-primary">READ DETAIL</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
	<div class="upcoming">
		<div class="hdr"><img src="<?= ASSETS_PATH; ?>img/h-upc.png" alt="" /></div>
		<section>
			<div class="col-md-3" id="circles">
				<div class="circle-menu">
					<div class="circle-dot-2"></div>
					<div class="circle-dot"></div>
					<ul role="tablist">
						<li role="presentation"><a href="#cArt" aria-controls="cArt" role="tab" data-toggle="tab" class="cArt">Art</a></li>
						<li role="presentation"><a href="#cCulinary" aria-controls="cCulinary" role="tab" data-toggle="tab" class="cCulinary">Culinary</a></li>
						<li role="presentation"><a href="#cPhotograph" aria-controls="cPhotograph" role="tab" data-toggle="tab" class="cPhotograph">Photograph</a></li>
						<li role="presentation"><a href="#cSports" aria-controls="cSports" role="tab" data-toggle="tab" class="cSports">Sports</a></li>
						<li role="presentation"><a href="#cExhibition" aria-controls="cExhibition" role="tab" data-toggle="tab" class="cExhibition">Exhibition</a></li>
						<li role="presentation"><a href="#cWorkshop" aria-controls="cWorkshop" role="tab" data-toggle="tab" class="cWorkshop">Workshop</a></li>
						<li role="presentation"><a href="#cMusic" aria-controls="cMusic" role="tab" data-toggle="tab" class="cMusic">Music</a></li>
						<li role="presentation" class="active"><a href="#cLatest" aria-controls="cLatest" role="tab" data-toggle="tab" class="cLatest">Latest Event</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-6 tab-content">
				<section role="tabpanel" class="lis tab-pane fade" id="cArt">
					<?php foreach ($rec_art as $row) { ?>
						<div class="col-md-6 col-xs-12">
							<a href="<?= site_url('event/detail/' . $row->id); ?>">
								<h4><?= $row->title ?><br/><u><?php echo date_format(date_create($row->event_date), "d M Y"); ?></u><br/><i>view detail</i></h4>
								<div class="uimg"><img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" alt="" class="img-responsive" /></div>
							</a>
						</div>                        
					<?php } ?>
				</section>
				<section role="tabpanel" class="lis tab-pane fade" id="cCulinary">
					<?php foreach ($rec_culinary as $row) { ?>
						<div class="col-md-6 col-xs-12">
							<a href="<?= site_url('event/detail/' . $row->id); ?>">
								<h4><?= $row->title ?><br/><u><?php echo date_format(date_create($row->event_date), "d M Y"); ?></u><br/><i>view detail</i></h4>
								<div class="uimg"><img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" alt="" class="img-responsive" /></div>
							</a>
						</div>                        
					<?php } ?>
				</section>
				<section role="tabpanel" class="lis tab-pane fade" id="cPhotograph">
					<?php foreach ($rec_photograph as $row) { ?>
						<div class="col-md-6 col-xs-12">
							<a href="<?= site_url('event/detail/' . $row->id); ?>">
								<h4><?= $row->title ?><br/><u><?php echo date_format(date_create($row->event_date), "d M Y"); ?></u><br/><i>view detail</i></h4>
								<div class="uimg"><img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" alt="" class="img-responsive" /></div>
							</a>
						</div>                        
					<?php } ?>
				</section>
				<section role="tabpanel" class="lis tab-pane fade" id="cSports">
					<?php foreach ($rec_sports as $row) { ?>
						<div class="col-md-6 col-xs-12">
							<a href="<?= site_url('event/detail/' . $row->id); ?>">
								<h4><?= $row->title ?><br/><u><?php echo date_format(date_create($row->event_date), "d M Y"); ?></u><br/><i>view detail</i></h4>
								<div class="uimg"><img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" alt="" class="img-responsive" /></div>
							</a>
						</div>                        
					<?php } ?>
				</section>
				<section role="tabpanel" class="lis tab-pane fade" id="cExhibition">
					<?php foreach ($rec_exhibition as $row) { ?>
						<div class="col-md-6 col-xs-12">
							<a href="<?= site_url('event/detail/' . $row->id); ?>">
								<h4><?= $row->title ?><br/><u><?php echo date_format(date_create($row->event_date), "d M Y"); ?></u><br/><i>view detail</i></h4>
								<div class="uimg"><img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" alt="" class="img-responsive" /></div>
							</a>
						</div>                        
					<?php } ?>
				</section>
				<section role="tabpanel" class="lis tab-pane fade" id="cWorkshop">
					<?php foreach ($rec_workshop as $row) { ?>
						<div class="col-md-6 col-xs-12">
							<a href="<?= site_url('event/detail/' . $row->id); ?>">
								<h4><?= $row->title ?><br/><u><?php echo date_format(date_create($row->event_date), "d M Y"); ?></u><br/><i>view detail</i></h4>
								<div class="uimg"><img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" alt="" class="img-responsive" /></div>
							</a>
						</div>                        
					<?php } ?>
				</section>
				<section role="tabpanel" class="lis tab-pane fade" id="cMusic">
					<?php foreach ($rec_music as $row) { ?>
						<div class="col-md-6 col-xs-12">
							<a href="<?= site_url('event/detail/' . $row->id); ?>">
								<h4><?= $row->title ?><br/><u><?php echo date_format(date_create($row->event_date), "d M Y"); ?></u><br/><i>view detail</i></h4>
								<div class="uimg"><img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" alt="" class="img-responsive" /></div>
							</a>
						</div>                        
					<?php } ?>
				</section>
				<section role="tabpanel" class="lis tab-pane fade in active" id="cLatest">
					<?php foreach ($rec_latest as $row) { ?>
						<div class="col-md-6 col-xs-12">
							<a href="<?= site_url('event/detail/' . $row->id); ?>">
								<h4><?= $row->title ?><br/><u><?php echo date_format(date_create($row->event_date), "d M Y"); ?></u><br/><i>view detail</i></h4>
								<div class="uimg"><img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" alt="" class="img-responsive" /></div>
							</a>
						</div>                        
					<?php } ?>
				</section>
			</div>
			<div class="col-md-3 hidden-xs">
				<?php $this->load->view('home/calendar'); ?>
			</div>
		</section>
	</div>
</div>
<div class="bg sh-mmt">
    <div class="container hidden-xs">
        <div class="hdr"><img src="<?= ASSETS_PATH; ?>img/h-share.png" alt="" /></div>
        <div class="carousel slide carousel-blog" id="myCarouselm">
            <div class="carousel-inner journal">
                <?php
                $i = 0;
                foreach ($rec_story as $row) {
                    $i++;
                    ?>
                    <div class="item <?= ($i == 1) ? 'active' : '' ?>">
                        <div class="col-md-3">
                            <a href="<?= site_url('share_moment/detail/' . $row->id) ?>">
                                <img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" class="img-responsive" alt="" />
                                <h3><?= $row->title; ?></h3>
                                <p class="text-muted"><?= substr($row->preface, 0, 100); ?>... <span class="date">Read more &raquo;</span></p>                    
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <a class="left carousel-control" href="#myCarouselm" data-slide="prev">
                <i class="glyphicon glyphicon-chevron-left"></i></a>
            <a class="right carousel-control" href="#myCarouselm" data-slide="next">
                <i class="glyphicon glyphicon-chevron-right"></i></a>
        </div>
        <div class="text-center">
            <a href="<?= site_url('share_moment'); ?>" class="btn btn-primary">VIEW MORE</a>
        </div>
    </div>
    <div class="connect hm">
        <div class="container">
            <div class="hdr"><img class="ctct" src="<?= ASSETS_PATH; ?>img/h-ctc.png" alt="" /></div>
            <section>
                <div class="col-sm-4">
                    <img src="<?= ASSETS_PATH; ?>img/ico1.png" alt="" />
                    <p><?= $web_info['address'] ?></p>
                </div>
                <div class="col-sm-4">
                    <img src="<?= ASSETS_PATH; ?>img/ico2.png" alt="" />
                    <p><?= $web_info['phone'] ?></p>
                </div>
                <div class="col-sm-4">
                    <img src="<?= ASSETS_PATH; ?>img/ico3.png" alt="" />
                    <p><?= $web_info['email'] ?></p>
                </div>
            </section>
        </div>
    </div>
</div>
<script src="<?= ASSETS_PATH; ?>js/demo.js"></script>
<script src="<?= ASSETS_PATH; ?>js/jquery.reflection.js"></script>
<script src="<?= ASSETS_PATH; ?>js/jquery.cloud9carousel.js"></script>
<script>
    $(function () {
        var showcase = $("#showcase");
        showcase.Cloud9Carousel({
            yPos: 42,
            yRadius: 48,
            mirrorOptions: {
                gap: 12,
                height: 0.2
            },
            buttonLeft: $(".navi > .left"),
            buttonRight: $(".navi > .right"),
            autoPlay: true,
            bringToFront: true,
            onLoaded: function () {
                showcase.css('visibility', 'visible')
                showcase.css('display', 'none')
                showcase.fadeIn(1500)
            }
        });

        var showcaset = $("#showcaset");
        showcaset.Cloud9Carousel2({
            yPos: 42,
            yRadius: 48,
            mirrorOptions: {
                gap: 12,
                height: 0.2
            },
            buttonLeft: $(".navi > .left"),
            buttonRight: $(".navi > .right"),
            autoPlay: true,
            bringToFront: true,
            onLoaded: function () {
                showcaset.css('visibility', 'visible')
                showcaset.css('display', 'none')
                showcaset.fadeIn(1500)
            }
        });

        // Simulate physical button click effect
        $('.navi > button').click(function (e) {
            var b = $(e.target).addClass('down')
            setTimeout(function () {
                b.removeClass('down')
            }, 80)
        })

        $(document).keydown(function (e) {
            switch (e.keyCode) {
                case 37:
                    $('.navi > .left').click()
                    break
                case 39:
                    $('.navi > .right').click()
            }
        })
    });
    $(document).ready(function () {
        $('.dropdown-eventtype li a').click(function (event) {
            var option = $(event.target).text();
            $(event.target).parents('.banner-search').find('.eventtype').html(option + ' <span class="caret"></span>');
            $(event.target).parents('.banner-search').find('#eventtype').val(option);
        });
        $('.dropdown-eventloc li a').click(function (event) {
            var option = $(event.target).text();
            $(event.target).parents('.banner-search').find('.eventloc').html(option + ' <span class="caret"></span>');
            $(event.target).parents('.banner-search').find('#eventloc').val(option);
        });
    });

    $(document).ready(function () {
        $(window).scroll(function () {
            $('.circle-menu').each(function (i) {
                var bottom_of_object = $(this).offset().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height();
                if (bottom_of_window > bottom_of_object) {
                    $(this).animate({'opacity': '1', 'margin-right': '20px'}, 500);
                }
            });
        });
    });
    $(document).ready(function () {
        $(window).scroll(function () {
            $('.cal-all').each(function (i) {
                var bottom_of_object = $(this).offset().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height();
                if (bottom_of_window > bottom_of_object) {
                    $(this).animate({'opacity': '1', 'margin-left': '20px'}, 500);
                }
            });
        });
    });
</script>
<link id="bsdp-css" href="<?= ASSETS_PATH ?>/plugins/bootstrap-datepicker2/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<script src="<?= ASSETS_PATH ?>/plugins/bootstrap-datepicker2/js/bootstrap-datepicker.min.js"></script>


<script>
    $('#datepick').datepicker({
        format: 'yyyy-mm-dd',
    });
</script>