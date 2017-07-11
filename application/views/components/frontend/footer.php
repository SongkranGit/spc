<!-- /.container -->
<footer>
    <div class="container-fluid">
        <div class="row contactFooter">
            <div class="container contactArea">
                <div class="row">
                    <div class="col-md-12">
                        <p style="font-weight: bold"><?php echo isset($this->data["settings"]["website_name"]) ? $this->data["settings"]["website_name"] : "" ?></p>
                        <p>
                            <?php
                            if (strcasecmp($this->session->userdata('language'), "english") == 0) {
                                echo isset($this->data["settings"]["address_en"]) ? $this->data["settings"]["address_en"] : "";
                            } else {
                                echo isset($this->data["settings"]["address_th"]) ? $this->data["settings"]["address_th"] : "";
                            }
                            ?>
                        </p>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="contactInfo">
                                    <label>Tel.</label>
                                    <span><?php echo isset($this->data["settings"]["phone"]) ? $this->data["settings"]["phone"] : "" ?></span>
                                </div>
                                <div class="contactInfo">
                                    <label>Email</label>
                                    <span><?php echo isset($this->data["settings"]["email"]) ? $this->data["settings"]["email"] : "" ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="contactInfo">
                                    <label>Mobile.</label>
                                    <span><?php echo isset($this->data["settings"]["mobile"]) ? $this->data["settings"]["mobile"] : "" ?></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="contactInfo">
                                    <label>พูดคุยกับเราเพิ่มเติมได้ที่</label>
                                    <span>
                                        <div class="socialBox2">
                                                <a target="_blank"
                                                   href="<?php echo isset($this->data["settings"]["facebook_link"]) ? $this->data["settings"]["facebook_link"] : "#" ?>"
                                                   class="item img-circle socialIcon" style="float: left"><i class="fa fa-facebook" aria-hidden="true"></i></a>

                                                <a style="float: left; margin-left: 10px" href="https://line.me/R/ti/p/%40studypluscenter" target="_blank"><img
                                                            style="border-radius: 8px" height="40" border="0" alt="เพิ่มเพื่อน"
                                                            src="https://scdn.line-apps.com/n/line_add_friends/btn/en.png"></a>

                                            </div>

                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="bottomFooter">
                <div class="container">
                    <?php if (strtolower($this->uri->segment(1)) == "home" && $this->uri->segment(2) == ""): ?>
                        <div class="row">
                            <div class="col-xs-7">
                                <div class="copy-right">Copyright © 2016 All Rights Reserved.</div>
                            </div>
                            <div class="col-xs-5">
                                <div class="pull-right">
                                    <script type='text/javascript'
                                            src='http://www.siamecohost.com/member/gcounter/graphcount.php?page=studypluscenter&style=02'></script>
                                </div>
                            </div>
                        </div>
                    <?php else:; ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>Copyright © 2017 All Rights Reserved.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</footer>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.8&appId=1721568341449462";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

</body>
</html>

