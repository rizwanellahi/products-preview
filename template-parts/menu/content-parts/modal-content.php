<div class="modal micromodal-slide relative z-[99999] w-full chola"
    id="<?php echo esc_attr($menu_title . '-' . $item_name . '-' . $item_index); ?>" aria-hidden="true">
    <div class="modal__overlay items-end sm:items-center" tabindex="-1" data-micromodal-close>
        <div class="modal__container relative z-999 transform overflow-hidden 
                                                        rounded-t-xl sm:rounded-lg bg-white shadow-xl transition-all
                                                        w-full max-w-full sm:max-w-md h-auto" role="dialog"
            aria-modal="true">

            <button
                class="close-btn-i absolute w-[32px] h-[32px] left-[0.8rem] top-[0.8rem] 
                                                            rounded-full bg-white/70 text-gray-600 p-1 leading-4 text-4xl font-extralight
                                                            hover:text-gray-900 hover:border-gray-900 focus-visible:outline focus-visible:outline-2
                                                            focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                data-micromodal-close></button>

            <?php if ($cover_image_src): ?>
                <div class="w-full h-[280px] bg-no-repeat bg-center bg-cover"
                    style="background-image: url('<?php echo esc_url($cover_image_src); ?>');">
                </div>
            <?php endif; ?>

            <div class="p-4 h-full mb-4 space-y-2">
                <?php if ($is_popular): ?>
                    <div
                        class="popular-item max-w-max rounded flex-1 flex justify-start gap-x-1 font-medium flex-row mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="w-3">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="leading-5">Popular</span>
                    </div>
                <?php endif; ?>

                <div class="text-xl text-gray-900 font-semibold <?php echo $cover_image_src ? "yes" : "mt-12" ?>">
                    <?php echo esc_html($item_name); ?>
                </div>
                <div class="text-base text-gray-600 pt-1">
                    <?php echo esc_html($description); ?>
                </div>

                <?php if ($country_symbol) {
                    set_query_var('item', $item); // Pass the $item variable
                    set_query_var('list', $list);
                    get_template_part('page-templates/menu-parts/currency');
                } ?>

                <div class="flex flex-row items-center gap-2 mt-2">
                    <?php if (!empty($item_kcal)): ?>
                        <div class="flex flex-row items-center bg-gray-100 gap-1 ltr:pr-2 rtl:pl-2 rounded-full">
                            <span class="bg-gray-200 rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="size-4" viewBox="-33 0 255 255" preserveAspectRatio="xMidYMid">
                                    <defs>
                                        <style>
                                            .cls-kcal-3 {
                                                fill: url(#linear-gradient-1);
                                            }

                                            .cls-kcal-4 {
                                                fill: #fc9502;
                                            }

                                            .cls-kcal-5 {
                                                fill: #fce202;
                                            }
                                        </style>

                                        <linearGradient id="linear-gradient-1" gradientUnits="userSpaceOnUse" x1="94.141" y1="255" x2="94.141" y2="0.188">
                                            <stop offset="0" stop-color="#ff4c0d" />
                                            <stop offset="1" stop-color="#fc9502" />
                                        </linearGradient>
                                    </defs>
                                    <g id="fire">
                                        <path d="M187.899,164.809 C185.803,214.868 144.574,254.812 94.000,254.812 C42.085,254.812 -0.000,211.312 -0.000,160.812 C-0.000,154.062 -0.121,140.572 10.000,117.812 C16.057,104.191 19.856,95.634 22.000,87.812 C23.178,83.513 25.469,76.683 32.000,87.812 C35.851,94.374 36.000,103.812 36.000,103.812 C36.000,103.812 50.328,92.817 60.000,71.812 C74.179,41.019 62.866,22.612 59.000,9.812 C57.662,5.384 56.822,-2.574 66.000,0.812 C75.352,4.263 100.076,21.570 113.000,39.812 C131.445,65.847 138.000,90.812 138.000,90.812 C138.000,90.812 143.906,83.482 146.000,75.812 C148.365,67.151 148.400,58.573 155.999,67.813 C163.226,76.600 173.959,93.113 180.000,108.812 C190.969,137.321 187.899,164.809 187.899,164.809 Z" id="path-1" class="cls-kcal-3" fill-rule="evenodd" />
                                        <path d="M94.000,254.812 C58.101,254.812 29.000,225.711 29.000,189.812 C29.000,168.151 37.729,155.000 55.896,137.166 C67.528,125.747 78.415,111.722 83.042,102.172 C83.953,100.292 86.026,90.495 94.019,101.966 C98.212,107.982 104.785,118.681 109.000,127.812 C116.266,143.555 118.000,158.812 118.000,158.812 C118.000,158.812 125.121,154.616 130.000,143.812 C131.573,140.330 134.753,127.148 143.643,140.328 C150.166,150.000 159.127,167.390 159.000,189.812 C159.000,225.711 129.898,254.812 94.000,254.812 Z" id="path-2" class="cls-kcal-4" fill-rule="evenodd" />
                                        <path d="M95.000,183.812 C104.250,183.812 104.250,200.941 116.000,223.812 C123.824,239.041 112.121,254.812 95.000,254.812 C77.879,254.812 69.000,240.933 69.000,223.812 C69.000,206.692 85.750,183.812 95.000,183.812 Z" id="path-3" class="cls-kcal-5" fill-rule="evenodd" />
                                    </g>
                                </svg>
                            </span>
                            <span class="text-xs"><?php echo $item_kcal ?> (Kcal)</span>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($dietary_pref)): ?>
                        <div class="flex items-center gap-x-2">
                            <?php foreach ($dietary_pref as $pref):
                                $icon = get_dietary_icon($pref);
                                echo '<span class="flex gap-x-1 leading-3 items-center text-sm">' . $icon . esc_html($pref) . '</span> ';
                            endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div><!-- .p-4 -->
        </div><!-- .modal__container -->
    </div><!-- .modal__overlay -->
</div><!-- .modal -->