<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eclaro Academy</title>
    <!-- Favicon -->
    <link rel="icon" href="icon.jpeg" type="image/x-icon">
    <!-- External CSS file -->
    <link rel="stylesheet" href="assets/contact.css">
</head>

<body>
    <!-- Header section -->
    <header class="l-navbar" id="nav-bar">
        <a href="index.html">
            <h2 class="logo"></h2>
        </a>
        <!-- Navigation menu -->
        <nav class="navigation">
            <a href="index.html">Home</a>
            <a href="first_page.php">Enroll</a>
            <a href="contact.php">Contact Us</a>
            <a href="admin/index.php">Log In</a>
        </nav>
    </header>

    <!-- Contact Section -->
    <div class="row" id="contatti">
        <div class="container mt-5">
            <div class="row" style="height:550px;">
                <!-- Map section -->
                <div class="col-md-6 maps">
                    <!-- Google Map iframe -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241.22562282667295!2d121.0838427104065!3d14.678062519271656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b97e488002bb%3A0xbb743936c1db23f8!2sEclaro%20Academy%20Inc.%20-%20TESDA!5e0!3m2!1sen!2sph!4v1712646136724!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- Contact form section -->
                <div class="col-md-6">
                    <h2 class="text-uppercase mt-3 font-weight-bold text-white">Contact Us</h2>
                    <!-- Contact form -->
                    <form action="send.php" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <!-- Name input -->
                                    <input type="text" name="name" class="form-control mt-2" placeholder="Name/Company" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <!-- Subject dropdown -->
                                    <select name="subject" class="form-control mt-2" required>
                                        <option value="">Select a Subject</option>
                                        <option value="General Inquiry">General Inquiry</option>
                                        <option value="Admissions">Admissions</option>
                                        <option value="Enrollment">Enrollment</option>
                                        <option value="Technical Support">Technical Support</option>
                                        <option value="Scholarships">Scholarships</option>
                                        <option value="Strand Information">Strand Information</option>
                                        <option value="Student Services">Student Services</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <!-- Email input -->
                                    <input type="email" name="email" class="form-control mt-2" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <!-- Phone input -->
                                    <input type="tel" name="phone" class="form-control mt-2" placeholder="Phone" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="messageemail">
                                    <!-- Message input -->
                                    <textarea name="message" class="form-control" id="exampleFormControlTextarea1" placeholder="Enter Message" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <!-- Terms and conditions checkbox -->
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                        <label class="form-check-label" for="invalidCheck2">
                                           <a href="terms.html"><u> Accept the terms and conditions</u></a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-13">
                                <!-- Submit button -->
                                <button class="btn btn-light" name="submit" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                    <!-- Contact information -->
                    <div class="text-white">
                        <h2 class="text-uppercase mt-4 font-weight-bold">Eclaro Academy</h2>
                        <!-- Contact details -->
                        <i class="fas fa-phone mt-3"></i> <a href="tel:+">+1-212-258-2626</a><br>
                        <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+39) 123456</a><br>
                        <i class="fa fa-envelope mt-3"></i> <a href="">eclaroacademyph@gmail.com</a><br>
                        <a class="fas fa-globe mt-3" href="https://www.facebook.com/EACAD.PH">Eclaro Academy on Facebook</a><br>
                        <i class="fas fa-globe mt-3"></i> 3rd Floor Eclaro Gotetsco Branch, Commonwealth Branch, Quezon City, Philippines<br>
                        <i class="fas fa-globe mt-3"></i> #7 North Zuzuarregui St. Brgy. Old Balara, Quezon City, Philippines<br>
                        <!-- Social media links -->
                        <div class="my-4">
                            <a href=""><i class="fab fa-facebook fa-3x pr-4"></i></a>
                            <a href=""><i class="fab fa-linkedin fa-3x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
                        