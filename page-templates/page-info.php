<?php

/**
 * Template Name: Info
 */

get_header();

?>

<style>
    :root {
        --info-primary: #005a5aff;
        --info-secondary: #f2f0ef;
    }
</style>


<section class="min-h-screen bg-[--info-secondary] flex items-center justify-center">
    <div class="relative w-full max-w-[530px] rounded-[44px] bg-[--info-secondary] text-white overflow-hidden">
        <!-- Content -->
        <section class="relative z-10 p-6 flex h-full flex-col items-center text-center gap-y-6 sm:gap-y-12">
            <div class="space-y-2">

                <img class="inline-block w-full rounded-xl object-contain object-center -mb-16" src="https://culturecafe.logix360.studio/wp-content/uploads/2025/05/culture-cafe-logix360studio.webp" alt="Photo" />

                <!-- Photo -->
                <div class="brand-logo inline-block rounded-full p-3"
                    style="background-color: <?php echo esc_attr($logo_background_color); ?>;">
                    <img class="inline-block sm:h-[140px] h-[100px] w-[100px] sm:w-[140px] rounded-full object-contain object-center"
                        src="https://culturecafe.logix360.studio/wp-content/uploads/2025/07/culture-cafe-logo-by-logix360-studio.webp" alt="Photo" />
                </div>
                <!-- Title & tagline -->
                <h1 class="text-xl sm:text-3xl font-medium tracking-tight text-[--info-primary]">Culture Cafe</h1>
                <p class="text-base sm:text-xl text-[--info-primary] opacity-80">Your daily dose of cozy</p>
            </div>

            <!-- Menu buttons -->
            <nav class="w-full space-y-3 sm:space-y-5">
                <!-- <a href="#" class="block w-full rounded-full py-4 sm:py-5 text-base sm:text-xl font-medium bg-[--info-primary] text-white shadow-sm ring-1 ring-[--info-primary] transition hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-white/60">Our drinks</a>
                <a href="#" class="block w-full rounded-full py-4 sm:py-5 text-base sm:text-xl font-medium bg-white/70 text-[--info-primary] shadow-sm ring-1 ring-[--info-primary] transition hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-white/60">Find us</a>
                <a href="#" class="block w-full rounded-full py-4 sm:py-5 text-base sm:text-xl font-medium bg-white/70 text-[--info-primary] shadow-sm ring-1 ring-[--info-primary] transition hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-white/60">Wellbeings</a>
                <a href="#" class="block w-full rounded-full py-4 sm:py-5 text-base sm:text-xl font-medium bg-white/70 text-[--info-primary] shadow-sm ring-1 ring-[--info-primary] transition hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-white/60">Our latest Podcast</a> -->

                <a href="https://culturecafe.logix360.studio/en/" class="block w-full rounded-full py-4 sm:py-5 text-base sm:text-xl font-medium bg-white/70 text-[--info-primary] shadow-sm ring-1 ring-[--info-primary] transition hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-white/60">English</a>
                <a href="https://culturecafe.logix360.studio/ar/" class="block w-full rounded-full py-4 sm:py-5 text-base sm:text-xl font-medium bg-white/70 text-[--info-primary] shadow-sm ring-1 ring-[--info-primary] transition hover:bg-white/80 focus:outline-none focus:ring-2 focus:ring-white/60">عربي</a>
            </nav>

            <!-- Social icons -->
            <div class="flex items-center gap-4 sm:gap-6">
                <!-- Instagram -->
                <a href="https://www.instagram.com/culturecafe.sa" aria-label="Instagram" class="p-2 rounded-full ring-2 ring-[--info-primary] hover:bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="h-6 w-6 fill-[--info-primary]" viewBox="0 0 32 32" id="Camada_1" version="1.1" xml:space="preserve">
                        <g>
                            <path d="M22.3,8.4c-0.8,0-1.4,0.6-1.4,1.4c0,0.8,0.6,1.4,1.4,1.4c0.8,0,1.4-0.6,1.4-1.4C23.7,9,23.1,8.4,22.3,8.4z" />
                            <path d="M16,10.2c-3.3,0-5.9,2.7-5.9,5.9s2.7,5.9,5.9,5.9s5.9-2.7,5.9-5.9S19.3,10.2,16,10.2z M16,19.9c-2.1,0-3.8-1.7-3.8-3.8   c0-2.1,1.7-3.8,3.8-3.8c2.1,0,3.8,1.7,3.8,3.8C19.8,18.2,18.1,19.9,16,19.9z" />
                            <path d="M20.8,4h-9.5C7.2,4,4,7.2,4,11.2v9.5c0,4,3.2,7.2,7.2,7.2h9.5c4,0,7.2-3.2,7.2-7.2v-9.5C28,7.2,24.8,4,20.8,4z M25.7,20.8   c0,2.7-2.2,5-5,5h-9.5c-2.7,0-5-2.2-5-5v-9.5c0-2.7,2.2-5,5-5h9.5c2.7,0,5,2.2,5,5V20.8z" />
                        </g>
                    </svg>
                </a>
                <!-- Tiktok -->
                <a href="https://www.tiktok.com/@culturecafe_ksa" aria-label="Spotify" class="p-2 rounded-full ring-2 ring-[--info-primary] hover:bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-[--info-primary]" viewBox="0 0 32 32" version="1.1"> <path d="M16.656 1.029c1.637-0.025 3.262-0.012 4.886-0.025 0.054 2.031 0.878 3.859 2.189 5.213l-0.002-0.002c1.411 1.271 3.247 2.095 5.271 2.235l0.028 0.002v5.036c-1.912-0.048-3.71-0.489-5.331-1.247l0.082 0.034c-0.784-0.377-1.447-0.764-2.077-1.196l0.052 0.034c-0.012 3.649 0.012 7.298-0.025 10.934-0.103 1.853-0.719 3.543-1.707 4.954l0.020-0.031c-1.652 2.366-4.328 3.919-7.371 4.011l-0.014 0c-0.123 0.006-0.268 0.009-0.414 0.009-1.73 0-3.347-0.482-4.725-1.319l0.040 0.023c-2.508-1.509-4.238-4.091-4.558-7.094l-0.004-0.041c-0.025-0.625-0.037-1.25-0.012-1.862 0.49-4.779 4.494-8.476 9.361-8.476 0.547 0 1.083 0.047 1.604 0.136l-0.056-0.008c0.025 1.849-0.050 3.699-0.050 5.548-0.423-0.153-0.911-0.242-1.42-0.242-1.868 0-3.457 1.194-4.045 2.861l-0.009 0.030c-0.133 0.427-0.21 0.918-0.21 1.426 0 0.206 0.013 0.41 0.037 0.61l-0.002-0.024c0.332 2.046 2.086 3.59 4.201 3.59 0.061 0 0.121-0.001 0.181-0.004l-0.009 0c1.463-0.044 2.733-0.831 3.451-1.994l0.010-0.018c0.267-0.372 0.45-0.822 0.511-1.311l0.001-0.014c0.125-2.237 0.075-4.461 0.087-6.698 0.012-5.036-0.012-10.060 0.025-15.083z"></path> </svg>
                </a>
                <!-- YouTube -->
                <!-- <a href="#" aria-label="YouTube" class="p-2 rounded-full ring-2 ring-[--info-primary] hover:bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-6 w-6 fill-[--info-primary]">
                        <path d="M57.4 22.3a7.8 7.8 0 0 0-5.5-5.5C47.9 15.5 32 15.5 32 15.5s-15.9 0-19.9 1.3a7.8 7.8 0 0 0-5.5 5.5C5.3 26.3 5.3 32 5.3 32s0 5.7 1.3 9.7c.7 2.3 2.5 4 4.8 4.8 4 1.3 19.9 1.3 19.9 1.3s15.9 0 19.9-1.3c2.3-.7 4-2.5 4.8-4.8C58.7 37.7 58.7 32 58.7 32s0-5.7-1.3-9.7zM27.7 38.7V25.3L40.7 32l-13 6.7z" />
                    </svg>
                </a> -->
            </div>
        </section>
    </div>
</section>

<div class="bg-black">
    <a href="https://logix360.studio" class="justify-center flex items-center"
        style="direction: ltr;">
        <span class="text-xs leading-6 text-gray-100">Designed by&nbsp;&nbsp;</span>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="h-[12px]"
            viewBox="0 0 934 158">
            <defs>
                <clipPath id="clip-Web_1920_1">
                    <rect width="934" height="158" />
                </clipPath>
            </defs>
            <g id="Web_1920_1" data-name="Web 1920 – 1" clip-path="url(#clip-Web_1920_1)">
                <path id="Path_3" data-name="Path 3"
                    d="M14.28,0H121.17V-27.72H42.84V-147H14.28Zm102.9-73.5c0,48.3,33.81,75.6,76.23,75.6,43.47,0,77.07-27.3,77.07-75.6,0-50.61-33.6-75.6-77.07-75.6C150.99-149.1,117.18-122.01,117.18-73.5Zm28.56,0c0-32.76,20.79-48.93,47.67-48.93,27.72,0,48.72,16.17,48.72,48.93s-21,48.72-48.72,48.72C166.53-24.78,145.74-40.74,145.74-73.5ZM404.46-22.05,403.41,0h26.46V-78.33H351.75v20.58h52.08c-2.1,17.85-20.37,36.33-47.04,36.33-32.55,0-48.93-22.68-48.93-52.08,0-28.56,19.74-50.61,49.14-50.61,22.47,0,36.96,10.5,42.42,27.3h30.03c-7.14-36.75-32.55-52.29-72.66-52.29-46.83,0-76.44,29.4-76.44,75.6,0,45.99,26.67,75.6,73.5,75.6,33.39,0,46.2-16.17,49.56-24.15ZM448.56,0h28.35V-147H448.56Zm69.93-147H488.04l47.67,70.56v.42L483.21,0h31.92l35.49-54.6h.84L587.58,0h30.87Zm58.17,57.96L613.83-147H583.8l-22.26,36.33Z"
                    transform="translate(-10 153)" fill="#fff" />
                <path id="Path_4" data-name="Path 4"
                    d="M15.54-47.88a48.467,48.467,0,0,0,2.415,18.165,36.336,36.336,0,0,0,8.3,13.65,37.006,37.006,0,0,0,13.44,8.61A50.368,50.368,0,0,0,57.75-4.41,52.885,52.885,0,0,0,73.29-6.72a40.749,40.749,0,0,0,13.335-6.825,33.617,33.617,0,0,0,9.24-11.235A32.97,32.97,0,0,0,99.33-40.11q0-10.29-4.2-17.115A29.419,29.419,0,0,0,84-67.83a46.187,46.187,0,0,0-15.645-5.04A83.2,83.2,0,0,0,50.61-73.5v-6.93a82.634,82.634,0,0,0,16.065-.735,44.067,44.067,0,0,0,14.6-4.62A29.01,29.01,0,0,0,91.875-95.34q4.095-6.09,4.095-15.54A24.863,24.863,0,0,0,92.5-124.11a28.475,28.475,0,0,0-9.03-9.24,42.855,42.855,0,0,0-12.39-5.355A52.587,52.587,0,0,0,57.75-140.49a40.782,40.782,0,0,0-16.59,3.15A33.079,33.079,0,0,0,29.3-128.73a38,38,0,0,0-7.245,13.02,61.3,61.3,0,0,0-2.94,16.59H11.13a56.925,56.925,0,0,1,3.255-19.635A42.564,42.564,0,0,1,23.73-133.98a43.146,43.146,0,0,1,14.7-9.87,50.011,50.011,0,0,1,19.32-3.57,69.466,69.466,0,0,1,17.115,2.1,45.246,45.246,0,0,1,14.7,6.51,34.406,34.406,0,0,1,10.4,11.34,32.708,32.708,0,0,1,3.99,16.59,36.439,36.439,0,0,1-2,12.18A31.292,31.292,0,0,1,96.18-88.62a31.46,31.46,0,0,1-9.03,7.245A33.364,33.364,0,0,1,75.6-77.7v.42a36.523,36.523,0,0,1,13.23,3.99,33.144,33.144,0,0,1,9.975,8.085,35.851,35.851,0,0,1,6.3,11.34,41.975,41.975,0,0,1,2.2,13.755,41.3,41.3,0,0,1-3.99,18.69A39.241,39.241,0,0,1,92.61-8.085,45.211,45.211,0,0,1,76.86-.105,68.134,68.134,0,0,1,57.75,2.52,64.617,64.617,0,0,1,36.225-.84a43.726,43.726,0,0,1-16.17-9.765,39.722,39.722,0,0,1-9.87-15.75A56.348,56.348,0,0,1,7.56-47.88ZM167.58,2.52q-15.12,0-25.095-5.67A44.155,44.155,0,0,1,126.63-18.165a63.049,63.049,0,0,1-8.295-21.63A132.009,132.009,0,0,1,115.92-65.31q0-8.82.84-18.375a126.9,126.9,0,0,1,3.045-18.69A93.685,93.685,0,0,1,125.79-119.7a51.685,51.685,0,0,1,9.765-14.385,43.542,43.542,0,0,1,14.28-9.765,48.836,48.836,0,0,1,19.425-3.57q18.48,0,30.345,9.87T213.57-109.2h-7.98a42.043,42.043,0,0,0-4.41-12.705,35.258,35.258,0,0,0-7.875-9.87,35.675,35.675,0,0,0-10.815-6.4,37,37,0,0,0-13.23-2.31q-14.91,0-23.94,7.77A50.208,50.208,0,0,0,131.565-113.5a90.423,90.423,0,0,0-6.2,24.57A215.82,215.82,0,0,0,123.9-65.1l.42.42a43.4,43.4,0,0,1,6.72-12.705,48.054,48.054,0,0,1,10.08-9.87,44.979,44.979,0,0,1,12.39-6.3,44.839,44.839,0,0,1,14.07-2.205,49.843,49.843,0,0,1,19.635,3.78,46.074,46.074,0,0,1,15.33,10.395A47.116,47.116,0,0,1,212.52-65.94a53.225,53.225,0,0,1,3.57,19.74,50.524,50.524,0,0,1-3.675,19.425,47.56,47.56,0,0,1-10.08,15.435,45.555,45.555,0,0,1-15.33,10.185A50.524,50.524,0,0,1,167.58,2.52ZM126.63-46.2a42.271,42.271,0,0,0,3.255,16.7,42.241,42.241,0,0,0,8.715,13.23A39.316,39.316,0,0,0,151.515-7.56,40.847,40.847,0,0,0,167.58-4.41a38.431,38.431,0,0,0,16.17-3.36,41.626,41.626,0,0,0,12.81-9.03,40.885,40.885,0,0,0,8.505-13.23A42.87,42.87,0,0,0,208.11-46.2a43.93,43.93,0,0,0-3.045-16.17,43.787,43.787,0,0,0-8.4-13.65,39.821,39.821,0,0,0-12.81-9.345A38.135,38.135,0,0,0,167.58-88.83,39.662,39.662,0,0,0,151.1-85.47a40.444,40.444,0,0,0-12.915,9.135,41.559,41.559,0,0,0-8.5,13.545A45.058,45.058,0,0,0,126.63-46.2ZM272.58,2.52q-15.75,0-25.83-6.825a50.524,50.524,0,0,1-16.065-17.64A76.414,76.414,0,0,1,222.39-46.1a154.189,154.189,0,0,1-2.31-26.355,154.189,154.189,0,0,1,2.31-26.355,76.414,76.414,0,0,1,8.295-24.15A50.524,50.524,0,0,1,246.75-140.6q10.08-6.825,25.83-6.825t25.83,6.825a50.524,50.524,0,0,1,16.065,17.64,76.414,76.414,0,0,1,8.3,24.15,154.191,154.191,0,0,1,2.31,26.355A154.191,154.191,0,0,1,322.77-46.1a76.415,76.415,0,0,1-8.3,24.15A50.524,50.524,0,0,1,298.41-4.305Q288.33,2.52,272.58,2.52Zm0-6.93q13.44,0,22.155-6.51a45.135,45.135,0,0,0,13.65-16.59,77.224,77.224,0,0,0,6.825-22.05,146.887,146.887,0,0,0,1.89-22.89,146.887,146.887,0,0,0-1.89-22.89,77.224,77.224,0,0,0-6.825-22.05,45.135,45.135,0,0,0-13.65-16.59q-8.715-6.51-22.155-6.51-13.65,0-22.26,6.51a45.564,45.564,0,0,0-13.545,16.59,77.225,77.225,0,0,0-6.825,22.05,146.889,146.889,0,0,0-1.89,22.89,146.889,146.889,0,0,0,1.89,22.89,77.225,77.225,0,0,0,6.825,22.05A45.564,45.564,0,0,0,250.32-10.92Q258.93-4.41,272.58-4.41Z"
                    transform="translate(605 152)" fill="#fff" />
                <path id="Path_5" data-name="Path 5" d="M603.848,6l-30.076-.017-22.25,36.344,15.145,21.658Z"
                    fill="#ff611a" stroke="#ff611a" stroke-width="0.1" />
            </g>
        </svg>
    </a>
</div>


<?php
get_footer();
