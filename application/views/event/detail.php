<div class="connect ins"></div>
<div class="hdr ins"><img src="<?= ASSETS_PATH; ?>img/h-make.png" alt="" /></div>
<div class="body ins">
    <div class="container">
        <section class="journal read">
            <div class="col-md-12">
                <div class="ket">
                    <span class="text-muted"><span class="glyphicon glyphicon-eye-open"></span><?= $view ?></span> <i>|</i>
                    <a href="#" class="text-muted">Category</a> : <a href="<?= site_url('event/category/'.$rec_detail->category_id); ?>"><?= $list_category[$rec_detail->category_id] ?></a>
                    <a href="#" class="text-muted">By</a> : <a href="<?= site_url('event/users/' . $rec_detail->insert_user) ?>"><?= $rec_detail->name ?></a>
                    <div class="pull-right">&emsp;/ <?= $rec_detail->rating ?></div>
                    <div class="pull-right">
                        <div class="star">
                            <ul class="rating <?= create_rating($rec_detail->rating) ?>">
                                <li class="one"><a href="#" title="1 Star">1</a></li>
                                <li class="two"><a href="#" title="2 Stars">2</a></li>
                                <li class="three"><a href="#" title="3 Stars">3</a></li>
                                <li class="four"><a href="#" title="4 Stars">4</a></li>
                                <li class="five"><a href="#" title="5 Stars">5</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="journal">
            <div class="col-md-12">
                <section>
                    <div class="col-md-12">
                        <div class="desk">
                            <h1><?= $rec_detail->title; ?></h1>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="col-md-4">
                        <div class="desk">
                            <p><span class="glyphicon glyphicon-time"></span> <?php echo date_format(date_create($rec_detail->event_date), "d M Y"); ?></p>
                            <p class="orr"><span class="glyphicon glyphicon-map-marker"></span> <?= $rec_detail->location; ?></p>
                        
                        </div>
                        <div class="share">
                            <?php $this->load->view('share/soc_med_script'); ?>
                            <?php $this->load->view('share/sharer'); ?>
                           
                        </div>
                        <div>
                            <?php if (isset($rec_detail->latitude) && isset($rec_detail->longitude)) { ?>
                                <iframe src="http://maps.google.com/maps?q=<?= $rec_detail->latitude ?>, <?= $rec_detail->longitude ?>&z=15&output=embed" width="100%" height="270" frameborder="0" style="border:0"></iframe>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <img src="<?= ASSETS_PATH . 'uploads/images/content/' . $rec_detail->image ?>" class="img-responsive" alt="" />
                        <p><?= $rec_detail->detail; ?></p>
                        <div class="review">
                            <h3>Comments</h3>
                            <?php foreach ($rec_comment as $row) { ?>
                                <div>
                                    <h4><?= $row->name ?> <small><?= $row->insert_date ?></small></h4>
                                    <p><?= $row->detail ?></p>
                                </div>
                            <?php } ?>
                            <div>
                                <?php if ($this->session->userdata('sess-loggedin')) { ?>

                                    <div class="review-block-date pull-right"></div>
                                    <div class="review-block-name"><a href="#">Review</a></div>
                                    <form method="post" action="<?= site_url('event/detail/' . $rec_detail->id) ?>">
                                        <div class="review-block-rate">
                                            <input type="radio" id="radio-button-1" name="rating" value="1">
                                            <label for="radio-button-1">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </label>
                                            <input type="radio" id="radio-button-2" name="rating" value="2">
                                            <label for="radio-button-2">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </label>
                                            <input type="radio" id="radio-button-3" name="rating" value="3">
                                            <label for="radio-button-3">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </label>
                                            <input type="radio" id="radio-button-4" name="rating" value="4">
                                            <label for="radio-button-4">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </label>
                                            <input type="radio" id="radio-button-5" name="rating" value="5">
                                            <label for="radio-button-5">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </label>
                                        </div>
                                        <div class="review-block-description"><textarea name="detail" rows="8" class="form-control"></textarea></div>
                                        <button type="submit" name="submit" value="submit">Submit</button>
                                    </form>

                                <?php } ?>

                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </section>
    </div>
</div>


