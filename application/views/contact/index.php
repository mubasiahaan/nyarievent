
<div class="connect ins"></div>
<div class="hdr ins"><img src="<?= ASSETS_PATH; ?>img/h-ctc.png" alt="" /></div>
<div class="body ins">
    <div class="container">
        <section class="journal read">
            <div class="col-md-12">
				<h2>Nyari Event</h2>
                <div class="ket">
                </div>
            </div>
        </section>

        <section class="journal">
             <div class="col-md-8 mar-btm15">
                <div class="arc">
                    <p><strong><?= $web_info['address']; ?></strong></p>
                    <p>Phone : <?= $web_info['phone']; ?><br/>
                        Email :  <?= $web_info['email']; ?> </p>
                </div><br/>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253731.67821548556!2d106.79118134847103!3d-6.450812810584167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d6aa94d477%3A0xebf3b9d252c86a26!2sIstana+Merdeka!5e0!3m2!1sid!2sid!4v1518455704017" width="90%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-md-4 mar-top30">      
                <?php $this->load->view('contact/form'); ?>
                <br/>
            </div>

        </section>
        
    </div>
</div>