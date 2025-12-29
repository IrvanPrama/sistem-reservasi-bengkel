<!-- 1st create a basic layout of html -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <!-- If we dond use name meta tag then out web on mobile be zoom out as origmal with -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Including google lato/open sans font -->
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap"
            rel="stylesheet"
        />
        <!-- Linking css file -->
        <!-- Dont include text/css now for safer area -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <title>Kadek Motor</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <div class="navigation">
            <input type="checkbox" class="navigation_checkbox" id="navigate" />
            <label for="navigate" class="navigation_button">
                <span class="navigation_icon">&nbsp;</span>
            </label>
            <!-- &nbsp for blank space -->
            <div class="navigation_background">&nbsp;</div>
            <nav class="navigation_nav">
                <ul class="navigation_list">
                    <!-- Dont go crazy with divs use span sonetime -->
                    <li class="navigation_item">
                        <a href="#section-about" class="navigation_link"
                            ><span>01</span>Tentang Kadek Motor</a
                        >
                    </li>
                    <li class="navigation_item">
                        <a href="#section-feature" class="navigation_link"
                            ><span>02</span>Keunggulan Kadek Motor</a
                        >
                    </li>
                    <li class="navigation_item">
                        <a href="#section-review" class="navigation_link"
                            ><span>04</span>Reviews and Stories</a
                        >
                    </li>
                    <li class="navigation_item">
                        <a href="/booking" class="navigation_link"
                            ><span>05</span>Daftar Service Sekarang</a
                        >
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Header with class header -->
        <header class="header" id="header">
            <!-- Header is the parent element -->
            <!-- Since image is a inline element put it in a div -->
            <!-- <div class="header__logo-box">
                <img
                    src="{{ asset('images/logo-only.png') }}"
                    alt="logo"
                    class="header__logo"
                />
            </div> -->

            <div class="header__logo-box">
    <span class="header__logo-text">Kadek Motor</span>
</div>

            <!-- After the logo box we have two other boxes for heading and button headding inside text box -->
            <div class="header__text-box">
                <h1 class="heading">
                    <span class="heading-pri">KADEK MOTOR</span>
                    <span class="heading-sec"
                        >Melayani dengan setulus hati</span
                    >
                </h1>
                <a
                    href="#section-tour"
                    class="button button-white button-white--basicgreen button-animate"
                    >Lihat Selengkapnya</a
                >
            </div>
        </header>
        <main>
            <!-- About section -->
            <section class="section-about" id="section-about">
                <div class="center-uclass marginbottom-large">
                    <h2 class="section-heading">Tentang Kadek Motor</h2>
                </div>
                <div class="row">
                    <div class="col-1-of-2">
                        <h2 class="heading-ter marginbottom-small">
                            Kadek Motor Bengkel Terpercaya di Bali
                        </h2>
                        <p class="paragraph">
                            Kadek Motor adalah bengkel motor yang berlokasi di
                            Bali dan telah melayani pelanggan selama lebih dari
                            10 tahun. Kami menyediakan berbagai layanan
                            perawatan dan perbaikan motor, mulai dari servis
                            rutin hingga perbaikan mesin yang kompleks. Tim kami
                            terdiri dari mekanik berpengalaman yang siap
                            membantu Anda menjaga motor Anda dalam kondisi
                            terbaik.
                        </p>
                        <h2 class="heading-ter marginbottom-small">
                            Layanan Unggulan Kami
                        </h2>
                        <p class="paragraph">
                            Di Kadek Motor, kami menawarkan berbagai layanan
                            unggulan untuk memenuhi kebutuhan perawatan motor
                            Anda. Layanan kami meliputi servis berkala, ganti
                            oli, tune-up mesin, perbaikan rem, perbaikan
                            kelistrikan, dan masih banyak lagi. Kami juga
                            menyediakan suku cadang asli untuk memastikan
                            kualitas dan keandalan motor Anda tetap terjaga.
                        </p>
                        <a href="#popup" class="button button-green"
                            >Read more &rarr;</a
                        >
                    </div>
                    <div class="col-1-of-2">
                        <div class="comp">
                            <!-- For responsive images use density and art swithing toogether as follows -->
                            <!-- <img srcset="img/img-small.jpg 300w, img/img-large.jpg 1000w"
                                 sizes="(max-width: 56.25em) 20vw, (max-width: 37.5em) 30vw, 300px"
                                 alt="Photo"
                                 class="class_name"
                                 src="img/img-default.jpg"> -->
                            <img
                                src="{{ asset('images/Comp-01.jpeg') }}"
                                alt="photo-1"
                                class="comp_image comp_image-1"
                            />
                            <img
                                src="{{ asset('images/Comp-02.jpeg') }}"
                                alt="photo-2"
                                class="comp_image comp_image-2"
                            />
                            <img
                                src="{{ asset('images/Comp-03.jpeg') }}"
                                alt="photo-3"
                                class="comp_image comp_image-3"
                            />
                            <img
                                src="{{ asset('images/Comp-04.jpeg') }}"
                                alt="photo-4"
                                class="comp_image comp_image-4"
                            />
                        </div>
                    </div>
                </div>
            </section>
            <!-- Features section -->
            <section class="section-feature" id="section-feature">
                <div class="row">
                    <div class="col-1-of-4">
                        <div class="feature-box">
                            <!-- Best way of using SVG icons, Works in a live server only -->
                            <svg class="feature-box_icon">
                                <use
                                    xlink:href="{{ asset('images/Sprite.svg#icon-globe') }}"
                                ></use>
                                <!-- Using SVG gradient-id(As url), offset tells from where to start and end -->
                                <linearGradient id="svg-gradient">
                                    <stop
                                        class="feature-box_icon--start"
                                        offset="0%"
                                    />
                                    <stop
                                        class="feature-box_icon--stop"
                                        offset="100%"
                                    />
                                </linearGradient>
                            </svg>
                            <h3 class="heading-ter marginbottom-small">
                                Layanan Cepat
                            </h3>
                            <p class="paragraph">
                                Kami memahami betapa berharganya waktu Anda.
                                Oleh karena itu, kami berkomitmen untuk
                                memberikan layanan yang cepat dan efisien.
                            </p>
                        </div>
                    </div>
                    <div class="col-1-of-4">
                        <div class="feature-box">
                            <svg class="feature-box_icon">
                                <use
                                    xlink:href="{{ asset('images/Sprite.svg#icon-adjust') }}"
                                ></use>
                            </svg>
                            <h3 class="heading-ter marginbottom-small">
                                Konsultasi Gratis
                            </h3>
                            <p class="paragraph">
                                Tim ahli kami siap memberikan konsultasi gratis
                                untuk membantu Anda memahami kebutuhan motor
                                Anda.
                            </p>
                        </div>
                    </div>
                    <div class="col-1-of-4">
                        <div class="feature-box">
                            <svg class="feature-box_icon">
                                <use
                                    xlink:href="{{'images/Sprite.svg#icon-feather'}}"
                                ></use>
                            </svg>
                            <h3 class="heading-ter marginbottom-small">
                                Restorasi Sparepart
                            </h3>
                            <p class="paragraph">
                                Sparepart anda rusak? Tidak perlu ganti baru.
                                Kami akan membantu merestorasi sparepart motor
                                anda agar kembali seperti baru.
                            </p>
                        </div>
                    </div>
                    <div class="col-1-of-4">
                        <div class="feature-box">
                            <svg class="feature-box_icon">
                                <use
                                    xlink:href="{{'images/Sprite.svg#icon-heart-outlined'}}"
                                ></use>
                            </svg>
                            <h3 class="heading-ter marginbottom-small">
                                Pelayanan Ramah
                            </h3>
                            <p class="paragraph">
                                Kepuasan pelanggan adalah prioritas utama kami.
                                Tim kami selalu siap memberikan pelayanan yang
                                ramah dan profesional.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Tours card section -->
            <section class="section-tour" id="section-tour">
                <div class="center-uclass marginbottom-large">
                    <h2 class="section-heading">Layanan Kami</h2>
                </div>
                <div class="row">
                    <div class="col-1-of-3">
                        <div class="tourcards">
                            <div class="tourcards_side tourcards_side-front">
                                <div
                                    class="tourcards_picture tourcards_picture-2"
                                ></div>
                                <div class="tourcards_heading">
                                    <span
                                        class="tourcards_heading-span tourcards_heading-span--2"
                                        >Service Ringan</span
                                    >
                                </div>
                                <div class="tourcards_details">
                                    <p class="tourcards_details__text">
                                        Layanan service ringan untuk perawatan
                                        rutin motor Anda
                                    </p>
                                    <ul>
                                        <li>
                                            <svg
                                                class="tourcards_details__icon"
                                            >
                                                <use
                                                    xlink:href="{{'images/Sprite.svg#icon-adjust'}}"
                                                ></use>
                                            </svg>
                                            30 menit Service
                                        </li>
                                        <li>
                                            <svg
                                                class="tourcards_details__icon"
                                            >
                                                <use
                                                    xlink:href="{{'images/Sprite.svg#icon-add-user'}}"
                                                ></use></svg
                                            >Upto 4 jam
                                        </li>
                                        <li>
                                            <svg
                                                class="tourcards_details__icon"
                                            >
                                                <use
                                                    xlink:href="{{'images/Sprite.svg#icon-address'}}"
                                                ></use></svg
                                            >2 montir
                                        </li>
                                        <li>
                                            <svg
                                                class="tourcards_details__icon"
                                            >
                                                <use
                                                    xlink:href="{{'images/Sprite.svg#icon-warning'}}"
                                                ></use></svg
                                            >Service ringan
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div
                                class="tourcards_side tourcards_side-back tourcards_side-back--2"
                            >
                                <div class="tourcards_action">
                                    <div class="tourcards_action-price">
                                        <p class="tourcards_action-price--only">
                                            Only
                                        </p>
                                        <p
                                            class="tourcards_action-price--value"
                                        >
                                            <i>Rp 100K</i>
                                        </p>
                                    </div>
                                    <a
                                        href="#section-tour"
                                        class="button button-white button-white--basicorange"
                                        >Details!</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1-of-3">
                        <div class="tourcards">
                            <div class="tourcards_side tourcards_side-front">
                                <div
                                    class="tourcards_side tourcards_side-front"
                                >
                                    <div
                                        class="tourcards_picture tourcards_picture-1"
                                    ></div>
                                    <div class="tourcards_heading">
                                        <span
                                            class="tourcards_heading-span tourcards_heading-span--1"
                                            >Service Rutin</span
                                        >
                                    </div>
                                    <div class="tourcards_details">
                                        <p class="tourcards_details__text">
                                            Layanan service rutin untuk menjaga
                                            performa motor Anda tetap optimal
                                        </p>
                                        <ul>
                                            <li>
                                                <svg
                                                    class="tourcards_details__icon"
                                                >
                                                    <use
                                                        xlink:href="{{'images/Sprite.svg#icon-adjust'}}"
                                                    ></use></svg
                                                >1 Jam
                                            </li>
                                            <li>
                                                <svg
                                                    class="tourcards_details__icon"
                                                >
                                                    <use
                                                        xlink:href="{{'images/Sprite.svg#icon-add-user'}}"
                                                    ></use></svg
                                                >Upto 4 Jam
                                            </li>
                                            <li>
                                                <svg
                                                    class="tourcards_details__icon"
                                                >
                                                    <use
                                                        xlink:href="{{'images/Sprite.svg#icon-address'}}"
                                                    ></use></svg
                                                >3 Montir
                                            </li>
                                            <li>
                                                <svg
                                                    class="tourcards_details__icon"
                                                >
                                                    <use
                                                        xlink:href="{{'images/Sprite.svg#icon-warning'}}"
                                                    ></use></svg
                                                >Difficulty - Medium
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="tourcards_side tourcards_side-back tourcards_side-back--1"
                            >
                                <div class="tourcards_action">
                                    <div class="tourcards_action-price">
                                        <p class="tourcards_action-price--only">
                                            Hanya
                                        </p>
                                        <p
                                            class="tourcards_action-price--value"
                                        >
                                            <i>Rp 298K</i>
                                        </p>
                                    </div>
                                    <a
                                        href="#section-tour"
                                        class="button button-white button-white--basicgreen"
                                        >Details!</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1-of-3">
                        <div class="tourcards">
                            <div class="tourcards_side tourcards_side-front">
                                <div
                                    class="tourcards_side tourcards_side-front"
                                >
                                    <div
                                        class="tourcards_picture tourcards_picture-3"
                                    ></div>
                                    <div class="tourcards_heading">
                                        <span
                                            class="tourcards_heading-span tourcards_heading-span--3"
                                            >Service Berat</span
                                        >
                                    </div>
                                    <div class="tourcards_details">
                                        <p class="tourcards_details__text">
                                            Layanan service berat untuk
                                            perbaikan menyeluruh kendaraan Anda
                                        </p>
                                        <ul>
                                            <li>
                                                <svg
                                                    class="tourcards_details__icon"
                                                >
                                                    <use
                                                        xlink:href="{{'images/Sprite.svg#icon-adjust'}}"
                                                    ></use></svg
                                                >6 Hari
                                            </li>
                                            <li>
                                                <svg
                                                    class="tourcards_details__icon"
                                                >
                                                    <use
                                                        xlink:href="{{'images/Sprite.svg#icon-add-user'}}"
                                                    ></use></svg
                                                >Upto 8 hari
                                            </li>
                                            <li>
                                                <svg
                                                    class="tourcards_details__icon"
                                                >
                                                    <use
                                                        xlink:href="{{'images/Sprite.svg#icon-address'}}"
                                                    ></use></svg
                                                >5 Montir
                                            </li>
                                            <li>
                                                <svg
                                                    class="tourcards_details__icon"
                                                >
                                                    <use
                                                        xlink:href="{{'images/Sprite.svg#icon-warning'}}"
                                                    ></use></svg
                                                >Difficulty - Hard
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="tourcards_side tourcards_side-back tourcards_side-back--3"
                            >
                                <div class="tourcards_action">
                                    <div class="tourcards_action-price">
                                        <p class="tourcards_action-price--only">
                                            Hanya
                                        </p>
                                        <p
                                            class="tourcards_action-price--value"
                                        >
                                            <i>Rp 2000K</i>
                                        </p>
                                    </div>
                                    <a
                                        href="#section-tour"
                                        class="button button-white button-white--basicblue"
                                        >Details!</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="center-uclass u-margin-top-large">
                    <a href="#section-tour" class="button button-green"
                        >Semua Layanan</a
                    >
                </div>
            </section>
            <!-- Review section -->
            <section class="section-review" id="section-review">
                <!-- Applying bg video ver handly -->
                <div class="video">
                    <video class="video_content" autoplay muted loop>
                        <source src="video/Video.mp4" type="video/mp4" />
                        Your browser is not supported!
                    </video>
                </div>
                <div class="center-uclass marginbottom-large">
                    <h2 class="section-heading">Pelanggan kami yang puas</h2>
                </div>
                <div class="row">
                    <div class="review">
                        <figure class="review_figure">
                            <img
                                src="{{'images/Review.jpeg'}}"
                                alt="Tour reviewing person"
                                class="review_image"
                            />
                            <!-- Figcaption is used for giving caption to figures -->
                            <figcaption class="review_image-cap">
                                Dinesh Sharma
                            </figcaption>
                        </figure>
                        <div class="review_content">
                            <h3 class="heading-ter marginbottom-small">
                                One word: Awsome!
                            </h3>
                            <p>
                                "What an incredible experience we had with "Hill
                                Safari"! The trip was perfectly organized. The
                                trip was a dream come true. Every step led to a
                                new insights of the old world, and my brilliant
                                guide was always ready with his narration of the
                                history of the land and people. The 3-course
                                dining and camping were also very good. All in
                                all, this trip from "Hill Safari" was a MUST
                                DO."
                            </p>
                        </div>
                    </div>
                    <div class="review">
                        <figure class="review_figure">
                            <img
                                src="{{'images/Review-2.jpg'}}"
                                alt="Tour reviewing person"
                                class="review_image"
                            />
                            <!-- Figcaption is used for giving caption to figures -->
                            <figcaption class="review_image-cap">
                                Angela morgan
                            </figcaption>
                        </figure>
                        <div class="review_content">
                            <h3 class="heading-ter marginbottom-small">
                                Amazing!!!
                            </h3>
                            <p>
                                “We travel....a lot, and this was an epic
                                adventure! What we saw was amazing but even more
                                impressive was the logistics behind our travel.
                                Our trip was flawless. All the transportation
                                and local guides were on time and extremely
                                nice. Our main guides, Saurav and David were
                                very special people. Wonderfully knowledgeable
                                and went out of their way to make our trip
                                special.”
                            </p>
                        </div>
                    </div>
                </div>
                <div class="center-uclass">
                    <a href="#section-review" class="button button-green"
                        >Read more</a
                    >
                </div>
            </section>

            <!-- Detail section -->
            <section class="section-detail" id="section-detail">
                <div class="row">
                    <div class="detailbox">
                        <div class="detailbox_form">
                            <form action="/booking" class="form">
                                <div class="center-uclass marginbottom-medium">
                                    <h2 class="section-heading">
                                        Daftar Service Sekarang
                                    </h2>
                                </div>
                                <!-- Form contains div as group of input and label -->
                                <div class="form_group">
                                    <button class="button button-green">
                                        Daftar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Footer section -->
            <footer class="footer" id="footer">
                <div class="footer_logo-box">
                    <img src="{{'images/logo-only.png'}}" alt="logo" class="footer_logo" />
                </div>
                <div class="row">
                    <div class="col-1-of-2">
                        <div class="footer_navigation">
                            <ul class="footer_list">
                                <li class="footer_item">
                                    <a href="#" class="footer_link"
                                        >About company</a
                                    >
                                </li>
                                <li class="footer_item">
                                    <a href="#" class="footer_link">Carrers</a>
                                </li>
                                <li class="footer_item">
                                    <a href="#" class="footer_link">Terms</a>
                                </li>
                                <li class="footer_item">
                                    <a href="#" class="footer_link"
                                        >Privacy policy</a
                                    >
                                </li>
                                <li class="footer_item">
                                    <a href="#" class="footer_link"
                                        >Contact us</a
                                    >
                                </li>
                                <br /><br />
                                <li class="footer_item">
                                    <a
                                        href="https://www.facebook.com/shivay.bhatt"
                                        class="footer_link"
                                        >Facebook<img
                                            src="{{ asset('images/facebook.png') }}"
                                            class="footer_link-image"
                                    /></a>
                                </li>
                                <li class="footer_item">
                                    <a
                                        href="https://www.linkedin.com/in/deepak-bhatt-b7959817b/"  
                                        href="https://www.linkedin.com/in/deepak-bhatt-b7959817b/"
                                        class="footer_link"
                                        >Linkdin<img
                                            src="{{ asset('images/linkedin.png') }}"
                                            class="footer_link-image"
                                    /></a>
                                </li>
                                <li class="footer_item">
                                    <a
                                        href="https://github.com/deathook007"
                                        class="footer_link"
                                        >Github<img
                                            src="{{ asset('images/github.png') }}"
                                            class="footer_link-image"
                                    /></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-1-of-2">
                        <p class="footer_copyright">
                            <a href="#" class="footer_link">
                                Copyright &copy; 2025 by Okta Widya</a
                            >. UNDER PRODUCTION
                        </p>
                    </div>
                </div>
            </footer>
            <div class="popup" id="popup">
                <div class="popup-content">
                    <div class="center-uclass marginbottom-small">
                        <h2 class="section-heading">
                            Kadek Motor Bengkel Service Motor Terpercaya
                        </h2>
                    </div>
                    <div class="row">
                        <div class="col-1-of-2">
                            <h2 class="heading-ter marginbottom-small">
                                Mengapa Memilih Kadek Motor?
                            </h2>
                            <p class="paragraph">
                                Kadek Motor telah beroperasi selama lebih dari
                                10 tahun, melayani ribuan pelanggan dengan
                                dedikasi dan profesionalisme. Kami memiliki
                                mekanik berpengalaman yang ahli dalam berbagai
                                jenis motor, serta fasilitas bengkel yang
                                lengkap dan modern. Kami juga menggunakan suku
                                cadang berkualitas tinggi untuk memastikan motor
                                Anda mendapatkan perawatan terbaik.
                            </p>
                            <a href="/booking" class="button button-green"
                                >Daftar Service</a
                            >
                        </div>
                        <div class="col-1-of-2">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55511.22544601733!2d80.19588168700781!3d29.590555892370972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39a125c00088dd51%3A0x2b781d30a1523c63!2sPithoragarh%2C%20Uttarakhand!5e0!3m2!1sen!2sin!4v1594240419874!5m2!1sen!2sin"
                                class="map"
                                width="400"
                                height="350"
                                frameborder="0"
                                style="border: 0"
                                allowfullscreen=""
                                aria-hidden="false"
                                tabindex="0"
                                class="map"
                            ></iframe>
                        </div>
                    </div>
                    <a href="#section-about" class="popup-close">&times;</a>
                    <!-- Croos sign by &times; -->
                </div>
            </div>
        </main>
    </body>
<script>
    const checkbox = document.getElementById("navigate");
    const links = document.querySelectorAll(".navigation_link");

    links.forEach(link => {
        link.addEventListener("click", () => {
            checkbox.checked = false;
        });
    });
</script>
</html>
