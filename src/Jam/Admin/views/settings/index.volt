{{ partial('partials/nav') }}

<section class="content">
    <h1>
        <span class="icon-wrench c-indigo"></span>
        Settings
    </h1>
    {{ partial('partials/flash') }}
    <form method="post" action="/admin/settings/contact-details">
        <div class="widget view-only">
            <h3>
                <span class="icon-address-book"></span>
                Contact Details
            </h3>
            <hr>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Contact Name</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-user"></span>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter a name..." value="{{ contact.getName() }}">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email Address</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon">@</span>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter a email address..." value="{{ contact.getEmail() }}">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-phone"></span>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter a telephone number..." value="{{ contact.getPhone() }}">
                </div>
            </div>
            <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Mobile Phone Number</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-mobile"></span>
                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter a mobile phone number..." value="{{ contact.getMobile() }}">
                </div>
            </div>
            <div class="form-group">
                <label for="fax" class="col-sm-2 control-label">Fax Number</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-printer"></span>
                    <input type="text" name="fax" id="fax" class="form-control" placeholder="Enter a fax number..." value="{{ contact.getFax() }}">
                </div>
            </div>
            <div class="form-group">
                <label for="addressLine1" class="col-sm-2 control-label">Address Line 1</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-home3"></span>
                    <input type="text" name="addressLine1" id="addressLine1" class="form-control" placeholder="Enter the first line of the address..." value="{{ contact.getAddressLine1() }}">
                </div>
            </div>
            <div class="form-group">
                <label for="addressLine2" class="col-sm-2 control-label">Address Line 2</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-home3"></span>
                    <input type="text" name="addressLine2" id="addressLine2" class="form-control" placeholder="Enter the second line of the address..." value="{{ contact.getAddressLine2() }}">
                </div>
            </div>
            <div class="form-group">
                <label for="addressLine3" class="col-sm-2 control-label">Address Line 3</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-home3"></span>
                    <input type="text" name="addressLine3" id="addressLine3" class="form-control" placeholder="Enter the third line of the address..." value="{{ contact.getAddressLine3() }}">
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">Town/City</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-office"></span>
                    <input type="text" name="city" id="city" class="form-control" placeholder="Enter the town/city..." value="{{ contact.getCity() }}">
                </div>
            </div>
            <div class="form-group">
                <label for="postcode" class="col-sm-2 control-label">Postcode</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-location"></span>
                    <input type="text" name="postcode" id="postcode" class="form-control" placeholder="Enter the postcode..." value="{{ contact.getPostcode() }}">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <span class="icon-address-book"></span>&nbsp;&nbsp;Update Company Details
                </button>
            </div>
        </div>
    </form>
    <form method="post" action="/admin/settings/social-media">
        <div class="widget view-only">
            <h3>
                <span class="icon-link"></span>
                Social Media Links
            </h3>
            <hr>
            <div class="form-group">
                <label for="facebook" class="col-sm-2 control-label">Facebook</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-facebook2"></span>
                    <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Enter URL to Facebook page..." value="{{ medias["facebook"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="twitter" class="col-sm-2 control-label">Twitter</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-twitter"></span>
                    <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Enter URL to Twitter page..." value="{{ medias["twitter"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="youtube" class="col-sm-2 control-label">YouTube</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-youtube3"></span>
                    <input type="text" name="youtube" id="youtube" class="form-control" placeholder="Enter URL to YouTube page..." value="{{ medias["youtube"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="google" class="col-sm-2 control-label">Google+</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-google-plus2"></span>
                    <input type="text" name="google" id="google" class="form-control" placeholder="Enter URL to Google+ page..." value="{{ medias["google"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="instagram" class="col-sm-2 control-label">Instagram</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-instagram"></span>
                    <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Enter URL to Instagram page..." value="{{ medias["instagram"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="pinterest" class="col-sm-2 control-label">Pinterest</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-pinterest2"></span>
                    <input type="text" name="pinterest" id="pinterest" class="form-control" placeholder="Enter URL to Pinterest page..." value="{{ medias["pinterest"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="soundcloud" class="col-sm-2 control-label">Soundcloud</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-soundcloud"></span>
                    <input type="text" name="soundcloud" id="soundcloud" class="form-control" placeholder="Enter URL to Soundcloud page..." value="{{ medias["soundcloud"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="github" class="col-sm-2 control-label">Github</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-github4"></span>
                    <input type="text" name="github" id="github" class="form-control" placeholder="Enter URL to Github page..." value="{{ medias["github"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="tumblr" class="col-sm-2 control-label">Tumblr</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-tumblr"></span>
                    <input type="text" name="tumblr" id="tumblr" class="form-control" placeholder="Enter URL to Tumblr blog..." value="{{ medias["tumblr"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="blogger" class="col-sm-2 control-label">Blogger</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-blogger"></span>
                    <input type="text" name="blogger" id="blogger" class="form-control" placeholder="Enter URL toger blog..." value="{{ medias["blogger"] }}">
                </div>
            </div>
            <div class="form-group">
                <label for="wordpress" class="col-sm-2 control-label">WordPress</label>
                <div class="col-sm-10 input-group">
                    <span class="input-group-addon icon-wordpress2"></span>
                    <input type="text" name="wordpress" id="wordpress" class="form-control" placeholder="Enter URL to WordPress blog..." value="{{ medias["wordpress"] }}">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <span class="icon-link"></span>&nbsp;&nbsp;Update Social Media Links
                </button>
            </div>
        </div>
    </form>
</section>
