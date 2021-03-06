<?php use Blog\Models\AboutPage;
use Blog\Models\ContactPage;
use Blog\Models\Site;?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if(isset($content)){{$content->name}}@else {{$title}}@endif | {{$site->name}}</title>
    <meta name="description" content="{{$description}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="/assets/fonts/icomoon/style.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/assets/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="/assets/css/aos.css">

    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#textarea'
      });
      tinymce.init({
        selector: '.textarea'
      });
    </script>
</head>

  <body>
    <div class="site-wrap">
            <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar" role="banner">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-4 site-logo">
            <a href="/" class="text-black h2 mb-0">Mini Blog</a>
          </div>
          <div class="col-8 text-right">
            <nav class="site-navigation" role="navigation">
              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block mb-0">
                <li><a href="{{route('users.index')}}">Пользователи</a></li>
                <li><a href="{{route('admin.tags.index')}}">Теги</a></li>
                <li><a href="{{route('admin.category.index')}}">Категории</a></li>
                <li><a href="{{route('admin.posts.index')}}">Посты</a></li> 
                <li><a href="{{route('admin.comments.index')}}">Комментарии</a></li>
                <li><a href="{{route('admin.header.menu.index')}}">Верхнее меню</a></li>
                <li><a href="{{route('admin.footer.menu.index')}}">Нижнее меню</a></li>
                <li><a href="{{route('admin.social.link.index')}}">Социальные ссылки</a></li>
                <li><a href="{{route('admin.aboutpage.show', AboutPage::ABOUT_PAGE_ID)}}">Страница о нас</a></li>
                <li><a href="{{route('admin.staff.index')}}">Сотрудники</a></li>
                <li><a href="{{route('admin.contactpage.show', ContactPage::CONTACT_PAGE_ID)}}">Страница контактов</a></li>
                <li><a href="{{route('admin.subscribers.index')}}">Подписчики</a></li>
                <li><a href="{{route('admin.mailings.index')}}">Рассылки</a></li>
                <li><a href="{{route('admin.site.show', Site::MAIN_SITE_ID)}}">Сайт</a></li>
                @foreach($headerMenu as $item)
                @if($item->url != "")
                <li><a href="{{route('category.show', $item->url)}}">{{$item->name}}</a></li>
                @else
                <li><a href="/{{$item->url}}">{{$item->name}}</a></li>
                @endif
                @endforeach
                <li class="d-none d-lg-inline-block"><a href="#" class="js-search-toggle"><span class="icon-search"></span></a></li>
                @if(isset($currentUser))
                <li><a href = "{{route('users.show', $currentUser->id)}}">{{$currentUser->name}}</a> | <a href = "/logout">Выйти</a></li>
                @endif
              </ul>
            </nav>
            <a href="#" class="site-menu-toggle js-menu-toggle text-black d-inline-block d-lg-none"><span class="icon-menu h3"></span></a></div>
          </div>
          
            <div class="col-12 search-form-wrap js-search-form">
                <form method="get" action="{{route('search.index')}}">
                  <input name = "q" type="text" id="s" class="form-control" placeholder="Search...">
                  <button class="search-btn" type="submit"><span class="icon-search"></span></button>
                </form>
            </div>
      </div>
    </header>
        @yield('content')
     <div class="site-footer">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-4">
            <h3 class="footer-heading mb-4">About Us</h3>
            <p>{{$site->footer_text}}</p>
          </div>
          <div class="col-md-3 ml-auto">
            <!-- <h3 class="footer-heading mb-4">Navigation</h3> -->
            <?php $indexMenu = 0;
                  $cntMenu = 0;
            ?>
            @foreach($footerMenu as $item)
            @if($indexMenu == 0)
            <ul class="list-unstyled float-left mr-5">
            @endif
                <li><a href="/{{$item->url}}">{{$item->name}}</a></li>
            @if($indexMenu == 3)
                <?php $indexMenu = 0;?>
            </ul>
            @elseif($cntMenu == (count($footerMenu)-1))
                </ul>
            @else
                <?php $indexMenu++;?>
            @endif
                <?php $cntMenu++;?>
            @endforeach
          </div>
          <div class="col-md-4">
            <div>
              <h3 class="footer-heading mb-4">Connect With Us</h3>
              <p>
                @foreach($socialLinks as $link)
                <a href="{{$link->href}}"><span class="icon-{{strtolower($link->name)}} pt-2 pr-2 pb-2 pl-0"></span></a>
                @endforeach
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
            <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
          </div>
        </div>
      </div>
    </div>
    </div>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="/assets/js/jquery-ui.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/jquery.stellar.min.js"></script>
    <script src="/assets/js/jquery.countdown.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/assets/js/bootstrap-datepicker.min.js"></script>
    <script src="/assets/js/aos.js"></script>

    <script src="/assets/js/main.js"></script>  
  </body>
</html>