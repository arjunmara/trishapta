@extends('frontend.layouts.master')
@section('frontend-content')
    <section id="contact-page">
        <div class="container">
            <div class="row">
                <div class="bg">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="title text-center">Contact <strong>Us</strong></h2>
                            <div id="gmap" class="contact-map"><iframe src="https://www.google.com/maps/d/embed?mid=1bL5gxoeKJPdEmjBhllzekt_jD5wVPmsc" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="contact-form">
                                <h2 class="title text-center">Get In Touch</h2>
                                <div class="status alert alert-success" style="display: none"></div>
                                <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="name" class="form-control" required="required"
                                               placeholder="Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" name="email" class="form-control" required="required"
                                               placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="text" name="subject" class="form-control" required="required"
                                               placeholder="Subject">
                                    </div>
                                    <div class="form-group col-md-12">
                                    <textarea name="message" id="message" required="required" class="form-control"
                                              rows="8" placeholder="Your Message Here"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="submit" name="submit" id="submit"
                                               class="btn btn-primary pull-right"
                                               value="Submit">
                                    </div>
                                </form>
                                <div class="msg alert alert-success" style="display: none;">Mail Sent Successfully</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="contact-info">
                                <h2 class="title text-center">Contact Info</h2>
                                <address>
                                    <p><strong>Head Office</strong></p>
                                    <p>Trishapta Trading Pvt. Ltd.</p>
                                    <p>Shantipath, Tilotamma-32903</p>
                                    <p>Email: info@trishapta.com</p>
                                    <p><strong>Branch Offices</strong></p>
                                    <p>1.Trishapta Trading Pvt. Ltd., Butwal Branch</p>
                                    <p>Phone: +977-071-540211</p>
                                    <p>Mobile: +977-9857074266, +977-9857073266</p>
                                    <p>2.Trishapta Trading Pvt. Ltd. Pokhara Branch</p>
                                    <p>Phone: +977-061-531912</p>
                                    <p>Mobile: +977-9857074266, +977-9856075266</p>

                                </address>
                                <div class="social-networks">
                                    <h2 class="title text-center">Social Networking</h2>
                                    <ul>
                                        <li>
                                            <a href="https://www.facebook.com/trishapta/" target="_blank"><i
                                                        class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-youtube"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/#contact-page-->
        </div>
    </section>
@endsection
@section('page_specific_js')
    <script>
        $("#main-contact-form").submit(function (e) {

            e.preventDefault();

            var name = $("input[name=name]").val();

            var subject = $("input[name=subject]").val();

            var email = $("input[name=email]").val();

            var message = $("textarea[name=message]").val();

            var token = '{{csrf_token()}}';

            $.ajax({

                type: 'POST',

                url: '{{route('frontend.contact-form')}}',

                data: {name: name, subject: subject, email: email, message: message, _token: token},

                success: function (data) {

                    $('.msg').css('display','block').fadeIn(5000);

                }

            });


        });
    </script>
@endsection