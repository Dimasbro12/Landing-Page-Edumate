(function ($) {
  "use strict";

  // Header Type = Fixed
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    var box = $(".header-text").height();
    var header = $("header").height();

    if (scroll >= box - header) {
      $("header").addClass("background-header");
    } else {
      $("header").removeClass("background-header");
    }
  });

  // Menu Dropdown Toggle
  if ($(".menu-trigger").length) {
    $(".menu-trigger").on("click", function () {
      $(this).toggleClass("active");
      $(".header-area .nav").slideToggle(200);
    });
  }

  // Menu elevator animation
  $(".scroll-to-section a[href*=\\#]:not([href=\\#])").on("click", function () {
    if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        var width = $(window).width();
        if (width < 991) {
          $(".menu-trigger").removeClass("active");
          $(".header-area .nav").slideUp(200);
        }
        $("html,body").animate(
          {
            scrollTop: target.offset().top + 1,
          },
          700,
        );
        return false;
      }
    }
  });

  $(document).ready(function () {
    $(document).on("scroll", onScroll);

    //smoothscroll
    $('.scroll-to-section a[href^="#"]').on("click", function (e) {
      e.preventDefault();
      $(document).off("scroll");

      $(".scroll-to-section a").each(function () {
        $(this).removeClass("active");
      });
      $(this).addClass("active");

      var target = this.hash,
        menu = target;
      var target = $(this.hash);
      $("html, body")
        .stop()
        .animate(
          {
            scrollTop: target.offset().top + 1,
          },
          500,
          "swing",
          function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
          },
        );
    });
  });

  function onScroll(event) {
    var scrollPos = $(document).scrollTop();
    var lastActiveFound = null;

    // Iterasi setiap link nav untuk menemukan section mana yang sedang aktif
    $(".nav a").each(function () {
      var currLink = $(this);
      var refElement = $(currLink.attr("href"));

      // Pastikan section ada dan posisinya berada dalam area pandang
      if (refElement.length && refElement.position().top <= scrollPos + 101) {
        lastActiveFound = currLink;
      }
    });

    // Hapus semua kelas 'active' dan tambahkan hanya ke link yang tepat
    $(".nav a").removeClass("active");
    if (lastActiveFound) {
      lastActiveFound.addClass("active");
    } else {
      // Jika tidak ada yang cocok (misalnya di paling atas), aktifkan 'Beranda'
      $('.nav a[href="#top"]').addClass("active");
    }
  }

  // Page loading animation
  $(window).on("load", function () {
    $("#js-preloader").addClass("loaded");
  });

  // Window Resize Fix
  $(window).on("resize", function () {
    if ($(window).width() > 991) {
      $(".header-area .nav").show();
    } else {
      // Jika ingin menu tertutup saat resize ke mobile, uncomment baris bawah
      // $('.header-area .nav').hide();
      $(".menu-trigger").removeClass("active");
    }
  });
})(window.jQuery);
