<div class="modal micromodal-slide relative z-[99999] w-full chola"
    id="<?php echo esc_attr($menu_title . '-' . $item_name . '-' . $item_index); ?>" aria-hidden="true">
    <div class="modal__overlay items-end sm:items-center" tabindex="-1" data-micromodal-close>
        <div class="modal__container relative z-999 transform overflow-hidden rounded-t-xl sm:rounded-lg transition-all w-full sm:w-5/6 xl:w-3/3  h-auto"
            role="dialog" aria-modal="true">


            <div class="relative py-24 xl:py-16">
                <div class="mx-auto max-w-7xl bg-transparent xl:px-8">
                    <div class="xl:grid xl:grid-cols-12">
                        <div
                            class="relative z-10 xl:col-span-5 xl:col-start-1 bg-gray-100 xl:bg-transparent pt-6 rounded-3xl xl:row-start-1 xl:py-16">
                            <!-- <div aria-hidden="true" class="absolute inset-x-0 h-1/2 bg-gray-50 lg:hidden"></div> -->
                            <div class="mx-auto max-w-md px-6 sm:max-w-3xl xl:max-w-none xl:p-0 -mb-6 xl:-mb-0">
                                <?php if ($cover_image_src): ?>
                                    <img src="<?php echo esc_url($cover_image_src); ?>" alt=""
                                        class="relative w-full rounded-3xl object-cover xl:shadow-2xl aspect-[4/3] xl:aspect-[4/3]" />
                                <?php endif; ?>
                            </div>
                        </div>

                        <button
                            class="close-btn-i absolute w-[66px] xl:w-[36px] h-[66px] xl:h-[36px] right-[2%] xl:right-[5%] top-[1rem] xl:top-[0.4rem] 
                                                            rounded-full bg-white/70 text-gray-600 p-1 leading-4 text-4xl font-extralight
                                                            hover:text-gray-900 hover:border-gray-900 focus-visible:outline focus-visible:outline-2
                                                            focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                            data-micromodal-close></button>

                        <div
                            class="relative bg-gray-100 xl:col-span-10 xl:col-start-3 xl:row-start-1 xl:grid xl:grid-cols-8 xl:items-center rounded-t-none xl:rounded-t-3xl rounded-b-3xl xl:py-12 xl:justify-items-start">
                            <div aria-hidden="true"
                                class="absolute inset-0 hidden overflow-hidden rounded-3xl xl:block">
                            </div>
                            <div
                                class="modal-content-inner relative mx-auto max-w-md space-y-6 px-12 sm:max-w-3xl py-14 xl:col-start-4 xl:col-span-7 xl:max-w-none xl:py-0 xl:px-0 rtl:xl:pl-12 ltr:xl:pr-12 xl:mx-0">

                                <?php if ($is_popular): ?>
                                    <div
                                        class="popular-item max-w-max rounded flex-1 flex justify-start gap-x-1 font-medium flex-row !py-1 !px-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" class="w-4">
                                            <path fill-rule="evenodd"
                                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm leading-5">Popular</span>
                                    </div>
                                <?php endif; ?>

                                <h2 id="join-heading" class="text-3xl font-bold tracking-tight text-gray-900">
                                    <?php echo esc_html($item_name); ?>
                                </h2>
                                <p class="text-lg text-gray-700">
                                    <?php echo esc_html($description); ?>
                                </p>
                                <?php if (!empty($item_kcal) || !empty($preparation_time)): ?>
                                    <div class="flex flex-row items-center gap-4 pt-4">
                                        <?php if (!empty($item_kcal)): ?>
                                            <div
                                                class="flex flex-row items-center bg-gray-200 font-medium gap-1 ltr:pr-2 rtl:pl-2 rounded-full">
                                                <span class="bg-gray-300 rounded-full p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" class="size-6"
                                                        viewBox="-33 0 255 255" preserveAspectRatio="xMidYMid">
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

                                                            <linearGradient id="linear-gradient-1"
                                                                gradientUnits="userSpaceOnUse" x1="94.141" y1="255" x2="94.141"
                                                                y2="0.188">
                                                                <stop offset="0" stop-color="#ff4c0d" />
                                                                <stop offset="1" stop-color="#fc9502" />
                                                            </linearGradient>
                                                        </defs>
                                                        <g id="fire">
                                                            <path
                                                                d="M187.899,164.809 C185.803,214.868 144.574,254.812 94.000,254.812 C42.085,254.812 -0.000,211.312 -0.000,160.812 C-0.000,154.062 -0.121,140.572 10.000,117.812 C16.057,104.191 19.856,95.634 22.000,87.812 C23.178,83.513 25.469,76.683 32.000,87.812 C35.851,94.374 36.000,103.812 36.000,103.812 C36.000,103.812 50.328,92.817 60.000,71.812 C74.179,41.019 62.866,22.612 59.000,9.812 C57.662,5.384 56.822,-2.574 66.000,0.812 C75.352,4.263 100.076,21.570 113.000,39.812 C131.445,65.847 138.000,90.812 138.000,90.812 C138.000,90.812 143.906,83.482 146.000,75.812 C148.365,67.151 148.400,58.573 155.999,67.813 C163.226,76.600 173.959,93.113 180.000,108.812 C190.969,137.321 187.899,164.809 187.899,164.809 Z"
                                                                id="path-1" class="cls-kcal-3" fill-rule="evenodd" />
                                                            <path
                                                                d="M94.000,254.812 C58.101,254.812 29.000,225.711 29.000,189.812 C29.000,168.151 37.729,155.000 55.896,137.166 C67.528,125.747 78.415,111.722 83.042,102.172 C83.953,100.292 86.026,90.495 94.019,101.966 C98.212,107.982 104.785,118.681 109.000,127.812 C116.266,143.555 118.000,158.812 118.000,158.812 C118.000,158.812 125.121,154.616 130.000,143.812 C131.573,140.330 134.753,127.148 143.643,140.328 C150.166,150.000 159.127,167.390 159.000,189.812 C159.000,225.711 129.898,254.812 94.000,254.812 Z"
                                                                id="path-2" class="cls-kcal-4" fill-rule="evenodd" />
                                                            <path
                                                                d="M95.000,183.812 C104.250,183.812 104.250,200.941 116.000,223.812 C123.824,239.041 112.121,254.812 95.000,254.812 C77.879,254.812 69.000,240.933 69.000,223.812 C69.000,206.692 85.750,183.812 95.000,183.812 Z"
                                                                id="path-3" class="cls-kcal-5" fill-rule="evenodd" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <span class="text-base px-2"><?php echo $item_kcal ?> (Kcal)</span>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Prep time badge -->
                                        <?php if (!empty($preparation_time)): ?>
                                            <div
                                                class="item-prep-time inline-flex items-center gap-1 rounded-full px-3 py-1 text-base  text-gray-900 ring-2 bg-yellow-400 ring-gray-900">
                                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor"
                                                    stroke-width="2" aria-hidden="true">
                                                    <circle cx="12" cy="12" r="9"></circle>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 1.5">
                                                    </path>
                                                </svg>
                                                <span class="font-medium">
                                                    <?php echo esc_html($preparation_time); ?>
                                                </span>
                                                <span><?php echo esc_html($preparation_time_label); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>


                                <?php if (!empty($dietary_pref)): ?>
                                    <div class="flex items-center gap-x-2 text-lg">
                                        <!-- Allergens: -->
                                        <div class="flex flex-wrap gap-2">
                                            <?php foreach ($dietary_pref as $pref): ?>
                                                <?php $icon = get_dietary_icon($pref); ?>
                                                <span class="flex flex-col items-center gap-1 text-sm px-2 py-1 rounded-full bg-gray-100">
                                                    <div class="rounded-full border-gray-900 border-2 p-2">
                                                        <?= $icon; ?>
                                                    </div>
                                                    <?= esc_html($pref); ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($item['price'])): ?>
                                    <div class="modal-price font-semibold">
                                        <?php if ($country_symbol) {
                                            set_query_var('item', $item); // Pass the $item variable
                                            set_query_var('list', $list);
                                            get_template_part('page-templates/menu-parts/currency');
                                        } ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- .modal__container -->
    </div><!-- .modal__overlay -->
</div><!-- .modal -->