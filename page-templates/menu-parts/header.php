<?php

$background_image = get_field('background_image', 'option'); // e.g., URL
$brand_logo = get_field('logo', 'option');
$brand_name = get_field('name', 'option');
$hide_name = get_field('hide_name', 'option');
$logo_round = get_field('logo_round', 'option');
$logo_background_color = get_field('logo_background_color', 'option');
$name = $brand_name;

// CATEGORIZED
$categorized = get_field('use_category_name_and_logo', 'option');
$add_back_button = get_field('add_back_button', 'option');

// Category Meta
$page_title = get_field('page_title');
$page_profile_picture = get_field('page_profile_picture');

$isCategoryPage = is_page_template('page-templates/page-category.php');

// Header New Style
$phone = get_field('phone', 'option');
$use_whatsapp = get_field('use_whatsapp', 'option');
$whatsapp__number = get_field('whatsapp__number', 'option');
$address_link = get_field('address_link', 'option');
$instagramOnly = get_field('social_media_channels', 'option');
$feedback_form_id = get_field('feedback_form_ID', 'option');
$show_most_used_buttons_in_header = get_field('show_most_used_buttons_in_header', 'option');
$remove_header_cover_gredients = get_field('remove_header_cover_gredients', 'option');
$title_color = get_field('title_color', 'option');


?>

<div class="restaurant-details relative isolate overflow-hidden bg-[#000000] pt-2 pb-8 sm:pb-10 sm:pt-4"
    style="background-image: url('<?php echo esc_url($background_image); ?>')">

    <?php if (!$remove_header_cover_gredients): ?>
        <div class="overlay-background-dark z-30 bg-black/65"></div>
    <?php endif; ?>

    <div class="flex justify-between relative z-[999] h-full items-end mx-auto max-w-2xl lg:max-w-4xl">
        <div class="restaurant-details-inner mx-auto max-w-2xl lg:max-w-4xl z-50 px-3 sm:px-2">

            <div class="flex flex-row items-center rtl:flex-row-reverse <?php echo ($isCategoryPage) ? "!justify-end" : "" ?> <?php echo ($categorized || $add_back_button) ? "justify-between" : "justify-end" ?>">
                <?php if (!$isCategoryPage) { ?>
                    <?php if ($categorized || $add_back_button) { ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <div class="flex flex-row rtl:flex-row-reverse justify-center items-center border border-gray-900 w-8 sm:w-10 h-8 sm:h-10 rounded-full  bg-gray-900 text-sm hover:opacity-60 items-center gap-2 font-medium text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.5" stroke="currentColor" class="size-4 sm:size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                </svg>
                            </div>
                        </a>
                    <?php } ?>
                <?php } ?>

                <div class="flex flex-row rtl:flex-row-reverse justify-end items-center gap-2 sm:gap-3">

                    <!-- Phone -->
                    <?php if ($show_most_used_buttons_in_header): ?>
                        <?php if (!$use_whatsapp): ?>
                            <a href="tel:<?php echo esc_attr($phone); ?>" class="quick-access-phone">
                                <div
                                    class="flex justify-center items-center font-medium text-sm w-8 sm:w-10 h-8 sm:h-10 rounded-full bg-white hover:bg-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-4 sm:size-6">
                                        <path fill-rule="evenodd"
                                            d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </a>
                        <?php elseif ($use_whatsapp): ?>
                            <a href="https://wa.me/<?php echo esc_attr($whatsapp__number) ?>" class="quick-access-whatsapp">
                                <div
                                    class="flex justify-center items-center font-medium text-sm w-8 sm:w-10 h-8 sm:h-10 rounded-xl bg-[#25D366] hover:opacity-70">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="size-4 sm:size-5" viewBox="0 0 360 362" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M307.546 52.5655C273.709 18.685 228.706 0.0171895 180.756 0C81.951 0 1.53846 80.404 1.50408 179.235C1.48689 210.829 9.74646 241.667 25.4319 268.844L0 361.736L95.0236 336.811C121.203 351.096 150.683 358.616 180.679 358.625H180.756C279.544 358.625 359.966 278.212 360 179.381C360.017 131.483 341.392 86.4547 307.546 52.5741V52.5655ZM180.756 328.354H180.696C153.966 328.346 127.744 321.16 104.865 307.589L99.4242 304.358L43.034 319.149L58.0834 264.168L54.5423 258.53C39.6304 234.809 31.749 207.391 31.7662 179.244C31.8006 97.1036 98.6334 30.2707 180.817 30.2707C220.61 30.2879 258.015 45.8015 286.145 73.9665C314.276 102.123 329.755 139.562 329.738 179.364C329.703 261.513 262.871 328.346 180.756 328.346V328.354ZM262.475 216.777C257.997 214.534 235.978 203.704 231.869 202.209C227.761 200.713 224.779 199.966 221.796 204.452C218.814 208.939 210.228 219.029 207.615 222.011C205.002 225.002 202.389 225.372 197.911 223.128C193.434 220.885 179.003 216.158 161.891 200.902C148.578 189.024 139.587 174.362 136.975 169.875C134.362 165.389 136.7 162.965 138.934 160.739C140.945 158.728 143.412 155.505 145.655 152.892C147.899 150.279 148.638 148.406 150.133 145.423C151.629 142.432 150.881 139.82 149.764 137.576C148.646 135.333 139.691 113.287 135.952 104.323C132.316 95.5909 128.621 96.777 125.879 96.6309C123.266 96.5019 120.284 96.4762 117.293 96.4762C114.302 96.4762 109.454 97.5935 105.346 102.08C101.238 106.566 89.6691 117.404 89.6691 139.441C89.6691 161.478 105.716 182.785 107.959 185.776C110.202 188.767 139.544 234.001 184.469 253.408C195.153 258.023 203.498 260.782 210.004 262.845C220.731 266.257 230.494 265.776 238.212 264.624C246.816 263.335 264.71 253.786 268.44 243.326C272.17 232.866 272.17 223.893 271.053 222.028C269.936 220.163 266.945 219.037 262.467 216.794L262.475 216.777Z" fill="#25D366" />
                                    </svg> -->
                                    <svg class="size-5 sm:size-6" viewBox="0 0 360 362" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M307.546 52.5655C273.709 18.685 228.706 0.0171895 180.756 0C81.951 0 1.53846 80.404 1.50408 179.235C1.48689 210.829 9.74646 241.667 25.4319 268.844L0 361.736L95.0236 336.811C121.203 351.096 150.683 358.616 180.679 358.625H180.756C279.544 358.625 359.966 278.212 360 179.381C360.017 131.483 341.392 86.4547 307.546 52.5741V52.5655ZM180.756 328.354H180.696C153.966 328.346 127.744 321.16 104.865 307.589L99.4242 304.358L43.034 319.149L58.0834 264.168L54.5423 258.53C39.6304 234.809 31.749 207.391 31.7662 179.244C31.8006 97.1036 98.6334 30.2707 180.817 30.2707C220.61 30.2879 258.015 45.8015 286.145 73.9665C314.276 102.123 329.755 139.562 329.738 179.364C329.703 261.513 262.871 328.346 180.756 328.346V328.354ZM262.475 216.777C257.997 214.534 235.978 203.704 231.869 202.209C227.761 200.713 224.779 199.966 221.796 204.452C218.814 208.939 210.228 219.029 207.615 222.011C205.002 225.002 202.389 225.372 197.911 223.128C193.434 220.885 179.003 216.158 161.891 200.902C148.578 189.024 139.587 174.362 136.975 169.875C134.362 165.389 136.7 162.965 138.934 160.739C140.945 158.728 143.412 155.505 145.655 152.892C147.899 150.279 148.638 148.406 150.133 145.423C151.629 142.432 150.881 139.82 149.764 137.576C148.646 135.333 139.691 113.287 135.952 104.323C132.316 95.5909 128.621 96.777 125.879 96.6309C123.266 96.5019 120.284 96.4762 117.293 96.4762C114.302 96.4762 109.454 97.5935 105.346 102.08C101.238 106.566 89.6691 117.404 89.6691 139.441C89.6691 161.478 105.716 182.785 107.959 185.776C110.202 188.767 139.544 234.001 184.469 253.408C195.153 258.023 203.498 260.782 210.004 262.845C220.731 266.257 230.494 265.776 238.212 264.624C246.816 263.335 264.71 253.786 268.44 243.326C272.17 232.866 272.17 223.893 271.053 222.028C269.936 220.163 266.945 219.037 262.467 216.794L262.475 216.777Z" fill="white"/>
                                    </svg>
                                </div>
                            </a>
                        <?php endif; ?>
                        <!-- Address Direction -->
                        <a href="<?php echo esc_url($address_link); ?>" target="_blank" class="quick-access-address">
                            <div
                                class="flex justify-center items-center font-medium text-sm w-8 sm:w-10 h-8 sm:h-10 rounded-xl bg-white hover:opacity-70">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 sm:size-5">
                                    <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                                </svg> -->

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 92.3 132.3" class="size-5 sm:size-6">
                                    <path fill="#1a73e8" d="M60.2 2.2C55.8.8 51 0 46.1 0 32 0 19.3 6.4 10.8 16.5l21.8 18.3L60.2 2.2z" />
                                    <path fill="#ea4335" d="M10.8 16.5C4.1 24.5 0 34.9 0 46.1c0 8.7 1.7 15.7 4.6 22l28-33.3-21.8-18.3z" />
                                    <path fill="#4285f4" d="M46.2 28.5c9.8 0 17.7 7.9 17.7 17.7 0 4.3-1.6 8.3-4.2 11.4 0 0 13.9-16.6 27.5-32.7-5.6-10.8-15.3-19-27-22.7L32.6 34.8c3.3-3.8 8.1-6.3 13.6-6.3" />
                                    <path fill="#fbbc04" d="M46.2 63.8c-9.8 0-17.7-7.9-17.7-17.7 0-4.3 1.5-8.3 4.1-11.3l-28 33.3c4.8 10.6 12.8 19.2 21 29.9l34.1-40.5c-3.3 3.9-8.1 6.3-13.5 6.3" />
                                    <path fill="#34a853" d="M59.1 109.2c15.4-24.1 33.3-35 33.3-63 0-7.7-1.9-14.9-5.2-21.3L25.6 98c2.6 3.4 5.3 7.3 7.9 11.3 9.4 14.5 6.8 23.1 12.8 23.1s3.4-8.7 12.8-23.2" />
                                </svg>

                                <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 5644.173 5644.173" class="size-4 sm:size-5">
                                    <defs>
                                        <path id="a" d="M4300.322 0c-439.439 0-829.828 210.985-1075.081 537.54H403.155C181.42 537.54 0 718.96 0 940.695v4300.322c0 221.736 181.42 403.155 403.155 403.155h4300.322c221.735 0 403.155-181.419 403.155-403.155V2609.086c282.208-412.562 537.54-784.137 537.54-1265.235C5644.173 601.373 5042.8 0 4300.322 0z" />
                                        <path id="m" fill="#DB4437" d="M4300.322 0c-742.478 0-1343.851 601.373-1343.851 1343.851 0 1012.591 1130.85 1540.053 1264.563 2985.364 4.031 40.315 38.3 71.896 79.287 71.896s75.927-31.581 79.287-71.896c133.713-1445.312 1264.563-1972.773 1264.563-2985.364C5644.173 601.373 5042.8 0 4300.322 0z" />
                                        <clipPath id="c">
                                            <use overflow="visible" style="transform:scaleX(1.6) translateX(-31.5%)" xlink:href="#a" />
                                        </clipPath>
                                        <filter id="b" width="280%" height="280%" x="-70%" y="-70%">
                                            <feGaussianBlur in="SourceAlpha" stdDeviation="600" />
                                            <feComponentTransfer>
                                                <feFuncA exponent=".7" type="gamma" />
                                            </feComponentTransfer>
                                            <feOffset dx="300" dy="100" />
                                        </filter>
                                    </defs>
                                    <path fill="#0F9D58" d="M2553.316 3090.856l2268.569-2535.46c-37.479-11.6-77.248-17.856-118.408-17.856H403.155C181.42 537.54 0 718.96 0 940.695v4300.322c0 41.16 6.257 80.929 17.856 118.408l2535.46-2268.569z" />
                                    <path fill="#4285F4" d="M2553.316 3090.856L284.747 5626.316c37.479 11.6 77.248 17.856 118.408 17.856h4300.322c41.16 0 80.929-6.256 118.408-17.856l-2268.569-2535.46z" />
                                    <path fill="#D2D2D2" d="M2553.316 3090.856l2535.46 2268.569c11.6-37.479 17.856-77.248 17.856-118.408V940.695c0-41.16-6.257-80.929-17.856-118.408l-2535.46 2268.569z" />
                                    <path fill="#F1F1F1" d="M5106.633 5241.018L2687.701 2822.086l-470.348 403.155 2418.931 2418.931h67.192c221.737.001 403.157-181.419 403.157-403.154z" />
                                    <path fill="#FFDE48" d="M4703.478 537.54L0 5241.018c0 221.736 181.42 403.155 403.155 403.155h67.193l4636.285-4636.285v-67.193c0-221.735-181.42-403.155-403.155-403.155z" />
                                    <path fill="#FFF" fill-opacity=".2" d="M4703.478 537.54H403.155C181.42 537.54 0 718.96 0 940.695v33.596c0-221.735 181.42-403.155 403.155-403.155h4300.322c221.735 0 403.155 181.42 403.155 403.155v-33.596c.001-221.735-181.419-403.155-403.154-403.155z" />
                                    <path fill="#263238" fill-opacity=".1" d="M4703.478 5610.577H403.155C181.42 5610.577 0 5429.157 0 5207.421v33.596c0 221.736 181.42 403.155 403.155 403.155h4300.322c221.735 0 403.155-181.419 403.155-403.155v-33.596c.001 221.736-181.419 403.156-403.154 403.156z" />
                                    <path fill="#EEE" d="M1142.273 1545.428v286.24h397.78c-31.581 169.997-180.748 293.631-397.78 293.631-241.221 0-437.423-204.265-437.423-444.814s196.202-444.814 437.423-444.814c108.852 0 205.609 37.628 282.881 110.196l211.657-211.656c-128.338-120.275-294.975-193.515-494.537-193.515-408.531 0-739.118 330.587-739.118 739.118s330.587 739.118 739.118 739.118c426.672 0 709.553-300.351 709.553-722.32 0-52.41-4.703-102.805-13.438-151.183h-696.116z" />
                                    <use clip-path="url(#c)" filter="url(#b)" opacity=".25" style="transform:scaleX(.625) translateX(50.4%)" xlink:href="#m" />
                                    <use xlink:href="#m" />
                                    <circle cx="4300.322" cy="1343.851" r="470.348" fill="#7B231E" />
                                    <path fill="#FFF" fill-opacity=".2" d="M4300.322 33.596c735.758 0 1333.1 591.294 1343.179 1324.365 0-4.703.672-9.407.672-14.11C5644.173 601.373 5042.8 0 4300.322 0s-1343.85 601.373-1343.85 1343.851c0 4.703.672 9.407.672 14.11 10.078-733.07 607.42-1324.365 1343.178-1324.365z" />
                                    <path fill="#3E2723" fill-opacity=".2" d="M4379.609 4295.619c-3.36 40.315-38.3 71.896-79.287 71.896s-75.927-31.581-79.287-71.896C4088.666 2857.027 2967.894 2327.55 2957.144 1324.365c0 6.719-.672 12.767-.672 19.486 0 1012.591 1130.85 1540.053 1264.564 2985.364 4.031 40.315 38.3 71.896 79.287 71.896s75.927-31.581 79.287-71.896c133.712-1445.312 1264.563-1972.773 1264.563-2985.364 0-6.719-.672-12.767-.672-19.486-10.751 1003.184-1130.851 1533.333-1263.892 2971.254z" />
                                    <radialGradient id="r" cx="140.0966" cy="5533.9414" r="6883.6064" gradientTransform="matrix(1 0 0 -1 0 6182.7524)" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#fff" stop-opacity=".1" />
                                        <stop offset="1" stop-color="#fff" stop-opacity="0" />
                                    </radialGradient>
                                    <path fill="url(#r)" d="M4300.322 0c-439.439 0-829.828 210.985-1075.081 537.54H403.155C181.42 537.54 0 718.96 0 940.695v4300.322c0 221.736 181.42 403.155 403.155 403.155h4300.322c221.735 0 403.155-181.419 403.155-403.155V2609.086c282.208-412.562 537.54-784.137 537.54-1265.235C5644.173 601.373 5042.8 0 4300.322 0z" />
                                </svg> -->

                            </div>
                        </a>
                        <!-- Instagram -->
                        <?php if ($instagramOnly) : ?>
                            <?php
                            foreach ($instagramOnly as $row) {
                                if ('instagram' === $row['acf_fc_layout'] && ! empty($row['link'])) : ?>
                                    <a href="<?php echo esc_url($row['link']); ?>" target="_blank" class="quick-access-instagram">
                                        <div
                                            class="flex justify-center items-center font-medium text-sm w-8 sm:w-10 h-8 sm:h-10 rounded-xl bg-white hover:opacity-70">
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="size-4 sm:size-5">
                                                <path
                                                    d="M10.202 2.098c-1.49.07-2.507.308-3.396.657-.92.359-1.7.84-2.477 1.619a6.862 6.862 0 0 0-1.61 2.481c-.345.891-.578 1.909-.644 3.4-.066 1.49-.08 1.97-.073 5.771s.024 4.278.096 5.772c.071 1.489.308 2.506.657 3.396.359.92.84 1.7 1.619 2.477a6.857 6.857 0 0 0 2.483 1.61c.89.344 1.909.579 3.399.644 1.49.065 1.97.08 5.771.073 3.801-.007 4.279-.024 5.773-.095s2.505-.309 3.395-.657c.92-.36 1.701-.84 2.477-1.62s1.254-1.561 1.609-2.483c.345-.89.579-1.909.644-3.398.065-1.494.081-1.971.073-5.773s-.024-4.278-.095-5.771-.308-2.507-.657-3.397c-.36-.92-.84-1.7-1.619-2.477s-1.561-1.254-2.483-1.609c-.891-.345-1.909-.58-3.399-.644s-1.97-.081-5.772-.074-4.278.024-5.771.096m.164 25.309c-1.365-.059-2.106-.286-2.6-.476-.654-.252-1.12-.557-1.612-1.044s-.795-.955-1.05-1.608c-.192-.494-.423-1.234-.487-2.599-.069-1.475-.084-1.918-.092-5.656s.006-4.18.071-5.656c.058-1.364.286-2.106.476-2.6.252-.655.556-1.12 1.044-1.612s.955-.795 1.608-1.05c.493-.193 1.234-.422 2.598-.487 1.476-.07 1.919-.084 5.656-.092 3.737-.008 4.181.006 5.658.071 1.364.059 2.106.285 2.599.476.654.252 1.12.555 1.612 1.044s.795.954 1.051 1.609c.193.492.422 1.232.486 2.597.07 1.476.086 1.919.093 5.656.007 3.737-.006 4.181-.071 5.656-.06 1.365-.286 2.106-.476 2.601-.252.654-.556 1.12-1.045 1.612s-.955.795-1.608 1.05c-.493.192-1.234.422-2.597.487-1.476.069-1.919.084-5.657.092s-4.18-.007-5.656-.071M21.779 8.517a1.68 1.68 0 1 0 1.677-1.683 1.68 1.68 0 0 0-1.677 1.683M8.812 16.013a7.19 7.19 0 0 0 14.378-.028 7.19 7.19 0 0 0-14.377.028m2.522-.005a4.667 4.667 0 1 1 9.334-.022 4.667 4.667 0 0 1-9.334.024">
                                                </path>
                                            </svg> -->

                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" class="w-8 sm:w-10 h-8 sm:h-10 rounded-xl" viewBox="0 0 264.5833 264.5833" inkscape:version="1.0.1 (3bc2e813f5, 2020-09-07)" sodipodi:docname="Instagram_(2022).svg"><defs><radialGradient id="f" cx="158.429" cy="578.088" r="52.3515" xlink:href="#a" gradientUnits="userSpaceOnUse" gradientTransform="matrix(0 -4.03418 4.28018 0 -2332.2273 942.2356)" fx="158.429" fy="578.088"/><radialGradient inkscape:collect="always" xlink:href="#b" id="g" gradientUnits="userSpaceOnUse" gradientTransform="matrix(.67441 -1.16203 1.51283 .87801 -814.3657 -47.8354)" cx="172.6149" cy="600.6924" fx="172.6149" fy="600.6924" r="65"/><radialGradient inkscape:collect="always" xlink:href="#c" id="h" cx="144.012" cy="51.3367" fx="144.012" fy="51.3367" r="67.081" gradientTransform="matrix(-2.3989 .67549 -.23008 -.81732 464.9957 -26.4035)" gradientUnits="userSpaceOnUse"/><radialGradient inkscape:collect="always" xlink:href="#d" id="e" gradientUnits="userSpaceOnUse" gradientTransform="matrix(-3.10797 .87652 -.6315 -2.23914 1345.6503 1374.1983)" cx="199.7884" cy="628.4379" fx="199.7884" fy="628.4379" r="52.3515"/><linearGradient inkscape:collect="always" id="d"><stop offset="0" stop-color="#ff005f"/><stop offset="1" stop-color="#fc01d8"/></linearGradient><linearGradient id="c"><stop offset="0" stop-color="#780cff"/><stop stop-color="#820bff" offset="1" stop-opacity="0"/></linearGradient><linearGradient inkscape:collect="always" id="b"><stop offset="0" stop-color="#fc0"/><stop offset="1" stop-color="#fc0" stop-opacity="0"/></linearGradient><linearGradient id="a"><stop offset="0" stop-color="#fc0"/><stop offset=".1242" stop-color="#fc0"/><stop offset=".5672" stop-color="#fe4a05"/><stop offset=".6942" stop-color="#ff0f3f"/><stop offset="1" stop-color="#fe0657" stop-opacity="0"/></linearGradient></defs><sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666" borderopacity="1" inkscape:pageopacity="0" inkscape:pageshadow="2" inkscape:zoom=".515" inkscape:cx="500" inkscape:cy="500" inkscape:document-units="mm" inkscape:current-layer="layer1" inkscape:document-rotation="0" showgrid="false" inkscape:window-width="1366" inkscape:window-height="705" inkscape:window-x="-8" inkscape:window-y="-8" inkscape:window-maximized="1"/><g inkscape:label="Layer 1" inkscape:groupmode="layer"><path d="M204.1503 18.1429c-55.2305 0-71.3834.057-74.5232.3175-11.3342.9424-18.387 2.7275-26.0708 6.554-5.9214 2.9413-10.5915 6.3506-15.2005 11.1298-8.3938 8.7157-13.481 19.4383-15.3226 32.1842-.8953 6.1877-1.1558 7.4496-1.2087 39.0558-.0203 10.5354 0 24.4007 0 42.9984 0 55.2008.061 71.3418.3256 74.4764.9157 11.032 2.6453 17.9728 6.3081 25.565 7 14.5329 20.369 25.4428 36.119 29.5137 5.4535 1.4044 11.4767 2.1779 19.2092 2.5442 3.2762.1425 36.6684.2443 70.081.2443 33.4127 0 66.8253-.0407 70.02-.2035 8.9535-.4214 14.1526-1.1195 19.9011-2.6054 15.8517-4.0912 28.9767-14.8383 36.119-29.5748 3.5916-7.409 5.4128-14.6144 6.237-25.0704.179-2.2796.2543-38.6263.2543-74.924 0-36.304-.0814-72.5835-.2605-74.8632-.8343-10.6249-2.6555-17.7692-6.363-25.3207-3.0421-6.1816-6.42-10.798-11.324-15.518-8.752-8.3616-19.4555-13.4502-32.2101-15.2902-6.18-.8936-7.411-1.1582-39.033-1.2131z" inkscape:connector-curvature="0" fill="url(#e)" transform="translate(-71.8155 -18.1429)"/><path d="M204.1503 18.1429c-55.2305 0-71.3834.057-74.5232.3175-11.3342.9424-18.387 2.7275-26.0708 6.554-5.9214 2.9413-10.5915 6.3506-15.2005 11.1298-8.3938 8.7157-13.481 19.4383-15.3226 32.1842-.8953 6.1877-1.1558 7.4496-1.2087 39.0558-.0203 10.5354 0 24.4007 0 42.9984 0 55.2008.061 71.3418.3256 74.4764.9157 11.032 2.6453 17.9728 6.3081 25.565 7 14.5329 20.369 25.4428 36.119 29.5137 5.4535 1.4044 11.4767 2.1779 19.2092 2.5442 3.2762.1425 36.6684.2443 70.081.2443 33.4127 0 66.8253-.0407 70.02-.2035 8.9535-.4214 14.1526-1.1195 19.9011-2.6054 15.8517-4.0912 28.9767-14.8383 36.119-29.5748 3.5916-7.409 5.4128-14.6144 6.237-25.0704.179-2.2796.2543-38.6263.2543-74.924 0-36.304-.0814-72.5835-.2605-74.8632-.8343-10.6249-2.6555-17.7692-6.363-25.3207-3.0421-6.1816-6.42-10.798-11.324-15.518-8.752-8.3616-19.4555-13.4502-32.2101-15.2902-6.18-.8936-7.411-1.1582-39.033-1.2131z" inkscape:connector-curvature="0" fill="url(#f)" transform="translate(-71.8155 -18.1429)"/><path d="M204.1503 18.1429c-55.2305 0-71.3834.057-74.5232.3175-11.3342.9424-18.387 2.7275-26.0708 6.554-5.9214 2.9413-10.5915 6.3506-15.2005 11.1298-8.3938 8.7157-13.481 19.4383-15.3226 32.1842-.8953 6.1877-1.1558 7.4496-1.2087 39.0558-.0203 10.5354 0 24.4007 0 42.9984 0 55.2008.061 71.3418.3256 74.4764.9157 11.032 2.6453 17.9728 6.3081 25.565 7 14.5329 20.369 25.4428 36.119 29.5137 5.4535 1.4044 11.4767 2.1779 19.2092 2.5442 3.2762.1425 36.6684.2443 70.081.2443 33.4127 0 66.8253-.0407 70.02-.2035 8.9535-.4214 14.1526-1.1195 19.9011-2.6054 15.8517-4.0912 28.9767-14.8383 36.119-29.5748 3.5916-7.409 5.4128-14.6144 6.237-25.0704.179-2.2796.2543-38.6263.2543-74.924 0-36.304-.0814-72.5835-.2605-74.8632-.8343-10.6249-2.6555-17.7692-6.363-25.3207-3.0421-6.1816-6.42-10.798-11.324-15.518-8.752-8.3616-19.4555-13.4502-32.2101-15.2902-6.18-.8936-7.411-1.1582-39.033-1.2131z" inkscape:connector-curvature="0" fill="url(#g)" transform="translate(-71.8155 -18.1429)"/><path d="M204.1503 18.1429c-55.2305 0-71.3834.057-74.5232.3175-11.3342.9424-18.387 2.7275-26.0708 6.554-5.9214 2.9413-10.5915 6.3506-15.2005 11.1298-8.3938 8.7157-13.481 19.4383-15.3226 32.1842-.8953 6.1877-1.1558 7.4496-1.2087 39.0558-.0203 10.5354 0 24.4007 0 42.9984 0 55.2008.061 71.3418.3256 74.4764.9157 11.032 2.6453 17.9728 6.3081 25.565 7 14.5329 20.369 25.4428 36.119 29.5137 5.4535 1.4044 11.4767 2.1779 19.2092 2.5442 3.2762.1425 36.6684.2443 70.081.2443 33.4127 0 66.8253-.0407 70.02-.2035 8.9535-.4214 14.1526-1.1195 19.9011-2.6054 15.8517-4.0912 28.9767-14.8383 36.119-29.5748 3.5916-7.409 5.4128-14.6144 6.237-25.0704.179-2.2796.2543-38.6263.2543-74.924 0-36.304-.0814-72.5835-.2605-74.8632-.8343-10.6249-2.6555-17.7692-6.363-25.3207-3.0421-6.1816-6.42-10.798-11.324-15.518-8.752-8.3616-19.4555-13.4502-32.2101-15.2902-6.18-.8936-7.411-1.1582-39.033-1.2131z" inkscape:connector-curvature="0" fill="url(#h)" transform="translate(-71.8155 -18.1429)"/><path d="M132.3452 33.973c-26.7167 0-30.0696.1167-40.5629.5939-10.4727.4792-17.6212 2.136-23.8762 4.567-6.4701 2.5107-11.9586 5.8693-17.4265 11.3352-5.472 5.464-8.8332 10.9483-11.354 17.4116-2.4389 6.2524-4.099 13.3976-4.5703 23.8585-.4693 10.4854-.5923 13.8379-.5923 40.5348 0 26.697.1189 30.0371.5943 40.5225.4817 10.465 2.1397 17.6082 4.5703 23.8585 2.5147 6.4654 5.8758 11.9497 11.3458 17.4136 5.466 5.468 10.9544 8.8349 17.4204 11.3456 6.259 2.4309 13.4097 4.0877 23.8803 4.567 10.4933.477 13.8441.5938 40.5588.5938 26.7188 0 30.0615-.1167 40.5547-.5939 10.4728-.4792 17.6295-2.136 23.8885-4.567 6.4681-2.5106 11.9484-5.8775 17.4143-11.3455 5.472-5.4639 8.8332-10.9482 11.354-17.4115 2.4183-6.2524 4.0784-13.3976 4.5703-23.8585.4713-10.4854.5943-13.8277.5943-40.5246 0-26.697-.123-30.0473-.5943-40.5328-.4919-10.465-2.152-17.6081-4.5703-23.8584-2.5208-6.4654-5.882-11.9498-11.354-17.4137-5.4721-5.468-10.9442-8.8266-17.4204-11.3353-6.2714-2.4309-13.424-4.0877-23.8967-4.5669-10.4933-.4772-13.8339-.5939-40.5588-.5939zm-8.825 17.7147c2.6193-.0041 5.5418 0 8.825 0 26.2659 0 29.379.0942 39.7513.5652 9.5915.4383 14.7971 2.0397 18.2648 3.3852 4.5908 1.7817 7.8638 3.9116 11.3048 7.3521 3.4431 3.4406 5.5745 6.7173 7.3617 11.3046 1.3465 3.461 2.9512 8.6628 3.3877 18.2472.4714 10.3625.5739 13.4754.5739 39.7095 0 26.234-.1025 29.347-.5739 39.7095-.4386 9.5843-2.0412 14.7861-3.3877 18.2471-1.783 4.5874-3.9186 7.8539-7.3617 11.2923-3.443 3.4406-6.712 5.5704-11.3048 7.3521-3.4636 1.3517-8.6733 2.949-18.2648 3.3873-10.3702.471-13.4854.5734-39.7513.5734-26.2679 0-29.381-.1024-39.7513-.5734-9.5914-.4423-14.797-2.0438-18.2668-3.3893-4.5908-1.7817-7.87-3.9116-11.313-7.3521-3.4431-3.4405-5.5745-6.709-7.3617-11.2985-1.3465-3.461-2.9512-8.6628-3.3877-18.2471-.4714-10.3626-.5657-13.4754-.5657-39.7259 0-26.2504.0943-29.347.5657-39.7095.4386-9.5844 2.0412-14.7861 3.3877-18.2512 1.783-4.5874 3.9186-7.8641 7.3617-11.3046 3.443-3.4406 6.7222-5.5704 11.313-7.3562 3.4677-1.3517 8.6754-2.949 18.2668-3.3894 9.075-.4096 12.5919-.5324 30.9264-.553zm61.3363 16.322c-6.5173 0-11.805 5.2776-11.805 11.792 0 6.5125 5.2877 11.7962 11.805 11.7962 6.5172 0 11.8049-5.2837 11.8049-11.7962 0-6.5124-5.2877-11.796-11.805-11.796zm-52.5113 13.7826c-27.8993 0-50.5191 22.6031-50.5191 50.4817 0 27.8786 22.6198 50.4714 50.5191 50.4714s50.511-22.5928 50.511-50.4714c0-27.8786-22.6137-50.4817-50.513-50.4817zm0 17.7147c18.109 0 32.7914 14.6694 32.7914 32.767 0 18.0956-14.6824 32.767-32.7914 32.767-18.111 0-32.7913-14.6714-32.7913-32.767 0-18.0976 14.6803-32.767 32.7913-32.767z" inkscape:connector-curvature="0" fill="#fff"/></g></svg>
                                        </div>
                                    </a>
                                    <?php break; ?>
                            <?php endif;
                            } ?>
                        <?php endif; ?>

                        <!-- Survey Button -->
                        <button type="button" data-micromodal-trigger="menu-survey" aria-label="Survey"
                            class="rounded-xl bg-white w-8 sm:w-10 h-8 sm:h-10 hover:opacity-70 shadow-lg flex flex-col justify-center items-center quick-access-hamburger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 sm:size-6" viewBox="0 0 24 24" fill="none">
                                <path d="M16 1C17.6569 1 19 2.34315 19 4C19 4.55228 18.5523 5 18 5C17.4477 5 17 4.55228 17 4C17 3.44772 16.5523 3 16 3H4C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21H16C16.5523 21 17 20.5523 17 20V19C17 18.4477 17.4477 18 18 18C18.5523 18 19 18.4477 19 19V20C19 21.6569 17.6569 23 16 23H4C2.34315 23 1 21.6569 1 20V4C1 2.34315 2.34315 1 4 1H16Z" fill="#0F0F0F" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.7991 8.20087C20.4993 7.90104 20.0132 7.90104 19.7133 8.20087L11.9166 15.9977C11.7692 16.145 11.6715 16.3348 11.6373 16.5404L11.4728 17.5272L12.4596 17.3627C12.6652 17.3285 12.855 17.2308 13.0023 17.0835L20.7991 9.28666C21.099 8.98682 21.099 8.5007 20.7991 8.20087ZM18.2991 6.78666C19.38 5.70578 21.1325 5.70577 22.2134 6.78665C23.2942 7.86754 23.2942 9.61999 22.2134 10.7009L14.4166 18.4977C13.9744 18.9398 13.4052 19.2327 12.7884 19.3355L11.8016 19.5C10.448 19.7256 9.2744 18.5521 9.50001 17.1984L9.66448 16.2116C9.76728 15.5948 10.0602 15.0256 10.5023 14.5834L18.2991 6.78666Z" fill="#0F0F0F" />
                                <path d="M5 7C5 6.44772 5.44772 6 6 6H14C14.5523 6 15 6.44772 15 7C15 7.55228 14.5523 8 14 8H6C5.44772 8 5 7.55228 5 7Z" fill="#0F0F0F" />
                                <path d="M5 11C5 10.4477 5.44772 10 6 10H10C10.5523 10 11 10.4477 11 11C11 11.5523 10.5523 12 10 12H6C5.44772 12 5 11.5523 5 11Z" fill="#0F0F0F" />
                                <path d="M5 15C5 14.4477 5.44772 14 6 14H7C7.55228 14 8 14.4477 8 15C8 15.5523 7.55228 16 7 16H6C5.44772 16 5 15.5523 5 15Z" fill="#0F0F0F" />
                            </svg>
                        </button>
                    <?php endif; ?>

                    <!-- All Informations -->
                    <button type="button" data-micromodal-trigger="menu-info" aria-label="See more informations"
                        class="rounded-xl bg-white w-8 sm:w-10 h-8 sm:h-10 hover:opacity-70 shadow-lg flex flex-col justify-center items-center">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg> -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 sm:size-6" viewBox="0 0 24 24" fill="none">
                            <path d="M14 5C14 6.10457 13.1046 7 12 7C10.8954 7 10 6.10457 10 5C10 3.89543 10.8954 3 12 3C13.1046 3 14 3.89543 14 5Z" fill="#000000" />
                            <path d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z" fill="#000000" />
                            <path d="M12 21C13.1046 21 14 20.1046 14 19C14 17.8954 13.1046 17 12 17C10.8954 17 10 17.8954 10 19C10 20.1046 10.8954 21 12 21Z" fill="#000000" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex justify-between items-end">
                <div class="flex-1 flex flex-col items-start <?php echo !$categorized ? 'justify-end' : 'justify-between' ?> ">
                    <div>
                        <?php if (!$categorized): ?>
                            <?php if ($brand_logo): ?>
                                <?php if ($logo_round): ?>
                                    <!-- Rounded Brand Logo -->
                                    <div class="brand-logo inline-block rounded-full p-1"
                                        style="background-color: <?php echo esc_attr($logo_background_color); ?>;">
                                        <img class="inline-block sm:h-[100px] h-[70px] w-[70px] sm:w-[100px] rounded-full object-contain object-center"
                                            src="<?php echo esc_url($brand_logo); ?>" alt="<?php echo esc_attr($name); ?>" />
                                    </div>
                                <?php else: ?>
                                    <!-- Non-Rounded Brand Logo -->
                                    <div class="brand-logo inline-block w-[100px] sm:w-[120px] p-1">
                                        <img class="inline-block w-full h-full object-contain object-center"
                                            src="<?php echo esc_url($brand_logo); ?>" alt="<?php echo esc_attr($name); ?>" />
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif ?>

                        <!-- Override Image -->
                        <?php if ($categorized): ?>
                            <?php if (is_page_template('page-templates/page-category.php')) { ?>
                                <?php if ($logo_round): ?>
                                    <!-- Rounded Brand Logo -->
                                    <div class="brand-logo inline-block rounded-full p-1"
                                        style="background-color: <?php echo esc_attr($logo_background_color); ?>;">
                                        <img class="inline-block sm:h-[100px] h-[70px] w-[70px] sm:w-[100px] rounded-full object-contain object-center"
                                            src="<?php echo esc_url($page_profile_picture); ?>" alt="<?php echo esc_attr($page_title); ?>" />
                                    </div>
                                <?php else: ?>
                                    <!-- Non-Rounded Brand Logo -->
                                    <div class="brand-logo inline-block w-[100px] sm:w-[120px] p-1">
                                        <img class="inline-block w-full h-full object-contain object-center"
                                            src="<?php echo esc_url($page_profile_picture); ?>" alt="<?php echo esc_attr($page_title); ?>" />
                                    </div>
                                <?php endif; ?>
                            <?php } ?>


                            <?php
                            if (is_category()) {
                                $category = get_queried_object();
                                $category_id = $category->term_id;
                                $category_image = function_exists('z_taxonomy_image_url') ? z_taxonomy_image_url($category_id, 'large') : '';
                            ?>

                                <?php if ($category_image): ?>

                                    <?php if ($logo_round): ?>
                                        <!-- Rounded Brand Logo -->
                                        <div class="brand-logo inline-block rounded-full p-1"
                                            style="background-color: <?php echo esc_attr($logo_background_color); ?>;">
                                            <img class="inline-block sm:h-[100px] h-[70px] w-[70px] sm:w-[100px] rounded-full object-contain object-center"
                                                src="<?php echo esc_url($category_image); ?>" alt="<?php echo esc_attr($page_title); ?>" />
                                        </div>
                                    <?php else: ?>
                                        <!-- Non-Rounded Brand Logo -->
                                        <div class="brand-logo inline-block w-[100px] sm:w-[120px] p-1">
                                            <img class="inline-block w-full h-full object-contain object-center"
                                                src="<?php echo esc_url($category_image); ?>" alt="<?php echo esc_attr($page_title); ?>" />
                                        </div>
                                    <?php endif; ?>

                                <?php endif; ?>

                            <?php } ?>
                        <?php endif; ?>

                        <?php if (!$categorized): ?>
                            <?php if ($brand_name): ?>
                                <?php if (!$hide_name): ?>
                                    <h2 class="font-medium mt-2 sm:mt-4 text-white sm:text-2xl pr-2" style="color:<?php echo $title_color; ?>">
                                        <?php echo esc_html($brand_name); ?>
                                    </h2>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif ?>

                        <?php if ($categorized): ?>
                            <?php if (is_page_template('page-templates/page-category.php')) { ?>
                                <h2 class="font-medium mt-2 sm:mt-4 text-white sm:text-2xl pr-2">
                                    <?php echo esc_html($page_title); ?>
                                </h2>
                            <?php } ?>
                            <?php
                            if (is_category()) {
                                $category = get_queried_object(); // Gets the current category object
                                $category_name = $category->name;
                            ?>
                                <h1 class="font-medium mt-2 sm:mt-4 text-white sm:text-2xl pr-2">
                                    <?php echo esc_html($category_name); ?>
                                </h1>
                            <?php } ?>
                        <?php endif ?>
                    </div>
                </div><!-- .flex-1 -->

                <div class="flex-1 flex-initial">
                    <div class="flex items-end flex-col h-full justify-between">
                        <div class="flex flex-row items-center">
                            <!-- Language Switch -->
                            <div class="flex gap-x-3 items-center justify-between">
                                <div class="lang-switch flex items-center">
                                    <?php
                                    // Get all registered menu locations.
                                    $locations = get_nav_menu_locations();
                                    // Check if a menu is assigned to the 'language-switcher' location.
                                    if (isset($locations['language-switcher'])) {
                                        // Get the menu object.
                                        $menu = wp_get_nav_menu_object($locations['language-switcher']);
                                        // Get menu items for this menu.
                                        $menu_items = wp_get_nav_menu_items($menu->term_id);
                                        if ($menu_items): ?>
                                            <?php foreach ($menu_items as $item): ?>
                                                <a href="<?php echo esc_url($item->url); ?>"
                                                    class=" text-sm font-medium leading-6 inline-flex items-center rounded-full bg-white px-4 py-1 text-black shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-5 rtl:ml-1.5 ltr:mr-1.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                                    </svg>
                                                    <?php echo esc_html($item->title); ?>
                                                </a>
                                            <?php endforeach; ?>
                                    <?php endif;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div><!-- .flex -->
                </div><!-- .flex-1 -->

            </div>
        </div><!-- .restaurant-details-inner -->
    </div><!-- .flex -->
</div><!-- .restaurant-details -->


<div class="modal micromodal-slide relative z-[9999999]" id="menu-survey" aria-hidden="true">
    <div class="modal__overlay items-end sm:items-center" tabindex="-1" data-micromodal-close>
        <div class="modal__container info-modal-container max-h-full relative overflow-y-auto transform rounded-lg bg-white px-4 pt-5 pb-4 shadow-xl transition-all sm:my-8 w-full sm:max-w-md sm:p-6"
            role="dialog" aria-modal="true" aria-labelledby="Delivery Apps">
            <div class="flex justify-between items-center">
                <button
                    class="close-btn-i sticky bg-gray-100 rounded-full hover:text-gray-900 hover:border-gray-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                    data-micromodal-close>
                </button>
            </div>
            <main class="max-h-full flex flex-col justify-between">
                <div class="main-inner">
                    <div>
                        <h2 class="text-xl text-center font-bold mt-4">Customer Feedback</h2>
                        <div class="feedback-container max-h-full flex flex-col justify-between overflow-y-auto">
                            <?php if (!empty($feedback_form_id)): ?>
                                <?php echo do_shortcode('[everest_form id="' . $feedback_form_id . '"]'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="w-full bg-white">
                            <a href="https://logix360.studio">
                                <div class="flex items-center justify-center p-2">
                                    <span class="text-sm">Designed by</span>
                                    <div class="w-20 rtl:mr-2 ltr:ml-2">
                                        <?php get_template_part('page-templates/sections/logo'); ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>