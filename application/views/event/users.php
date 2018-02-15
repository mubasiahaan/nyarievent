<div class="connect ins">
    <div class="container">
        <div class="search">
            <form  action="<?php echo site_url('event/search'); ?>" method="post" >
                <div class="banner-search ins">
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
                        <input type="text" placeholder="Select Date" id="datepick" name="event_date" value="<?= $event_date ?>" class="datepick">
                    </div>
                    <div class="submit-slide">
                        <input type="submit" value="Search Now" name="sumit_home" class="btn style2">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="bgev"><div></div></div>
<div class="body ins">
    <div class="container">
        <section class="journal read">
            <div class="col-md-12">
				<div class="ket">
					<h3>Users Profile &raquo; Event</h3>
				</div>
			</div>
        </section>
        <section class="journal read">
            <div class="col-md-3">
				<div class="profile-sidebar">
					<div class="profile-usertitle">
						<div class="profile-userpic">
							<img src="<?= print_avatar($user_update->id) ?>" class="img-responsive" alt="">
						</div>
						<div class="profile-usertitle-name">
							<?php echo $user_update->name ?>
						</div>
						<div class="profile-usertitle-job">
							<?php echo $user_update->qoutes ?>
						</div>
					</div>
				</div>
            </div>
            <div class="col-md-9">
                <div class="container event-reg">
                    <section class="clearfix">
                        <?php foreach ($rec_latest as $row) { ?>
                            <div class="col-md-12">
                                <section>
                                    <div class="col-md-4">
                                        <div class="img-ev"><img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" class="img-responsive" alt="" /></div>
                                    </div>
                                    <div class="col-md-8 events">
                                        <a href="<?= site_url('event/detail/' . $row->id); ?>">
                                            <div class="desk trs">
                                                <h4 style="margin-bottom:0"><span class="glyphicon glyphicon-time"></span> 14 Nov 2018</h4>
                                                <h3 style="margin-bottom:0"><span class="glyphicon glyphicon-map-marker"></span> <?= $list_city[$row->city_id] ?></h3>
                                                <h3 style="margin-bottom:0"><span class="glyphicon glyphicon-book"></span> <?= $list_category[$row->category_id] ?></h3>
                                                <h2><?= $row->title ?></h2>
                                            </div>
                                        </a>
                                        <div class="star trs">
                                            <ul class="rating <?= create_rating($row->rating) ?>">
                                                <li class="one"><a href="#" title="1 Star">1</a></li>
                                                <li class="two"><a href="#" title="2 Stars">2</a></li>
                                                <li class="three"><a href="#" title="3 Stars">3</a></li>
                                                <li class="four"><a href="#" title="4 Stars">4</a></li>
                                                <li class="five"><a href="#" title="5 Stars">5</a></li>
                                            </ul>
                                        </div>
                                        <a href="<?= site_url('event/detail/' . $row->id); ?>" class="btn-primary">READ DETAIL &raquo;</a>
                                    </div>
                                </section>
                            </div>
                        <?php } ?>
                    </section>
                    <div class="text-center">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>

                </div>



            </div>
        </section>
    </div>
</div>
<script src="<?= ASSETS_PATH; ?>js/demo.js"></script>
<script>
    $(document).ready(function () {
        $('.dropdown-eventtype li span').click(function (event) {
            var option = $(event.target).text();
            $(event.target).parents('.banner-search').find('.eventtype').html(option + ' <span class="caret"></span>');
            $(event.target).parents('.banner-search').find('.eventtypeid').val(option);
        });
        $('.dropdown-eventloc li a').click(function (event) {
            var option = $(event.target).text();
            $(event.target).parents('.banner-search').find('.eventloc').html(option + ' <span class="caret"></span>');
            $(event.target).parents('.banner-search').find('#eventloc').val(option);
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