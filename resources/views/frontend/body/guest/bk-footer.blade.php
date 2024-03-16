{{-- @php
    $route = Route::current()->getName();
@endphp --}}

<footer class="main">


                        <div class="bottom-panel nagivation-menu-wrap">
                            <ul class="sc-bottom-bar furniture-bottom-nav" id="furniture_navbar">

                                <li class="nav-menu-icon {{ $route == 'home.guest' ? 'active' : '' }}">
                                    <a href="{{ url('/guest/') }}" class="home-icon navigation-icons {{ $route == 'home.guest' ? 'active' : '' }}">
                                        <svg width="25px" height="25px" viewBox="0 0 28 28" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path clip-rule="evenodd"
                                                d="M16.3382 1.94393L25.9705 9.82424L26.0201 9.8788C26.1701 10.0437 26.3998 10.3064 26.5943 10.6198C26.7798 10.9189 27 11.3686 27 11.8956V24.9976C27 26.1013 26.1068 27 25 27H18.7601C17.9317 27 17.2601 26.3284 17.2601 25.5V20.7939C17.2601 18.9948 15.8058 17.5405 14.0168 17.5405C12.2279 17.5405 10.7735 18.9948 10.7735 20.7939V25.5C10.7735 26.3284 10.102 27 9.27354 27H3C1.89318 27 1 26.1013 1 24.9976V11.7425C1 11.0901 1.36299 10.564 1.56986 10.3028C1.69049 10.1505 1.80873 10.0264 1.89631 9.94036C1.9407 9.89677 1.97877 9.86147 2.0074 9.83565C2.02175 9.8227 2.03384 9.81204 2.0433 9.80382L2.05551 9.79329L2.06007 9.7894L2.06278 9.7871C2.06278 9.7871 2.06356 9.78646 2.7075 10.5515L2.06356 9.78646L2.07352 9.77807L11.6288 1.94617C12.9452 0.685478 15.0206 0.684487 16.3382 1.94393ZM3.35246 11.3159L3.3468 11.3209C3.33673 11.33 3.31953 11.3459 3.29759 11.3674C3.25251 11.4117 3.19388 11.4736 3.13764 11.5446C3.07966 11.6178 3.038 11.6834 3.01374 11.7344C3.00661 11.7494 3.00238 11.7602 3 11.767V24.9976L3.00006 24.9992L3.0007 25H8.77354V20.7939C8.77354 17.8948 11.1188 15.5405 14.0168 15.5405C16.9149 15.5405 19.2601 17.8948 19.2601 20.7939V25H24.9993L24.9999 24.9992L25 24.9976V11.8956C25 11.8989 25.0008 11.8992 25 11.8956C24.9966 11.8812 24.9788 11.8095 24.8948 11.6742C24.8108 11.5389 24.7005 11.4037 24.588 11.2772L15.004 3.43645L14.9714 3.40439C14.4228 2.86484 13.5451 2.86525 12.997 3.40534L12.9644 3.43744L3.35246 11.3159Z"
                                                fill="#000000" fill-rule="evenodd" />
                                        </svg>
                                    </a>
                                </li>

                                <li class="nav-menu-icon {{ $route == 'shop.page.guest' ? 'active' : '' }}">
                                    <a href="{{ route('shop.page.guest') }}" class="account-icon navigation-icons {{ $route == 'shop.page.guest' ? 'active' : '' }}">
                                        <svg width="40px" height="40px" version="1.1" id="Layer_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 512 512" xml:space="preserve">
                                    <circle style="fill:#273B7A;" cx="256" cy="256" r="256" />
                                    <path style="fill:#121149;" d="M509.154,294.24L332.262,118.546l-6.587-1.751l-28.444-16.808l-75.461-1.581l-35.297,23.13
 l-3.739,2.729l-5.67,3.591l-16.455,62.85l27.743,11.348l-31.048,29.955l23.847,86.34l-33.535,90.327l103.258,103.258
 c1.705,0.033,3.41,0.066,5.122,0.066C384.388,512,490.694,417.485,509.154,294.24z" />
                                    <path style="fill:#A6A8AA;" d="M363.744,194.586h-13.791c0-51.807-42.146-93.953-93.953-93.953s-93.953,42.146-93.953,93.953
 h-13.791c0-59.411,48.333-107.744,107.744-107.744S363.744,135.175,363.744,194.586z" />
                                    <path style="fill:#808183;" d="M256,86.842v13.791c51.807,0,93.953,42.146,93.953,93.953h13.791
 C363.744,135.175,315.411,86.842,256,86.842z" />
                                    <path style="fill:#A6A8AA;" d="M344.638,418.263H167.364c-13.884,0-25.141-11.255-25.141-25.14V190.707h227.556v202.416
 C369.778,407.007,358.522,418.263,344.638,418.263z" />
                                    <path style="fill:#808183;"
                                        d="M256,190.707v227.556h88.636c13.884,0,25.14-11.255,25.14-25.14V190.707H256z" />
                                    <rect x="170.667" y="247.587" style="fill:#FFFFFF;" width="170.667"
                                        height="113.778" />
                                    <rect x="256" y="247.587" style="fill:#D0E6F7;" width="85.333" height="113.778" />
                                    <path style="fill:#FFFFFF;" d="M369.778,219.152H142.222c-7.854,0-14.222-6.368-14.222-14.222l0,0
 c0-7.854,6.368-14.222,14.222-14.222h227.556c7.854,0,14.222,6.368,14.222,14.222l0,0C384,212.783,377.632,219.152,369.778,219.152z
 " />
                                    <path style="fill:#D0E6F7;" d="M369.778,190.707H256v28.444h113.778c7.854,0,14.222-6.368,14.222-14.222
 S377.632,190.707,369.778,190.707z" />
                                    <path style="fill:#71E2EF;" d="M208.305,190.707v87.919c0,7.854,6.368,14.222,14.222,14.222l0,0c7.854,0,14.222-6.368,14.222-14.222
 l0,0c0-7.854,6.368-14.222,14.222-14.222l0,0c7.854,0,14.222,6.368,14.222,14.222v28.444c0,7.854,6.368,14.222,14.222,14.222l0,0
 c7.854,0,14.222-6.368,14.222-14.222V190.707H208.305z" />
                                    <path style="fill:#38C6D9;" d="M256,190.707v74.63c5.37,2.032,9.194,7.209,9.194,13.29v28.444c0,7.854,6.368,14.222,14.222,14.222
 c7.854,0,14.222-6.368,14.222-14.222V190.707H256z" />
                                </svg>
                                    </a>
                                </li>

                                <li class="nav-menu-icon {{ $route == 'mycart.guest' ? 'active' : '' }}">
                                    <a href="{{ route('mycart.guest') }}"
                                        class="notification-icon navigation-icons left-icon {{ $route == 'mycart.guest' ? 'active' : '' }}">
                                        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                                stroke="#1C274C" stroke-width="1.5" />
                                            <path
                                                d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                                stroke="#1C274C" stroke-width="1.5" />
                                            <path d="M13 13V11M13 11V9M13 11H15M13 11H11" stroke="#1C274C"
                                                stroke-width="1.5" stroke-linecap="round" />
                                            <path
                                                d="M2 3L2.26121 3.09184C3.5628 3.54945 4.2136 3.77826 4.58584 4.32298C4.95808 4.86771 4.95808 5.59126 4.95808 7.03836V9.76C4.95808 12.7016 5.02132 13.6723 5.88772 14.5862C6.75412 15.5 8.14857 15.5 10.9375 15.5H12M16.2404 15.5C17.8014 15.5 18.5819 15.5 19.1336 15.0504C19.6853 14.6008 19.8429 13.8364 20.158 12.3075L20.6578 9.88275C21.0049 8.14369 21.1784 7.27417 20.7345 6.69708C20.2906 6.12 18.7738 6.12 17.0888 6.12H11.0235M4.95808 6.12H7"
                                                stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </a>
                                </li>

                                <li class="nav-menu-icon {{ $route == 'user.track.order.guest' ? 'active' : '' }}">
                                    <a href="{{ route('user.track.order.guest') }}" class="account-icon navigation-icons {{ $route == 'user.track.order.guest' ? 'active' : '' }}">
                                        <svg fill="#000000" height="30px" width="30px" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 512 512" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M437.4,281.224h-21.046c16.833-34.58,28.023-67.206,28.023-92.847c0-18.316-2.624-36.425-7.802-53.82
    c-1.268-4.259-5.747-6.682-10.012-5.419c-4.261,1.269-6.687,5.75-5.419,10.012c4.734,15.904,7.134,32.466,7.134,49.227
    c0,85.29-140.794,263.973-172.277,302.857C224.517,452.35,83.723,273.668,83.723,188.377c0-94.994,77.283-172.277,172.277-172.277
    c65.227,0,124.115,36.151,153.686,94.345c2.015,3.965,6.86,5.544,10.824,3.53c3.963-2.015,5.544-6.861,3.53-10.824
    c-15.519-30.541-39.089-56.31-68.164-74.526C325.981,9.9,291.444,0,256,0C157.613,0,76.615,75.82,68.334,172.096
    c-28.133,3.128-50.087,27.042-50.087,55.996v12.881c0,31.072,25.28,56.352,56.352,56.352h29.205
    c16.907,32.145,37.839,65.281,58.534,95.53h-81.3c-31.072,0-56.352,25.28-56.352,56.352v6.44C24.688,486.72,49.968,512,81.04,512
    h172.813c4.341,0,9.685-4.342,12.328-7.737c16.117-20.708,40.306-49.843,72.37-95.402c0.383,0.056,0.773,0.094,1.172,0.094H437.4
    c31.072,0,56.352-25.28,56.352-56.352v-15.027C493.753,306.504,468.472,281.224,437.4,281.224z M74.6,281.224
    c-22.195,0-40.252-18.056-40.252-40.252v-12.881c0-19.814,14.396-36.32,33.276-39.634c0.024,25.628,11.206,58.222,28.022,92.766
    H74.6z M81.04,495.899c-22.195,0-40.252-18.056-40.252-40.252v-6.44c0-22.195,18.056-40.252,40.252-40.252h92.476
    c26.737,37.984,51.744,69.845,65.512,86.943H81.04z M477.652,352.604c0,22.195-18.056,40.252-40.252,40.252h-87.74
    c20.696-30.25,41.628-63.385,58.534-95.53H437.4c22.195,0,40.252,18.056,40.252,40.252V352.604z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M256,40.788c-81.38,0-147.589,66.209-147.589,147.589c0,13.892,1.93,27.644,5.735,40.872
    c1.23,4.272,5.692,6.743,9.962,5.512c4.272-1.23,6.74-5.69,5.512-9.962c-3.39-11.782-5.108-24.036-5.108-36.422
    c0-72.503,58.985-131.488,131.488-131.488s131.488,58.985,131.488,131.488S328.503,319.866,256,319.866
    c-48.242,0-92.539-26.357-115.604-68.783c-2.123-3.906-7.011-5.353-10.917-3.228c-3.907,2.123-5.351,7.011-3.228,10.917
    c25.884,47.615,75.602,77.194,129.749,77.194c81.38,0,147.589-66.209,147.589-147.589S337.38,40.788,256,40.788z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M350.457,115.925H161.543c-4.447,0-8.05,3.603-8.05,8.05v137.392c0,4.447,3.603,8.05,8.05,8.05h188.914
    c4.447,0,8.05-3.603,8.05-8.05V123.975C358.507,119.528,354.904,115.925,350.457,115.925z M218.969,132.025h26.834v44.008h-26.834
    V132.025z M299.472,253.317H169.593V132.025h33.275v52.059c0,4.447,3.603,8.05,8.05,8.05h42.935c4.447,0,8.05-3.603,8.05-8.05
    v-52.059h37.568V253.317z M342.407,253.317h-26.834V132.025h26.834V253.317z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M281.761,206.088h-92.31c-4.447,0-8.05,3.603-8.05,8.05s3.603,8.05,8.05,8.05h92.31c4.447,0,8.05-3.603,8.05-8.05
    S286.208,206.088,281.761,206.088z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M281.761,229.702h-92.31c-4.447,0-8.05,3.603-8.05,8.05s3.603,8.05,8.05,8.05h92.31c4.447,0,8.05-3.603,8.05-8.05
    S286.208,229.702,281.761,229.702z" />
                                    </g>
                                </g>
                            </svg>
                                    </a>
                                </li>

                                

                            </ul>
                            
                        </div>




</footer>
