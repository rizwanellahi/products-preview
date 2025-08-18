<?php

$brand_name = get_field('name', 'option');

$phone = get_field('phone', 'option');
$use_whatsapp = get_field('use_whatsapp', 'option');
$whatsapp__number = get_field('whatsapp__number', 'option');

$address = get_field('address', 'option');
$address_link = get_field('address_link', 'option');
$pin_map = get_field('pin_map', 'option');
$feedback_form_id = get_field('feedback_form_ID', 'option');
$qrcode_id = get_field('qr-code_id', 'option');
$brand_logo = get_field('logo', 'option');
$logo_round = get_field('logo_round', 'option');
$name = $brand_name;
$logo_background_color = get_field('logo_background_color', 'option');

$open_from = get_field('open_from', 'option');
$open_to = get_field('open_to', 'option');
$open_days = get_field('open_days', 'option');

?>

<div class="modal micromodal-slide relative z-[9999999]" id="menu-info" aria-hidden="true">
    <div class="modal__overlay items-end sm:items-center" tabindex="-1" data-micromodal-close>
        <div class="modal__container info-modal-container max-h-full relative overflow-y-auto transform rounded-lg bg-white px-4 pt-5 pb-4 shadow-xl transition-all sm:my-8 w-full sm:max-w-md sm:p-6"
            role="dialog" aria-modal="true" aria-labelledby="Delivery Apps">
            <div class="flex justify-between items-center">
                <button
                    class="close-btn-i sticky bg-gray-100 rounded-full hover:text-gray-900 hover:border-gray-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                    data-micromodal-close>
                </button>
                <button id="share-btn-header"
                    class="close-btn-i share-btn-i sticky bg-gray-100 rounded-full hover:text-gray-900 hover:border-gray-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                </button>
            </div>
            <header class="flex flex-col gap-y-2 items-center pb-4 justify-between">
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
                <h3 class="text-base font-medium leading-6 text-gray-900">
                    <?php echo esc_html($brand_name); ?>
                </h3>
            </header>

            <main class="max-h-full flex flex-col justify-between">
                <div class="main-inner">

                    <!-- NAV MARKUP (unchanged) -->
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex" aria-label="Tabs" id="tabs-nav">
                            <!-- My Account Tab Link -->
                            <a href="#" data-tab-target="info"
                                class="group inline-flex items-center justify-center w-1/3 border-b-2 border-transparent px-1 py-4 text-center text-xs font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="-ml-0.5 ltr:mr-2 rtl:ml-2 size-5 text-gray-400 group-hover:text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                </svg>

                                <span>Info</span>
                            </a>
                            <!-- Company Tab Link -->
                            <a href="#" data-tab-target="feedback"
                                class="group inline-flex items-center justify-center w-1/3 border-b-2 border-transparent px-1 py-4 text-center text-xs font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="ltr:mr-2 rtl:ml-2 size-5 text-gray-400 group-hover:text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                </svg>

                                <span>Feedback</span>
                            </a>
                            <!-- Team Members Tab Link (active by default) -->
                            <a href="#" data-tab-target="qrcode"
                                class="group inline-flex items-center justify-center w-1/3 border-b-2 border-transparent px-1 py-4 text-center text-xs font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
                                aria-current="page">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="ltr:mr-2 rtl:ml-2 size-5 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                                </svg>
                                <span>QR-CODE</span>
                            </a>
                        </nav>
                    </div>

                    <!-- TAB CONTENT SECTIONS -->
                    <div id="tab-contents">
                        <div data-tab-content="info" class="hidden">
                            <div class="flex flex-row justify-evenly my-8 gap-x-2 overflow-x-auto">
                                <!-- Address Direction -->
                                <a href="<?php echo esc_url($address_link); ?>" target="_blank">
                                    <div
                                        class="flex justify-center items-center font-medium text-sm py-3 px-5 rounded-full bg-gray-200 hover:opacity-75">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 ltr:mr-2 rtl:ml-2"
                                            viewBox="0 0 24 24">
                                            <g>
                                                <path fill="none" d="M0 0h24v24H0z" />
                                                <path
                                                    d="M9 10a1 1 0 0 0-1 1v4h2v-3h3v2.5l3.5-3.5L13 7.5V10H9zm3.707-8.607l9.9 9.9a1 1 0 0 1 0 1.414l-9.9 9.9a1 1 0 0 1-1.414 0l-9.9-9.9a1 1 0 0 1 0-1.414l9.9-9.9a1 1 0 0 1 1.414 0z" />
                                            </g>
                                        </svg>
                                        <span>Direction</span>
                                    </div>
                                </a>
                                <!-- Phone -->
                                <?php if (!$use_whatsapp): ?>

                                    <a href="tel:<?php echo esc_attr($phone); ?>">
                                        <div
                                            class="flex justify-center items-center font-medium text-sm py-3 px-5 rounded-full bg-gray-200 hover:opacity-75">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="size-5 text-gray-900 ltr:mr-2 rtl:ml-2">
                                                <path fill-rule="evenodd"
                                                    d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>Call</span>
                                        </div>
                                    </a>
                                <?php elseif ($use_whatsapp): ?>
                                    <a href="https://wa.me/<?php echo esc_attr($whatsapp__number) ?>">
                                        <div
                                            class="flex justify-center items-center font-medium text-sm py-3 px-5 rounded-full bg-[#25D366] hover:opacity-75">
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-gray-900 ltr:mr-2 rtl:ml-2" viewBox="0 0 360 362" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M307.546 52.5655C273.709 18.685 228.706 0.0171895 180.756 0C81.951 0 1.53846 80.404 1.50408 179.235C1.48689 210.829 9.74646 241.667 25.4319 268.844L0 361.736L95.0236 336.811C121.203 351.096 150.683 358.616 180.679 358.625H180.756C279.544 358.625 359.966 278.212 360 179.381C360.017 131.483 341.392 86.4547 307.546 52.5741V52.5655ZM180.756 328.354H180.696C153.966 328.346 127.744 321.16 104.865 307.589L99.4242 304.358L43.034 319.149L58.0834 264.168L54.5423 258.53C39.6304 234.809 31.749 207.391 31.7662 179.244C31.8006 97.1036 98.6334 30.2707 180.817 30.2707C220.61 30.2879 258.015 45.8015 286.145 73.9665C314.276 102.123 329.755 139.562 329.738 179.364C329.703 261.513 262.871 328.346 180.756 328.346V328.354ZM262.475 216.777C257.997 214.534 235.978 203.704 231.869 202.209C227.761 200.713 224.779 199.966 221.796 204.452C218.814 208.939 210.228 219.029 207.615 222.011C205.002 225.002 202.389 225.372 197.911 223.128C193.434 220.885 179.003 216.158 161.891 200.902C148.578 189.024 139.587 174.362 136.975 169.875C134.362 165.389 136.7 162.965 138.934 160.739C140.945 158.728 143.412 155.505 145.655 152.892C147.899 150.279 148.638 148.406 150.133 145.423C151.629 142.432 150.881 139.82 149.764 137.576C148.646 135.333 139.691 113.287 135.952 104.323C132.316 95.5909 128.621 96.777 125.879 96.6309C123.266 96.5019 120.284 96.4762 117.293 96.4762C114.302 96.4762 109.454 97.5935 105.346 102.08C101.238 106.566 89.6691 117.404 89.6691 139.441C89.6691 161.478 105.716 182.785 107.959 185.776C110.202 188.767 139.544 234.001 184.469 253.408C195.153 258.023 203.498 260.782 210.004 262.845C220.731 266.257 230.494 265.776 238.212 264.624C246.816 263.335 264.71 253.786 268.44 243.326C272.17 232.866 272.17 223.893 271.053 222.028C269.936 220.163 266.945 219.037 262.467 216.794L262.475 216.777Z" fill="#25D366" />
                                            </svg>
                                            <span>WhatsApp</span> -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[80px] text-gray-900 ltr:mr-2 rtl:ml-2" id="Layer_1" viewBox="0 0 1485.66 345.24">
                                                <defs>
                                                    <style>
                                                        .cls-1 {
                                                            fill: #fff;
                                                        }
                                                    </style>
                                                </defs>
                                                <path class="cls-1" d="M172.51,0C78.22,0,1.47,76.74,1.43,171.06c-.01,30.15,7.87,59.58,22.84,85.52L0,345.24l90.69-23.79c24.99,13.63,53.12,20.81,81.75,20.82h.07c94.28,0,171.03-76.75,171.07-171.07,.02-45.71-17.76-88.69-50.06-121.02C261.22,17.84,218.27,.02,172.51,0Zm0,313.38h-.06c-25.51,0-50.54-6.87-72.37-19.82l-5.19-3.08-53.81,14.12,14.36-52.47-3.38-5.38c-14.23-22.64-21.75-48.81-21.74-75.67,.03-78.4,63.82-142.18,142.25-142.18,37.98,.01,73.68,14.82,100.52,41.7,26.85,26.87,41.62,62.6,41.61,100.59-.03,78.4-63.82,142.19-142.19,142.19Zm77.99-106.49c-4.27-2.14-25.29-12.48-29.21-13.91-3.92-1.43-6.77-2.14-9.62,2.14-2.85,4.28-11.04,13.91-13.53,16.76-2.49,2.86-4.99,3.21-9.26,1.07-4.27-2.14-18.05-6.66-34.37-21.22-12.71-11.33-21.29-25.33-23.78-29.61-2.49-4.28-.27-6.59,1.88-8.72,1.92-1.91,4.27-4.99,6.41-7.49,2.14-2.5,2.85-4.28,4.27-7.14,1.42-2.85,.71-5.35-.36-7.49-1.07-2.14-9.62-23.18-13.18-31.74-3.47-8.33-6.99-7.21-9.62-7.34-2.49-.13-5.34-.15-8.19-.15s-7.48,1.07-11.4,5.35c-3.92,4.28-14.96,14.62-14.96,35.66s15.32,41.37,17.45,44.22c2.14,2.85,30.14,46.03,73.02,64.54,10.2,4.4,18.16,7.03,24.37,9,10.24,3.25,19.56,2.79,26.92,1.69,8.21-1.23,25.29-10.34,28.85-20.33,3.56-9.98,3.56-18.54,2.49-20.33-1.07-1.78-3.92-2.85-8.19-4.99Zm302.64-2.61h-.46l-28.36-114.42h-34.18l-28.83,113.02h-.46l-26.27-113.02h-36.5l43.94,166.05h36.97l27.66-113.03h.47l28.13,113.03h36.27l44.64-166.05h-35.8l-27.21,114.42Zm174.37-58.26c-3.25-4.26-7.71-7.59-13.36-10-5.66-2.39-12.91-3.59-21.74-3.59-6.2,0-12.55,1.58-19.07,4.77-6.51,3.17-11.85,8.25-16.04,15.23h-.7v-62.57h-33.01V255.9h33.01v-63.02c0-12.25,2.01-21.04,6.05-26.4,4.03-5.34,10.54-8.02,19.53-8.02,7.9,0,13.4,2.44,16.51,7.33,3.1,4.88,4.65,12.28,4.65,22.2v67.91h33.02v-73.95c0-7.44-.67-14.22-1.98-20.35-1.32-6.11-3.6-11.31-6.86-15.58Zm136.01,83.14v-62.55c0-7.3-1.62-13.15-4.89-17.56-3.25-4.42-7.43-7.87-12.54-10.35-5.12-2.48-10.78-4.15-16.98-5-6.2-.85-12.32-1.28-18.36-1.28-6.66,0-13.29,.65-19.87,1.98-6.6,1.32-12.52,3.53-17.79,6.63-5.27,3.1-9.62,7.21-13.01,12.32-3.42,5.12-5.36,11.55-5.82,19.31h33.01c.62-6.51,2.8-11.17,6.52-13.96,3.72-2.79,8.83-4.18,15.34-4.18,2.94,0,5.69,.19,8.25,.58,2.55,.39,4.8,1.15,6.74,2.32,1.94,1.16,3.49,2.79,4.65,4.89,1.16,2.09,1.74,4.93,1.74,8.48,.15,3.42-.86,6-3.02,7.79-2.18,1.79-5.12,3.15-8.84,4.07-3.72,.94-7.98,1.64-12.79,2.09-4.81,.48-9.69,1.11-14.64,1.87-4.97,.78-9.89,1.82-14.76,3.14-4.88,1.31-9.24,3.3-13.03,5.92-3.8,2.65-6.9,6.17-9.31,10.59-2.4,4.42-3.6,10.05-3.6,16.86,0,6.2,1.05,11.55,3.14,16.04,2.09,4.51,5,8.22,8.72,11.17,3.72,2.95,8.06,5.12,13.02,6.52,4.95,1.39,10.31,2.09,16.04,2.09,7.44,0,14.73-1.09,21.85-3.25,7.13-2.19,13.34-5.97,18.61-11.41,.15,2.02,.42,4,.81,5.93,.39,1.93,.89,3.84,1.51,5.69h33.48c-1.55-2.47-2.64-6.19-3.26-11.16-.63-4.96-.94-10.14-.94-15.58Zm-33.01-19.77c0,1.88-.19,4.36-.58,7.45-.38,3.11-1.43,6.16-3.14,9.19-1.71,3.02-4.35,5.63-7.91,7.79-3.56,2.18-8.6,3.26-15.12,3.26-2.63,0-5.19-.23-7.67-.71-2.48-.46-4.65-1.28-6.51-2.44-1.86-1.16-3.33-2.75-4.42-4.77-1.08-2.02-1.63-4.49-1.63-7.43,0-3.1,.55-5.67,1.63-7.68,1.09-2.01,2.52-3.68,4.31-5,1.77-1.32,3.87-2.36,6.27-3.14,2.4-.77,4.84-1.39,7.33-1.86,2.63-.46,5.27-.86,7.9-1.16,2.65-.3,5.16-.7,7.56-1.16,2.41-.47,4.65-1.05,6.75-1.75,2.09-.7,3.83-1.65,5.23-2.9v12.32Zm94.63-109.76h-33.02v36.04h-19.99v22.09h19.99v70.94c0,6.05,1.02,10.93,3.03,14.65,2.02,3.72,4.77,6.6,8.25,8.61,3.49,2.02,7.52,3.37,12.1,4.06,4.56,.69,9.42,1.05,14.53,1.05,3.27,0,6.59-.08,10.01-.22,3.4-.16,6.5-.46,9.3-.94v-25.58c-1.56,.31-3.18,.56-4.89,.7-1.7,.16-3.48,.24-5.34,.24-5.57,0-9.3-.94-11.16-2.8-1.85-1.86-2.78-5.58-2.78-11.17v-59.54h24.18v-22.09h-24.18v-36.04Zm136.46,103.61c-2.17-3.8-5.04-6.98-8.6-9.54-3.56-2.55-7.64-4.61-12.2-6.17-4.58-1.54-9.27-2.85-14.07-3.94-4.65-1.09-9.21-2.1-13.71-3.03-4.5-.93-8.49-1.98-11.98-3.13-3.48-1.17-6.3-2.67-8.47-4.54-2.18-1.86-3.25-4.25-3.25-7.21,0-2.48,.6-4.46,1.85-5.93,1.24-1.47,2.76-2.59,4.54-3.38,1.79-.77,3.75-1.27,5.92-1.51,2.17-.23,4.19-.34,6.04-.34,5.89,0,11.01,1.12,15.36,3.37,4.33,2.25,6.74,6.55,7.19,12.9h31.39c-.62-7.44-2.52-13.6-5.7-18.49-3.17-4.88-7.17-8.79-11.97-11.74-4.8-2.95-10.26-5.04-16.4-6.28-6.12-1.24-12.43-1.86-18.93-1.86s-12.88,.58-19.06,1.73c-6.21,1.17-11.79,3.19-16.74,6.06-4.97,2.87-8.95,6.78-11.98,11.74-3.03,4.96-4.54,11.32-4.54,19.07,0,5.27,1.09,9.74,3.27,13.38,2.15,3.65,5.03,6.66,8.58,9.07,3.58,2.4,7.65,4.35,12.22,5.81,4.57,1.49,9.26,2.76,14.06,3.85,11.79,2.48,20.98,4.96,27.56,7.45,6.59,2.48,9.88,6.2,9.88,11.16,0,2.95-.69,5.37-2.09,7.31-1.4,1.95-3.14,3.49-5.23,4.65-2.1,1.17-4.43,2.03-6.98,2.56-2.56,.55-5.01,.82-7.33,.82-3.26,0-6.39-.39-9.41-1.16-3.03-.78-5.7-1.98-8.03-3.61-2.32-1.63-4.23-3.72-5.7-6.28-1.46-2.56-2.21-5.61-2.21-9.19h-31.38c.32,8.06,2.13,14.77,5.47,20.12,3.32,5.35,7.58,9.65,12.78,12.91,5.19,3.25,11.13,5.58,17.8,6.98,6.65,1.39,13.47,2.09,20.44,2.09s13.53-.66,20.12-1.97c6.59-1.32,12.44-3.61,17.55-6.87,5.13-3.25,9.25-7.55,12.44-12.9,3.17-5.36,4.76-11.98,4.76-19.89,0-5.59-1.08-10.27-3.25-14.06Zm65.56-113.38l-62.77,166.05h36.73l13.01-36.98h62.08l12.54,36.98h37.91l-62.07-166.05h-37.44Zm-3.48,101.87l21.62-60.93h.46l20.93,60.93h-43.01Zm217.14-39.77c-4.49-5.89-10.15-10.62-16.97-14.18-6.82-3.57-14.95-5.35-24.4-5.35-7.45,0-14.26,1.47-20.46,4.41-6.22,2.95-11.32,7.68-15.34,14.19h-.47v-15.36h-31.4v162.34h33.04v-56.98h.45c4.03,5.9,9.19,10.35,15.48,13.36,6.26,3.02,13.13,4.54,20.57,4.54,8.84,0,16.55-1.72,23.13-5.12,6.59-3.41,12.09-7.99,16.51-13.73,4.42-5.74,7.7-12.32,9.89-19.76,2.15-7.45,3.25-15.2,3.25-23.26,0-8.53-1.1-16.7-3.25-24.54-2.19-7.82-5.51-14.69-10.01-20.58Zm-21.15,58.37c-.94,4.66-2.53,8.72-4.77,12.21-2.25,3.49-5.19,6.33-8.85,8.49-3.63,2.17-8.17,3.27-13.59,3.27s-9.75-1.09-13.47-3.27c-3.72-2.16-6.71-5-8.96-8.49-2.25-3.49-3.87-7.55-4.88-12.21-1.01-4.65-1.5-9.38-1.5-14.17s.45-9.78,1.38-14.42c.94-4.65,2.52-8.76,4.78-12.34,2.23-3.56,5.19-6.46,8.84-8.71,3.64-2.25,8.16-3.39,13.59-3.39s9.74,1.14,13.37,3.39c3.64,2.24,6.63,5.18,8.95,8.83,2.32,3.65,3.98,7.8,5,12.44,1.02,4.65,1.5,9.39,1.5,14.2s-.45,9.53-1.38,14.17Zm162.73-37.79c-2.17-7.82-5.5-14.69-10-20.58-4.5-5.89-10.14-10.62-16.96-14.18-6.83-3.57-14.97-5.35-24.42-5.35-7.43,0-14.26,1.47-20.45,4.41-6.2,2.95-11.32,7.68-15.35,14.19h-.45v-15.36h-31.39v162.34h33.01v-56.98h.47c4.03,5.9,9.19,10.35,15.46,13.36,6.27,3.02,13.14,4.54,20.58,4.54,8.83,0,16.53-1.72,23.13-5.12,6.58-3.41,12.09-7.99,16.5-13.73,4.43-5.74,7.71-12.32,9.88-19.76,2.18-7.45,3.26-15.2,3.26-23.26,0-8.53-1.08-16.7-3.26-24.54Zm-31.16,37.79c-.92,4.66-2.51,8.72-4.76,12.21-2.26,3.49-5.2,6.33-8.84,8.49-3.64,2.17-8.17,3.27-13.6,3.27s-9.77-1.09-13.49-3.27c-3.73-2.16-6.7-5-8.96-8.49-2.24-3.49-3.87-7.55-4.88-12.21-1.01-4.65-1.51-9.38-1.51-14.17s.47-9.78,1.4-14.42c.93-4.65,2.52-8.76,4.77-12.34,2.24-3.56,5.19-6.46,8.84-8.71,3.63-2.25,8.17-3.39,13.6-3.39s9.72,1.14,13.36,3.39c3.65,2.24,6.63,5.18,8.96,8.83,2.33,3.65,4,7.8,5,12.44,1.02,4.65,1.51,9.39,1.51,14.2s-.47,9.53-1.4,14.17Z" />
                                            </svg>
                                        </div>
                                    </a>
                                <?php endif; ?>

                                <!-- Share -->
                                <button id="share-btn-x">
                                    <div
                                        class="flex justify-center items-center font-medium text-sm py-3 px-5 rounded-full bg-gray-200 hover:opacity-75">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-5 text-gray-900 ltr:mr-2 rtl:ml-2">
                                            <path fill-rule="evenodd"
                                                d="M15.75 4.5a3 3 0 1 1 .825 2.066l-8.421 4.679a3.002 3.002 0 0 1 0 1.51l8.421 4.679a3 3 0 1 1-.729 1.31l-8.421-4.678a3 3 0 1 1 0-4.132l8.421-4.679a3 3 0 0 1-.096-.755Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        <span>Share</span>
                                    </div>
                                </button>
                            </div>

                            <?php if (!empty($open_from) || !empty($open_days)): ?>
                                <div class="space-y-4 my-8">

                                    <?php if (!empty($open_from)): ?>
                                        <div class="flex flex-row items-start gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-gray-900">Opening Hours</div>
                                                <span class="text-gray-700"><?php echo esc_html($open_from); ?> - <?php echo esc_html($open_to); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($open_days)): ?>
                                        <div class="flex flex-row items-start gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                            <div>
                                                <div class="font-semibold text-gray-900">Opening Days</div>
                                                <span class="text-gray-700"><?php echo esc_html($open_days); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php get_template_part('page-templates/menu-parts/order-online'); ?>

                            <?php get_template_part('page-templates/menu-parts/social-media'); ?>

                            <!-- Google Map -->
                            <iframe src="<?php echo esc_url($pin_map); ?>" class="w-full h-[120px] rounded-2xl"
                                style="border:0;" allowfullscreen="" loading="lazy" zoomcontrol="false"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>

                            <div class="w-full bg-white my-4">
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

                        <div data-tab-content="feedback" class="hidden">
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

                        <div data-tab-content="qrcode" class="hidden">
                            <div class="h-full" id="qr-code-container">
                                <?php if (!empty($qrcode_id)): ?>
                                    <div class="p-4">
                                        <div class="px-10 pb-4">
                                            <?php echo do_shortcode('[qyrr code="' . $qrcode_id . '"]'); ?>
                                        </div>
                                        <div class="flex justify-center gap-x-8">
                                            <a id="download-btn" href="#" download="qrcode.png"
                                                class="button flex justify-center gap-x-2 items-center">
                                                Download<svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
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
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>


<?php
// do_action(
//     'air_reactions_display',
//     [
//         'echo' => true,
//         'post_id' => 5,
//         'types' => ['heart'],
//     ]
// )
?>