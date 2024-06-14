<?php
session_start();

// Database configuration
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "enmasse";

// Connect to the database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
  // User is already logged in, you can redirect them to a dashboard or another page.
  exit;
}

// If the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if the username and password are valid
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Perform your authentication logic here, e.g., querying the database

  // Assuming authentication is successful, set session variables
  $_SESSION['user'] = $username;

  // Redirect the user to a logged-in page
  header("Location: index.php");
  exit;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>en masse. - Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/en-masse-icon.ico" rel="icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="..." crossorigin="anonymous">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
    rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <h1><a href="index.php"><img src="assets/img/en-masse-logo.png" alt="Logo">en masse.</a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a href="login.php" class="btn">Login/Signup</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-center text-md-left" data-aos="fade-up">
      <h1>A mass emailing system.</h1>
      <h2>En Masse simplifies bulk emailing with an easy-to-use interface and automation features.</h2>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section>

  <!-- ======= Steps Section ======= -->
  <section id="steps" class="steps section-bg">
    <div class="container">

      <div class="row no-gutters">

        <div class="col-lg-4 col-md-6 content-item" data-aos="fade-right">
          <span>01</span>
          <h4>Login/Signup</h4>
          <p>Click on the "Login/Signup" button located at the top right corner of the homepage.</p>
          <br>
          <p>Enter your details.</p>
          <br>
          <p>Click "Login/Signup".</p>
        </div>

        <div class="col-lg-4 col-md-6 content-item" data-aos="fade-right" data-aos-delay="100">
          <span>02</span>
          <h4>Uploading Data</h4>
          <p>After logging in, find and click on the "Upload Data" option.</p>
          <br>
          <p>Choose an Excel file containing your data from your computer.</p>
          <br>
          <p>Click the "Upload" button to submit the file.</p>
        </div>

        <div class="col-lg-4 col-md-6 content-item" data-aos="fade-right" data-aos-delay="200">
          <span>03</span>
          <h4>Viewing Uploaded Data</h4>
          <p>Once the upload is complete, you'll be able to see your uploaded tables listed on the page.</p>
          <br>
          <p>Click on a table name to view its contents.</p>
        </div>

        <div class="col-lg-4 col-md-6 content-item" data-aos="fade-left" data-aos-delay="300">
          <span>04</span>
          <h4>Exporting Data</h4>
          <p>If you need to export the data, find the option to "Export" inside the chosen data table.</p>
          <br>
          <p>Click on this option to download the data as an Excel file.</p>
        </div>

        <div class="col-lg-4 col-md-6 content-item" data-aos="fade-left" data-aos-delay="400">
          <span>05</span>
          <h4>Deleting Data</h4>
          <p>If you want to delete a table, locate the option to "Delete" inside the chosen data table.</p>
          <br>
          <p>Click on this option and confirm the deletion to remove the table from your account.</p>
        </div>

        <div class="col-lg-4 col-md-6 content-item" data-aos="fade-left" data-aos-delay="500">
          <span>06</span>
          <h4>Sending Emails</h4>
          <p>To select recipients, choose a data table or manually type the recipient's email.</p>
          <br>
          <p>Add subject, message, and attachments (optional).</p>
          <br>
          <p>Click the "Send" button to send your email/s.</p>
        </div>

      </div>

    </div>
  </section><!-- End Steps Section -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row">
        <div class="col-xl-6 col-lg-5 pt-5 pt-lg-0">

          <br>

          <div class="icon-box" data-aos="fade-up"
            style="display: flex; flex-direction: column; align-items: start; gap: 10px;">
            <i class="bx bx-receipt"></i>
            <h3 style="color: black;"><strong>About en masse.</strong></h3>
            <p style="color: black; margin: 0;">en masse is a robust web application designed to streamline data
              management, analysis, and communication tasks effortlessly. Built on Flask, it integrates various
              technologies to handle user uploads, database operations, and email communications securely and
              efficiently.</p>
          </div>

          <br>
          <br>

          <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
            <div style="display: flex; flex-direction: column; align-items: start; gap: 10px;">
              <h3 style="color: black;"><strong>Key Features</strong></h3>

              <br>

              <div style="display: flex; align-items: start; gap: 5px;">
                <i class="bi bi-key" style="color: black; margin-right: 15px;"></i>
                <p style="color: black; margin: 0;">
                  <strong>User Authentication and Session Management:</strong> Implemented using Flask sessions and
                  MySQL, ensuring secure user access and management.
                </p>
              </div>

              <br>

              <div style="display: flex; align-items: start; gap: 5px;">
                <i class="bi bi-file-earmark" style="color: black; margin-right: 15px;"></i>
                <p style="color: black; margin: 0;">
                  <strong>Data Upload and Processing:</strong> Users can upload Excel (.xlsx) files containing
                  structured data. The app validates the file format and structure, processes the data, and stores it in
                  dynamically created MySQL tables.
                </p>
              </div>

              <br>

              <div style="display: flex; align-items: start; gap: 5px;">
                <i class="bi bi-envelope" style="color: black; margin-right: 15px;"></i>
                <p style="color: black; margin: 0;">
                  <strong>Mass Email System:</strong> Empowers users to send emails through Simple Mail Transfer
                  Protocol (SMTP) to multiple recipients directly from the application. Supports both plain text
                  messages and attachments, facilitating efficient communication.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-lg-7" data-aos="fade-right">
          <br><br>
          <h3 style="color: black;"><strong>Technologies Used:</strong></h3>
          <br>
          <img src="assets/img/about-img.png" class="img-fluid" alt="">
        </div>
      </div>

    </div>
  </section><!-- End About Section -->

  <!-- ======= Team Section ======= -->
  <section id="team" class="team section-bg">
    <div class="container">

      <div class="section-bg" data-aos="fade-up">
        <h2>Team</h2>
        <br>
        <p>Our team combines expertise in backend development, creative design, and user experience to deliver
          excellence in every aspect of our work. We're dedicated professionals, committed to innovation and
          collaboration to meet and exceed expectations.</p>
      </div>

      <br>
      <br>

      <div class="row">

        <div class="center col-xl-3 col-lg-4 col-md-6" data-aos="fade-up">
          <div class="member">
            <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
            <div class="member-info">
              <div class="member-info-content">
                <h4>Brandon Miranda</h4>
                <span>Backend Developer</span>
              </div>
              <div class="social">
                <a href="https://www.facebook.com/bmiranda30/"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/bmirandaaa_/"><i class="bi bi-instagram"></i></a>
                <a href="https://www.linkedin.com/in/bpmiranda/"><i class="bi bi-linkedin"></i></a>
                <a href="https://www.github.com/bpmiranda3099/"><i class="bi bi-github"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="center col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="member">
            <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
            <div class="member-info">
              <div class="member-info-content">
                <h4>Alexander Asinas</h4>
                <span>Graphic Designer/Quality Assurance Specialist</span>
              </div>
              <div class="social">
                <a href="https://www.facebook.com/aafortz"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/fortz_d_dragon/"><i class="bi bi-instagram"></i></a>
                <a href="https://www.linkedin.com/in/bpmiranda/"><i class="bi bi-linkedin"></i></a>
                <a href="https://github.com/bpmiranda3099"><i class="bi bi-github"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="center col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="member">
            <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
            <div class="member-info">
              <div class="member-info-content">
                <h4>Johann Nikkolai Cepeda</h4>
                <span>Frontend Developer</span>
              </div>
              <div class="social">
                <a href="https://www.facebook.com/Johann.Sebastian.Pachelbel"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/jn_lc17/"><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
                <a href=""><i class="bi bi-github"></i></a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Team Section -->

  <!-- ======= Testimonials Section ======= -->
  <section id="testimonials" class="testimonials">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p style="color: black;">Discover the feedback from our valued users, sharing their experiences and satisfaction
          with our platform.</p>
      </div>

      <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium
                quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
              <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
              <h3>Saul Goodman</h3>
              <h4>Ceo &amp; Founder</h4>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis
                quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
              <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
              <h3>Sara Wilsson</h3>
              <h4>Designer</h4>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor
                labore quem eram duis noster aute amet eram fore quis sint minim.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
              <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
              <h3>Jena Karlis</h3>
              <h4>Store Owner</h4>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim
                dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
              <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
              <h3>Matt Brandon</h3>
              <h4>Freelancer</h4>
            </div>
          </div><!-- End testimonial item -->

          <div class="swiper-slide">
            <div class="testimonial-item">
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa
                labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
              <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
              <h3>John Larson</h3>
              <h4>Entrepreneur</h4>
            </div>
          </div><!-- End testimonial item -->

        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>
  </section><!-- End Testimonials Section -->

  <!-- ======= F.A.Q Section ======= -->
  <section id="faq" class="faq section-bg">
    <div class="container">

      <div class="section-title-black" data-aos="fade-up">
        <h2>F.A.Q</h2>
        <p>Find answers to common questions about our platform and its features.</p>
      </div>

      <div class="faq-list">
        <ul>
          <li data-aos="fade-up">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
              data-bs-target="#faq-list-1">How do I upload my data to the platform?<i
                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
              <p style="color: black;">
                To upload your data, simply log in to your account, navigate to the "Upload Data" section, and follow
                the prompts to select and upload your Excel file containing the data.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="100">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2"
              class="collapsed">Can I export my uploaded data for offline use?<i
                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
              <p style="color: black;">
                Yes, you can export your data by clicking on the "Export" option in the data table you wish to download.
                Your data will be downloaded as an Excel file for easy offline access.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="200">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3"
              class="collapsed">Is my data secure on the platform?<i class="bx bx-chevron-down icon-show"></i><i
                class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
              <p style="color: black;">
                Absolutely. We take data security seriously and implement measures to safeguard your information. Your
                data is encrypted during transmission and stored securely on our servers.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="300">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4"
              class="collapsed">How can I delete a table from my account?<i class="bx bx-chevron-down icon-show"></i><i
                class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
              <p style="color: black;">
                To delete a table, navigate to the table you want to remove and click on the "Delete" option. Confirm
                the deletion, and the table will be permanently removed from your account.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="400">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5"
              class="collapsed">Is there a limit to the size or number of tables I can upload?<i
                class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
              <p style="color: black;">
                While there's currently no specific limit imposed on the size or number of tables you can upload, we
                recommend optimizing your data and adhering to reasonable usage guidelines to ensure smooth performance
                for all users.
              </p>
            </div>
          </li>

        </ul>
      </div>

    </div>
  </section><!-- End F.A.Q Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p style="color: black;">For any inquiries, feedback, or assistance, please don't hesitate to contact us using
          the following details:</p>
      </div>

      <div class="row no-gutters justify-content-center" data-aos="fade-up">

        <div class="col-lg-5 d-flex align-items-stretch">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Location:</h4>
              <p>LPU - C, Governor's Dr, General Trias, Cavite, PH</p>
            </div>

            <div class="email mt-4">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>postmaster@mg.enmasse.me</p>
            </div>

            <div class="phone mt-4">
              <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p>+639602056529</p>
            </div>

          </div>

        </div>

        <div class="col-lg-5 d-flex align-items-stretch">
          <iframe style="border:0; width: 100%; height: 270px;"
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15465.396897044337!2d120.9155067!3d14.2911306!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d55f9534769d%3A0x8102047b46464ab7!2sLyceum%20of%20the%20Philippines%20University%20-%20Cavite!5e0!3m2!1sen!2sph!4v1718165935819!5m2!1sen!2sph"
            frameborder="0" allowfullscreen></iframe>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>en masse.</h3>
              <p>
                LPU - C, Governor's Dr<br>
                General Trias, Cavite, PH<br><br>
                <strong>Phone:</strong> <br>
                +639602056529<br><br>
                <strong>Email:</strong> postmaster@.mg.enmasse.me<br>
              </p>
              <br>
              <div>
                <a href="mailto:postmaster@mg.enmasse.me"><i class="fas fa-envelope"
                    style="color: white; font-size: 24px;"></i></a>
                <a href="https://github.com/bpmiranda3099/en-masse"><i class="bi bi-github"
                    style="color: white; font-size: 24px;"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <br>
            <br>
            <h4>Useful Links</h4>
            <br>
            <ul>
              <li><a href="#hero">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#team">Team</a></li>
              <li><a href="#contact">Contact</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>