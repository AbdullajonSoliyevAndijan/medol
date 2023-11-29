<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ $setting != null ? asset($setting->logo) : asset('frontend/assets/images/logo.webp') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.min.css') }}" />
    <title>MEDOL - Medical Online Services</title>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar__inner">
        <img class="sidebar__close" src="{{ asset('frontend/assets/images/x-btn.webp') }}" alt="x btn">

        <div class="header__item">
            <img class="header__icon" src="{{ asset('frontend/assets/images/location.svg') }}" alt="header icon">
            <div class="header__info">{{ $setting != null ? $setting->address : "" }} <br> {{ $setting != null ? $setting->address_number : "" }}</div>
        </div>

        <div class="header__item">
            <img class="header__icon" src="{{ asset('frontend/assets/images/phone.svg') }}" alt="header icon">
            <div class="header__info">
                <a class="header__phone" href="tel:{{ $setting != null ? $setting->first_phone : "" }}">{{ $setting != null ? $setting->first_phone : "" }}</a>
                <a class="header__phone" href="tel:{{ $setting != null ? $setting->second_phone : "" }}">{{ $setting != null ? $setting->second_phone : "" }}</a>
            </div>
        </div>

        <a class="header__item" href="#">
            <img class="header__icon" src="{{ asset('frontend/assets/images/search.svg') }}" alt="header icon">
            Search
        </a>
        <div class="header__icon header__icon_block">
            <img src="{{ asset('frontend/assets/images/facebook.svg') }}" alt="header icon">
            <a href="{{ $setting != null ? $setting->facebook_url : "" }}" target="_blank"><span>Мы на Facebook</span></a>
        </div>
    </div>
</aside>

<header class="header">
    <div class="container">
        <div class="header__top">

            <div class="header__item header__location">
                <img class="header__icon" src="{{ asset('frontend/assets/images/location.svg') }}" alt="header icon">
                <div class="header__info">{{ $setting != null ? $setting->address : "" }} <br> {{ $setting != null ? $setting->address_number : "" }}</div>
            </div>

            <div class="header__item header__phones">
                <img class="header__icon" src="{{ asset('frontend/assets/images/phone.svg') }}" alt="header icon">
                <div class="header__info">
                    <a class="header__phone" href="tel:{{ $setting != null ? $setting->first_phone : "" }}">{{ $setting != null ? $setting->first_phone : "" }}</a>
                    <a class="header__phone" href="tel:{{ $setting != null ? $setting->second_phone : "" }}">{{ $setting != null ? $setting->second_phone : "" }}</a>
                </div>
            </div>

            <a href="/" class="logo"><img src="{{ $setting != null ? asset($setting->logo) : asset('frontend/assets/images/logo.webp') }}" alt="logo"></a>


            <img class="header__icon header__search" src="{{ asset('frontend/assets/images/search.svg') }}" alt="header icon">
            <div class="header__icon header__icon_block header__facebook">
                <img src="{{ asset('frontend/assets/images/facebook.svg') }}" alt="header icon">
                <a href="{{ $setting != null ? $setting->facebook_url : "" }}" target="_blank"><span>Мы на Facebook</span></a>
            </div>


            <div class="header-dropdown">
                <div class="header-dropdown__active">
                    <img class="header-icon" src="{{ asset('frontend/assets/images/russia.webp') }}" alt="flag">
                    <span>Русский</span>
                </div>
                <ul class="header-dropdown__list">
                    <li class="header-dropdown__item">
                        <img class="header-icon" src="{{ asset('frontend/assets/images/uzbekistan.webp') }}" alt="flag">
                        <span>O'zbek</span>
                    </li>

                    <li class="header-dropdown__item">
                        <img class="header-icon" src="{{ asset('frontend/assets/images/united-kingdom.webp') }}" alt="flag">
                        <span>Enlish</span>
                    </li>
                </ul>
                <img class="header-dropdown__arrow" src="{{ asset('frontend/assets/images/arrow-down.svg') }}" alt="arrow">

            </div>

            <div class="header-btn">
                <div class="header-btn__line"></div>
                <div class="header-btn__line"></div>
                <div class="header-btn__line"></div>
            </div>

        </div>
        <nav class="header__menu">
            <a class="header__link" href="#">МАГАЗИН</a>
            <a class="header__link active" href="#">О КОМПАНИИ</a>
            <a class="header__link" href="#">ПРОДУКЦИЯ</a>
            <a class="header__link" href="#">УСЛУГИ</a>
            <a class="header__link" href="#">АКЦИИ И НОВОСТИ</a>
            <a class="header__link" href="#">ОБРАТНАЯ СВЯЗЬ</a>
        </nav>
        <div class="header__slider">
            @foreach($offers as $item)
            <div class="header__slide">
                <div class="header__content">
                    <h1 class="header__title">{{ $item->title }}</h1>
                    <p class="header__text">{!! $item->content !!}</p>
                    <button class="btn">Подробнее</button>
                </div>
                <img class="header__img" src="{{ asset($item->image) }}" alt="header img">
            </div>
            @endforeach
        </div>

        <div class="header-dots">
            <div class="header-dots__item active"></div>
            <div class="header-dots__item"></div>
            <div class="header-dots__item"></div>
        </div>
    </div>
</header>

<div class="container">
    <!-- === PRODUCTS === -->

    <section class="products">
        <h1 class="title" data-aos-offset="200" data-aos="flip-up">ПРОДУКЦИЯ</h1>
        <main class="products__inner">
            @foreach($products as $item)
                <div class="products__item" data-aos-offset="100" data-aos="zoom-out">
                <img class="products__img" src="{{ asset($item->image) }}" alt="products img">
                <h3 class="products__title">{{ $item->name }}</h3>
                <button class="btn">Посмотреть все</button>
            </div>
            @endforeach
        </main>

        <a class="link" href="#">Перейти в каталог нашей продукции</a>
    </section>

    <!-- === SERVICE === -->

    <section class="service">
        <h1 class="title" data-aos-offset="200" data-aos="flip-up">УСЛУГИ</h1>

        <div class="service__inner">
            @foreach($services as $item)
                <div class="service__card" data-aos-duration="1000" data-aos-offset="100" data-aos="fade-down">
                <div class="service__img">
                    <img src="{{ asset($item->image) }}" alt="service">
                </div>

                <div class="service__info">
                    <h3 class="service__title">{{ $item->name }}</h3>
                    <p class="service__text text">{!! $item->content !!}</p>
                    <button class="btn service__btn">Подробнее</button>
                </div>

            </div>
            @endforeach
        </div>
    </section>

    <!-- === COMPANY === -->

    <section class="company">
        <h1 class="title" data-aos-offset="200" data-aos="flip-up">О КОМПАНИИ</h1>

        <div class="company__inner">
            <div class="company__wrapper" data-aos-offset="100" data-aos-duration="1000" data-aos="zoom-in">
                <div class="company__circle company__circle_1">
                    <div class="company__circle company__circle_2">
                        <div class="company__circle company__circle_3">
                            <img class="company__logo" src="{{ $setting != null ? asset($setting->logo) : asset('frontend/assets/images/logo.webp') }}" alt="logo">
                        </div>
                    </div>
                </div>
            </div>

            <div class="company__content" data-aos-offset="100" data-aos-duration="1000" data-aos="fade-right">
                <img class="company__content-logo" src="{{ $setting != null ? asset($setting->logo) : asset('frontend/assets/images/logo.webp') }}" alt="logo">
                <p class="company__text text">{!! $setting != null ? $setting->about : "" !!} </p>

                <button class="btn">Узнать больше</button>
            </div>
        </div>


    </section>

    <!-- === NEWS === -->

    <section class="news">
        <h1 class="title" data-aos-offset="200" data-aos="flip-up">НОВОСТИ</h1>
        <main class="news__slider">
            @foreach($news as $item)
            <div class="news__item" data-aos-offset="100" data-aos="flip-left">
                <img class="news__img" src="{{ asset($item->image) }}" alt="news img">
                <h3 class="news__title">{{ $item->title }}</h3>
                <div class="news__date">{{ Carbon\Carbon::parse($item->created_at)->format("d.m.Y") }}</div>
                <p class="news__text">{!! Str::limit($item->content, 280) !!}</p>
                <button class="news__btn btn">Подробнее</button>
            </div>
            @endforeach
        </main>

        <div class="news__links">
            <a class="link" href="#">Посмотреть все новости </a>
            <a class="link" href="#">Посмотреть все новости </a>
        </div>
    </section>

    <!-- === PARTNER === -->

    <section class="partner">
        <h1 class="title" data-aos-offset="200" data-aos="flip-up">ПАРТНЕРЫ</h1>

        <div class="partner__slider">
            @php
            $parent_start = "<div class='partner__item'>";
                $parent_end = "</div>";
            $base_url = url('/')."/";
            $index = 0;
            @endphp

            @foreach($partners as $item)
            @php
            $index++;
            $child = "<a class='partner__link' data-aos-offset='100' data-aos='flip-up' href='#'><img src='{$base_url}{$item->image}' alt='partner img'></a>";
            @endphp

            @if($index % 8 == 1)
            {!! $parent_start !!}
            @endif

            {!! $child !!}

            @if($index % 8 == 0 || $loop->last)
            {!! $parent_end !!}
            @endif

            @endforeach
        </div>

    </section>

    <!-- === FOOTER === -->

</div>
<footer class="footer">
    <div class="container">
        <div class="footer__top">
            <div class="footer__start">
                <div class="footer-contact">
                    <h3 class="footer__title">Контакты</h3>
                    <div class="footer-contact__box">
                        <div class="footer-contact__item">
                            <img class="footer__icon" src="{{ asset('frontend/assets/images/location.svg') }}" alt="footer icon">
                            <div class="footer__infos">{{ $setting != null ? $setting->address : "" }} <br> {{ $setting != null ? $setting->address_number : "" }}</div>
                        </div>
                        <div class="footer-contact__item">
                            <img class="footer__icon" src="{{ asset('frontend/assets/images/message.svg') }}" alt="footer icon">
                            <a class="footer__infos" href="mailto:{{ $setting != null ? $setting->email : "" }}">{{ $setting != null ? $setting->email : "" }}</a>
                        </div>
                    </div>
                    <div class="footer-contact__box">
                        <div class="footer-contact__phone">
                            <img class="footer__icon" src="{{ asset('frontend/assets/images/phone.svg') }}" alt="header icon">
                            <div class="footer__infos">
                                <a class="footer__phone" href="tel:{{ $setting != null ? $setting->first_phone : "" }}">{{ $setting != null ? $setting->first_phone : "" }}</a>
                                <a class="footer__phone" href="tel:{{ $setting != null ? $setting->second_phone : "" }}">{{ $setting != null ? $setting->second_phone : "" }}</a>
                            </div>
                        </div>
                        <button class="btn">Оставить заявку</button>
                    </div>
                </div>
                <div class="footer__info">
                    <img src="{{ $setting != null ? asset($setting->logo) : asset('frontend/assets/images/logo.webp') }}" alt="footer logo">
                    <p class="text">{!! $setting != null ? $setting->target : "" !!}</p>
                </div>
            </div>
            <div class="footer__end">
                <div class="footer__item">
                    <h3 class="footer__title">О компании</h3>
                    <ul class="footer__list">
                        <li><a class="footer__link" href="#">История</a></li>
                        <li><a class="footer__link" href="#">Партнеры</a></li>
                        <li><a class="footer__link" href="#">Вакансии</a></li>
                    </ul>
                </div>

                <div class="footer__item">
                    <h3 class="footer__title">Продукция</h3>
                    <ul class="footer__list">
                        <li><a class="footer__link" href="#">Эндоваскулярная хирургия</a></li>
                        <li><a class="footer__link" href="#">Аритмология</a></li>
                        <li><a class="footer__link" href="#">Кардиохирургия</a></li>
                        <li><a class="footer__link" href="#">Лабораторная диагностика</a></li>
                        <li><a class="footer__link" href="#">Хирургия</a></li>
                        <li><a class="footer__link" href="#">Эндоурология</a></li>
                        <li><a class="footer__link" href="#">Нейрохирургия</a></li>
                        <li><a class="footer__link" href="#">Анестезиология и реанимация</a></li>
                        <li><a class="footer__link" href="#">Диабет</a></li>
                    </ul>
                </div>
                <div class="footer__item">
                    <h3 class="footer__title">Услуги</h3>
                    <ul class="footer__list">
                        <li><a class="footer__link" href="#">Сервис</a></li>
                        <li><a class="footer__link" href="#">Регистрации</a></li>
                        <li><a class="footer__link" href="#">Услуги логистики</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <span>© 2021 ООО «Medical Online Services»</span>
            <span>Дизайн сделан: <a href="mailto:damingues92@gmail.com">damingues92@gmail.com</a></span>
        </div>
    </div>
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('frontend/assets/js/libs.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/script.js') }}"></script>
</body>
</html>
