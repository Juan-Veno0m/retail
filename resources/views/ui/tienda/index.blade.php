<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Yolkan: Tienda de Productos Orgánicos y Artesanales</title>
        <meta name="description" content="Yolkan Tienda en línea de productos orgánicos y artesanales, 100 % naturales de pequeños productores locales.">
        <!-- Twitter -->
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@Yolkan6" />
        <meta name="twitter:creator" content="@Yolkan6" />
        <!--  Open Graph -->
        <meta property="og:title" content="Yolkan: Tienda de Productos Orgánicos y Artesanales" />
        <meta property="og:description" content="Yolkan Tienda en línea de productos orgánicos y artesanales, 100 % naturales de pequeños productores locales.">
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{url('/')}}" />
        <meta property="og:image" content="{{url('/img/label-yolkan.png')}}" />
        <meta property="og:site_name" content="Yolkan" />
        <meta name="author" content="Veno0M" />
        <meta name="robots" content="index, follow" />
        <link rel="canonical" href="{{url()->current()}}" />
        <!-- critical css -->
        <style>
          :root{--blue:#3490dc;--indigo:#6574cd;--purple:#9561e2;--pink:#f66d9b;--red:#e3342f;--orange:#f6993f;--yellow:#ffed4a;--green:#38c172;--teal:#4dc0b5;--cyan:#6cb2eb;--white:#fff;--gray:#6c757d;--gray-dark:#343a40;--primary:#3490dc;--secondary:#6c757d;--success:#38c172;--info:#6cb2eb;--warning:#ffed4a;--danger:#e3342f;--light:#f8f9fa;--dark:#343a40;--breakpoint-xs:0;--breakpoint-sm:576px;--breakpoint-md:768px;--breakpoint-lg:992px;--breakpoint-xl:1200px;--font-family-sans-serif:"Nunito",sans-serif;--font-family-monospace:SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace}*,*::before,*::after{box-sizing:border-box}html{font-family:sans-serif;line-height:1.15;-webkit-text-size-adjust:100%}footer,header,nav,section{display:block}body{margin:0;font-family:"Nunito",sans-serif;font-size:0.9rem;font-weight:400;line-height:1.6;color:#212529;text-align:left;background-color:#f8fafc}hr{box-sizing:content-box;height:0;overflow:visible}h1,h2{margin-top:0;margin-bottom:0.5rem}p{margin-top:0;margin-bottom:1rem}ol,ul{margin-top:0;margin-bottom:1rem}b{font-weight:bolder}a{color:#3490dc;text-decoration:none;background-color:transparent}img{vertical-align:middle;border-style:none}svg{overflow:hidden;vertical-align:middle}button{border-radius:0}input,button{margin:0;font-family:inherit;font-size:inherit;line-height:inherit}button,input{overflow:visible}button{text-transform:none}button,[type=button],[type=submit]{-webkit-appearance:button}button::-moz-focus-inner,[type=button]::-moz-focus-inner,[type=submit]::-moz-focus-inner{padding:0;border-style:none}[type=search]{outline-offset:-2px;-webkit-appearance:none}[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{font:inherit;-webkit-appearance:button}h1,h2{margin-bottom:0.5rem;font-weight:500;line-height:1.2}h1{font-size:2.25rem}h2{font-size:1.8rem}hr{margin-top:1rem;margin-bottom:1rem;border:0;border-top:1px solid rgba(0,0,0,0.1)}.list-unstyled{padding-left:0;list-style:none}.img-fluid{max-width:100%;height:auto}.container{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.container-fluid{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:576px){.container{max-width:540px}}@media (min-width:768px){.container{max-width:720px}}@media (min-width:992px){.container{max-width:960px}}@media (min-width:1200px){.container{max-width:1140px}}.row{display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.no-gutters{margin-right:0;margin-left:0}.no-gutters > [class*=col-]{padding-right:0;padding-left:0}.col-xl-8,.col-xl-2,.col-xl-1,.col-lg-12,.col-md,.col-md-5,.col-md-4,.col,.col-8{position:relative;width:100%;padding-right:15px;padding-left:15px}.col{flex-basis:0;flex-grow:1;min-width:0;max-width:100%}.col-8{flex:0 0 66.6666666667%;max-width:66.6666666667%}@media (min-width:768px){.col-md{flex-basis:0;flex-grow:1;min-width:0;max-width:100%}.col-md-4{flex:0 0 33.3333333333%;max-width:33.3333333333%}.col-md-5{flex:0 0 41.6666666667%;max-width:41.6666666667%}}@media (min-width:992px){.col-lg-12{flex:0 0 100%;max-width:100%}}@media (min-width:1200px){.col-xl-1{flex:0 0 8.3333333333%;max-width:8.3333333333%}.col-xl-2{flex:0 0 16.6666666667%;max-width:16.6666666667%}.col-xl-8{flex:0 0 66.6666666667%;max-width:66.6666666667%}}.form-control{display:block;width:100%;height:calc(1.6em + 0.75rem + 2px);padding:0.375rem 0.75rem;font-size:0.9rem;font-weight:400;line-height:1.6;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;border-radius:0.25rem}@media (prefers-reduced-motion:reduce){}.form-control::-ms-expand{background-color:transparent;border:0}.form-control:-moz-focusring{color:transparent;text-shadow:0 0 0 #495057}.form-control::-webkit-input-placeholder{color:#6c757d;opacity:1}.form-control::-moz-placeholder{color:#6c757d;opacity:1}.form-control:-ms-input-placeholder{color:#6c757d;opacity:1}.form-control::-ms-input-placeholder{color:#6c757d;opacity:1}.btn{display:inline-block;font-weight:400;color:#212529;text-align:center;vertical-align:middle;background-color:transparent;border:1px solid transparent;padding:0.375rem 0.75rem;font-size:0.9rem;line-height:1.6;border-radius:0.25rem}@media (prefers-reduced-motion:reduce){}.btn-warning{color:#212529;background-color:#ffed4a;border-color:#ffed4a}.collapse:not(.show){display:none}.dropdown{position:relative}.dropdown-toggle{white-space:nowrap}.dropdown-toggle::after{display:inline-block;margin-left:0.255em;vertical-align:0.255em;content:"";border-top:0.3em solid;border-right:0.3em solid transparent;border-bottom:0;border-left:0.3em solid transparent}.dropdown-menu{position:absolute;top:100%;left:0;z-index:1000;display:none;float:left;min-width:10rem;padding:0.5rem 0;margin:0.125rem 0 0;font-size:0.9rem;color:#212529;text-align:left;list-style:none;background-color:#fff;background-clip:padding-box;border:1px solid rgba(0,0,0,0.15);border-radius:0.25rem}@media (min-width:768px){.dropdown-menu-md-right{right:0;left:auto}}.dropdown-divider{height:0;margin:0.5rem 0;overflow:hidden;border-top:1px solid #e9ecef}.dropdown-item{display:block;width:100%;padding:0.25rem 1.5rem;clear:both;font-weight:400;color:#212529;text-align:inherit;white-space:nowrap;background-color:transparent;border:0}.input-group{position:relative;display:flex;flex-wrap:wrap;align-items:stretch;width:100%}.input-group > .form-control{position:relative;flex:1 1 auto;width:1%;min-width:0;margin-bottom:0}.input-group > .form-control:not(:last-child){border-top-right-radius:0;border-bottom-right-radius:0}.input-group-append{display:flex}.input-group-append .btn{position:relative;z-index:2}.input-group-append{margin-left:-1px}.input-group > .input-group-append:not(:last-child) > .btn{border-top-right-radius:0;border-bottom-right-radius:0}.input-group > .input-group-append > .btn{border-top-left-radius:0;border-bottom-left-radius:0}.nav-link{display:block;padding:0.5rem 1rem}.navbar{position:relative;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;padding:0.5rem 1rem}.navbar-brand{display:inline-block;padding-top:0.32rem;padding-bottom:0.32rem;margin-right:1rem;font-size:1.125rem;line-height:inherit;white-space:nowrap}.navbar-nav{display:flex;flex-direction:column;padding-left:0;margin-bottom:0;list-style:none}.navbar-nav .nav-link{padding-right:0;padding-left:0}.navbar-nav .dropdown-menu{position:static;float:none}.navbar-collapse{flex-basis:100%;flex-grow:1}.navbar-toggler{padding:0.25rem 0.75rem;font-size:1.125rem;line-height:1;background-color:transparent;border:1px solid transparent;border-radius:0.25rem}@media (min-width:992px){.navbar-expand-lg{flex-flow:row nowrap;justify-content:flex-start}.main-content{z-index:2;position:relative;background:#fff;margin-bottom:510px;margin-top:97px}.ftco-footer{position:fixed !important;bottom:70px;right:0;left:0;z-index:1}.nav-custom{order:2}.copyright{position:fixed;bottom:0;left:0;right:0}.navbar-expand-lg .navbar-nav{flex-direction:row}.navbar-expand-lg .navbar-nav .dropdown-menu{position:absolute}.navbar-expand-lg .navbar-nav .nav-link{padding-right:0.5rem;padding-left:0.5rem}.navbar-expand-lg .navbar-collapse{display:flex !important;flex-basis:auto}.navbar-expand-lg .navbar-toggler{display:none}}.card{position:relative;display:flex;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,0.125);border-radius:0.25rem}.card-body{flex:1 1 auto;min-height:1px;padding:1.25rem}.list-group{display:flex;flex-direction:column;padding-left:0;margin-bottom:0;border-radius:0.25rem}.list-group-flush{border-radius:0}.carousel{position:relative}.carousel-inner{position:relative;width:100%;overflow:hidden}.carousel-inner::after{display:block;clear:both;content:""}.carousel-item{position:relative;display:none;float:left;width:100%;margin-right:-100%;-webkit-backface-visibility:hidden;backface-visibility:hidden}@media (prefers-reduced-motion:reduce){}.carousel-item.active{display:block}.carousel-fade .carousel-item{opacity:0;transform:none}.carousel-fade .carousel-item.active{z-index:1;opacity:1}.carousel-control-prev,.carousel-control-next{position:absolute;top:0;bottom:0;z-index:1;display:flex;align-items:center;justify-content:center;width:15%;color:#fff;text-align:center;opacity:0.5}@media (prefers-reduced-motion:reduce){}.carousel-control-prev{left:0}.carousel-control-next{right:0}.carousel-control-prev-icon,.carousel-control-next-icon{display:inline-block;width:20px;height:20px;background:no-repeat 50%/100% 100%}.carousel-control-prev-icon{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath d='M5.25 0l-4 4 4 4 1.5-1.5L4.25 4l2.5-2.5L5.25 0z'/%3e%3c/svg%3e")}.carousel-control-next-icon{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath d='M2.75 0l-1.5 1.5L3.75 4l-2.5 2.5L2.75 8l4-4-4-4z'/%3e%3c/svg%3e")}.carousel-indicators{position:absolute;right:0;bottom:0;left:0;z-index:15;display:flex;justify-content:center;padding-left:0;margin-right:15%;margin-left:15%;list-style:none}.carousel-indicators li{box-sizing:content-box;flex:0 1 auto;width:30px;height:3px;margin-right:3px;margin-left:3px;text-indent:-999px;background-color:#fff;background-clip:padding-box;border-top:10px solid transparent;border-bottom:10px solid transparent;opacity:0.5}@media (prefers-reduced-motion:reduce){}.carousel-indicators .active{opacity:1}.carousel-caption{position:absolute;right:15%;top:94px;left:15%;z-index:10;padding-top:20px;padding-bottom:20px;color:#fff;text-align:center}.d-block{display:block !important}.d-table{display:table !important}.d-table-cell{display:table-cell !important}.d-flex{display:flex !important}@media (min-width:768px){.d-md-block{display:block !important}}.justify-content-center{justify-content:center !important}.align-items-start{align-items:flex-start !important}.align-items-center{align-items:center !important}@media (min-width:768px){.float-md-left{float:left !important}}.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}.w-100{width:100% !important}.vh-100{height:82vh!important}.mr-0{margin-right:0 !important}.my-2{margin-top:0.5rem !important}.mr-2{margin-right:0.5rem !important}.my-2{margin-bottom:0.5rem !important}.mb-3{margin-bottom:1rem !important}.mr-4{margin-right:1.5rem !important}.mb-4{margin-bottom:1.5rem !important}.mt-5{margin-top:3rem !important}.mb-5{margin-bottom:3rem !important}.px-0{padding-right:0 !important}.px-0{padding-left:0 !important}.py-1{padding-top:0.25rem !important}.py-1{padding-bottom:0.25rem !important}.py-2{padding-top:0.5rem !important}.pb-2,.py-2{padding-bottom:0.5rem !important}.py-3{padding-top:1rem !important}.pb-3,.py-3{padding-bottom:1rem !important}.pr-4,.px-4{padding-right:1.5rem !important}.px-4{padding-left:1.5rem !important}.py-5{padding-top:3rem !important}.py-5{padding-bottom:3rem !important}@media (min-width:768px){.mr-md-2,.mx-md-2{margin-right:0.5rem !important}.mx-md-2{margin-left:0.5rem !important}.ml-md-5{margin-left:3rem !important}.px-md-2{padding-right:0.5rem !important}.px-md-2{padding-left:0.5rem !important}.ml-md-auto{margin-left:auto !important}}@media (min-width:992px){.my-lg-0{margin-top:0 !important}.my-lg-0{margin-bottom:0 !important}.px-lg-4{padding-right:1.5rem !important}.px-lg-4{padding-left:1.5rem !important}}.text-left{text-align:left !important}.text-center{text-align:center !important}@media (min-width:992px){.text-lg-right{text-align:right !important}}html{scroll-behavior:smooth}body{font-family:"Poppins",Arial,sans-serif;background:#fff;font-size:15px;line-height:1.8;font-weight:400;color:#404040}a{color:#444}h1,h2{line-height:1.5;font-weight:400;color:#000000;font-family:"Poppins",Arial,sans-serif}.topper{font-size:11px;width:100%;display:block;text-transform:uppercase;letter-spacing:1px}@media (max-width:767.98px){.topper{margin-bottom:10px}}.topper .icon span{color:#fff}.topper .text{width:calc(100% - 30px);color:white}.border-nav-bottom{box-shadow:inset 0 -1px 0 0 #e5e5e5}.ftco-navbar-light{background:#fff;z-index:999;padding:0;position:fixed;left:0;right:0;top:26.8px}@media (max-width:991.98px){.ftco-navbar-light{background:#ffffff !important;position:relative;top:0;padding:2px 15px}.bg-corporate{display:none}.icon-separetor hr{display:none}}.ftco-navbar-light .navbar-brand{color:#5fbd74}@media (max-width:991.98px){.ftco-navbar-light .navbar-brand img{height:34px}.nav-custom{padding-left:6%;flex-direction:row}.nav-custom .nav-link{padding:0.9rem 0.9rem 0.9rem 0.7rem !important}.nav-custom .nav-item:first-child .nav-link{padding-top:1.0rem !important}}.nav-custom > .nav-item > .nav-link svg{vertical-align:sub}.ftco-navbar-light .navbar-nav > .nav-item > .nav-link{padding-top:1.5rem;padding-bottom:1.5rem;padding-left:20px;padding-right:20px;color:#5e5a54;letter-spacing:0em;opacity:1 !important;font-size:14px}.custom-font{font-family:'Source Sans Pro',sans-serif;font-weight:700}@media (max-width:991.98px){.ftco-navbar-light .navbar-nav > .nav-item > .nav-link{padding-left:0;padding-right:0;padding-top:0.9rem;padding-bottom:0.9rem;color:rgba(0,0,0,0.7)}}.ftco-navbar-light .navbar-nav > .nav-item .dropdown-menu{border:none;background:#fff;box-shadow:0px 10px 34px -20px rgba(0,0,0,0.41);border-radius:0}.ftco-navbar-light .navbar-nav > .nav-item .dropdown-menu .dropdown-item{font-size:14px}.ftco-navbar-light .navbar-nav > .nav-item.cta > a{color:#5e5a54}.item-number{font-family:inherit;line-height:30px;margin:2px 0 0px 3px;font-size:13px}.ftco-navbar-light .navbar-nav > .nav-item.active > a{color:#000000}.ftco-navbar-light .navbar-toggler{border:none;color:#000000d1 !important;padding-right:0;text-transform:uppercase;font-size:16px;letter-spacing:0.1em}.navbar-brand{font-weight:800;font-size:20px;text-transform:uppercase}.bg-corporate{background-color:#444 !important;position:fixed;left:0;right:0;top:0;z-index:999}.ftco-section{padding:6em 0;position:relative}.icon-separetor svg{width:2.1em}.carousel-fade .carousel-item{opacity:0}.carousel-fade .carousel-item.active{opacity:1}.carousel-fade .carousel-item.active{transform:translateX(0);transform:translate3d(0,0,0)}.carousel-item img{-o-object-fit:cover;object-fit:cover;opacity:1}.carousel-title{font-size:calc(1.4em + 4vw);color:#444;line-height:1.3;font-weight:400;font-family:"Amatic SC",cursive}.carousel-subtitle{font-weight:300;font-size:calc(0.6em + 1vw);letter-spacing:4px;text-transform:capitalize;display:inline-block;color:#367744;background:#efefef}.overlay{position:absolute;background:#eff1f5;height:auto;width:100%}.form-suggestions .input-group-append{border-top-right-radius:8px;border-bottom-right-radius:8px}.form-suggestions .fas{position:absolute;height:36px;width:36px;padding:10px}.form-suggestions{position:relative;width:auto}.list-ajax{position:absolute;top:40px;max-height:420px;width:100%;box-shadow:2px 2px 2px 1px rgba(0,0,0,0.2)}.mouse{position:absolute;left:0;right:0}.mouse-icon{width:127px;height:37px;left:50%;position:absolute;transform:translateX(-50%);bottom:12px}.ftco-footer{font-size:14px;padding:2em 0;color:#444}.mouse-icon svg{height:34px;left:50px;position:absolute}.ftco-footer .ftco-footer-widget h2{font-weight:normal;margin-bottom:20px;font-size:16px;font-weight:500}.ftco-footer .ftco-footer-widget ul li a{color:#444}.ftco-footer .ftco-footer-widget ul li{font-size:14px}.block-23 ul li{display:table;line-height:1.5;margin-bottom:15px}.block-23 ul{padding:0}.block-23 ul li .icon,.block-23 ul li .text{display:table-cell;vertical-align:top}.ftco-footer-social li{list-style:none;margin:0 10px 0 0;display:inline-block}.block-23 ul li .icon{width:40px;font-size:18px;padding-top:2px}.ftco-footer-social li a{height:50px;width:50px;display:block;float:left;background:rgba(0,0,0,0.02);border-radius:50%;position:relative}.ftco-footer-social li a span{position:absolute;font-size:18px;top:50%;left:50%;transform:translate(-50%,-50%);color:#444}.copyright p{font-weight:400;letter-spacing:0em;line-height:1.5;font-size:12px}@media only screen and (min-width:768px){.notification-cart{position:absolute;width:35%;right:33px;top:73px;display:none}}@media screen and (max-width:768px){.navbar-brand {width: 98px;}.notification-cart{position:fixed;display:none;z-index:9999;background:rgba(0,0,0,.4);top:0;right:0;bottom:0;left:0;flex-direction:row;align-items:flex-start;justify-content:center;padding:.625em;overflow-x:hidden}}.main-content{min-height:60vh}.navbar-toggler svg{height:16px;width:16px;margin-right:12px}.navbar-nav .nav-item svg{height:18px}.insight-title--subtitle{color:#392a25;line-height:1.6;margin-top:-10px;font-family:"Amatic SC",cursive}
        </style>
        <!-- styles -->
        <style>
          /* cyrillic-ext */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNa7lqDY.woff2) format('woff2');
          unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
          }
          /* cyrillic */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qPK7lqDY.woff2) format('woff2');
          unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
          }
          /* greek-ext */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNK7lqDY.woff2) format('woff2');
          unicode-range: U+1F00-1FFF;
          }
          /* greek */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qO67lqDY.woff2) format('woff2');
          unicode-range: U+0370-03FF;
          }
          /* vietnamese */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qN67lqDY.woff2) format('woff2');
          unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
          }
          /* latin-ext */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qNq7lqDY.woff2) format('woff2');
          unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
          }
          /* latin */
          @font-face {
          font-family: 'Source Sans Pro';
          font-display: swap;
          font-style: normal;
          font-weight: 400;
          src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v13/6xK3dSBYKcSV-LCoeQqfX1RYOo3qOK7l.woff2) format('woff2');
          unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
          }/* sans pro */
          @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap');
          /* devanagari */
          @font-face {
            font-family: 'Poppins';
            font-display: swap;
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJbecnFHGPezSQ.woff2) format('woff2');
            unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
          }
          /* latin-ext */
          @font-face {
            font-family: 'Poppins';
            font-display: swap;
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJnecnFHGPezSQ.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
          }
          /* latin */
          @font-face {
            font-family: 'Poppins';
            font-display: swap;
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: local('Poppins Regular'), local('Poppins-Regular'), url(https://fonts.gstatic.com/s/poppins/v9/pxiEyp8kv8JHgFVrJJfecnFHGPc.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
          }
        </style>
        @include('ui.layouts.styles-main')
        <link rel="preload" href="{{asset('/css/ui/index/main.css?x=2')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{asset('/css/ui/index/main.css?x=2')}}"></noscript>
    </head>
    <body>
        <!-- Header -->
        <header>
            <!-- Top Header -->
            @include('ui.layouts.top-header')
            <!-- Navbar -->
            @include('ui.layouts.navbar')
        </header>
        <!-- End Header -->
        <!-- Section content -->
        <div class="main-content" data-path="{{url('/')}}">
          <!-- Section Carousel -->
          @include('ui.parts.main-carousel')
          <!-- Grid -->
          @include('ui.parts.featured-products')
          <!-- Section Services -->
          @include('ui.parts.services-shop')
          <!-- banner -->
          @include('ui.parts.banner')
          <!-- Section categories -->
          @include('ui.parts.catalogo')
        </div>
        <!-- End content -->
        <!-- Footer -->
        @include('ui.layouts.footer-public')
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" defer></script>
        <script src="{{asset('js/lazysizes.min.js')}}" async></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" async></script>
        <script src="{{asset('js/ui/main.js?x=9')}}" async></script>
        @yield('scripts')
    </body>
</html>
